<?php
namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables,Notify,Str,Storage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Auth;
use App\Models\Cms;
use Event;
use App\Helpers\Helper;

class CmsController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * * * * * * * * * * Create a new controller instance.
     * * * * * * * * * * * *
     * * * * * * * * * * * @return void
     * * * * * * * * * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.cms.';
        $this->middleware('auth');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Index CMS
    ------------------------------------------------------------------------------------*/
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['cms-list','cms-create','cms-edit','cms-show']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('errors.permission',compact('message'));
        }
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['cms-edit']);
        $permission_data['hasDeletePermission'] = Helper::checkPermission(['cms-delete']);
        $permission_data['hasShowPermission'] = Helper::checkPermission(['cms-show']);
        $cms = Cms::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($cms->get())->addIndexColumn()
            ->editColumn('action', function (Cms $cms) use($permission_data) {
                $action  = '';
                if($permission_data['hasUpdatePermission']){
                    $action .= '<a class="btn btn-warning btn-circle btn-sm" href='.route('admin.cms.edit',[$cms->id]).'  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
                }
                if($permission_data['hasDeletePermission']){
                    $action .='<a class="btn btn-danger btn-circle btn-sm m-l-10 deletecms ml-1 mr-1" data-id ="'.$cms->id.'" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';
                }
                if($permission_data['hasShowPermission']){
                    $action .='<a href="javascript:void(0)" class="btn btn-primary btn-circle btn-sm Showcms" data-id="'.$cms->id.'" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>';
                }
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'NO','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'CATEGORY','width'=>'10%'],
            ['data' => 'module_name', 'name' => 'module_name', 'title' => 'MODULE NAME','width'=>'10%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'ACTION','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([ 'order' =>[] ]);
        return view($this->pageLayout.'index',compact('html'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Create CMS
    ------------------------------------------------------------------------------------*/
    public function create(){
        $userRole = Helper::checkPermission(['cms-create']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('errors.permission',compact('message'));
        }
        return view($this->pageLayout.'create');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Store CMS
    ------------------------------------------------------------------------------------*/
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'module_name' => 'required',
            'name' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'description' => 'required',
            'meta_tag' => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $cms = Cms::create(['module_name' => @$request->get('module_name'),'name' => @$request->get('name'),'meta_title' => @$request->get('meta_title'),'meta_keyword' => @$request->get('meta_keyword'),'meta_description' => @$request->get('meta_description'),'description' => @$request->get('description'),'meta_tag' => @$request->get('meta_tag')]);
            Notify::success('CMS Created',$title = "Successfully..!");
            return redirect()->route('admin.cms.index');
        }catch(\Exception $e){
            return back()->with(['alert-type' => 'danger','message' => $e->getMessage()]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Edit CMS
    ------------------------------------------------------------------------------------*/
    public function edit($id){
        $userRole = Helper::checkPermission(['cms-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('errors.permission',compact('message'));
        }
        $cms = Cms::where('id',$id)->first();
        if(!empty($cms)){
            return view($this->pageLayout.'edit',compact('cms'));
        }else{
            return redirect()->route('admin.cms.index');
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Update CMS
    ------------------------------------------------------------------------------------*/
    public function update(Request $request,$id){
        $validatedData = $request->validate([
            'module_name' => 'required',
            'name' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'description' => 'required',
            'meta_tag' => 'required',
        ]);
        try{
            Cms::where('id',$id)->update(['module_name' => @$request->get('module_name'),'name' => @$request->get('name'),'meta_title' => @$request->get('meta_title'),'meta_keyword' => @$request->get('meta_keyword'),'meta_description' => @$request->get('meta_description'),'description' => @$request->get('description'),'meta_tag' => @$request->get('meta_tag')]);
            Notify::success('Cms Updated',$title = "Successfully..!");
            return redirect()->route('admin.cms.index');
        } catch(\Exception $e){
            return back()->with(['alert-type' => 'danger','message' => $e->getMessage()]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Delete CMS
    ------------------------------------------------------------------------------------*/
    public function delete($id){
        try{
            $cms = Cms::where('id',$id)->first();
            $cms->delete();
            Notify::success('CMS Deleted',$title = "Successfully..!");
            return response()->json(['status' => 'success','title' => 'Success!!','message' => 'CMS Deleted Successfully..!']);
        }catch(\Exception $e){
            return back()->with(['alert-type' => 'danger','message' => $e->getMessage()]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for show CMS
    ------------------------------------------------------------------------------------*/
    public function show(Request $request) {
        $userRole = Helper::checkPermission(['cms-show']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('errors.permission',compact('message'));
        }
        $cms = Cms::where('id',$request->id)->first();
        return view($this->pageLayout.'show',compact('cms'));
    }
}