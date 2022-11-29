<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleHasPermissions;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Notify,Validator,Str,Storage,Auth;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Permission;
use App\Helpers\Helper;

class RoleController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * * * * * * * * * * * * * Create a new controller instance.
     * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * @return void
     * * * * * * * * * * * * * */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.role.';
        $this->middleware('auth');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Index Role
    ------------------------------------------------------------------------------------*/
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['role-list','role-create','role-edit','role-delete','role-show']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('errors.permission',compact('message'));
        }
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['role-edit']);
        $permission_data['hasShowPermission'] = Helper::checkPermission(['role-show']);
        $role = Role::where('id','!=','1')->orderBy('id','desc')->get();
        if (request()->ajax()) {
            return DataTables::of($role)->addIndexColumn()
            ->editColumn('action', function (Role $role)use($permission_data)  {
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .= '<a class="btn btn-warning btn-circle btn-sm" href='.route('admin.role.edit',[$role->id]).' data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
                }
                if($permission_data['hasShowPermission']){
                    $action .='<a href="javascript:void(0)" class="btn btn-primary btn-circle btn-sm Showrole ml-1 mr-1" data-id="'.$role->id.'" data-toggle="tooltip" title="Show"><i class="fa fa-eye"></i></a>';
                }
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'name','width'=>'15%'],
            ['data' => 'action', 'name' => 'Action', 'title' => 'Action', "orderable"=> false, "searchable"=> false,'width'=>'10%'],
        ]);
        return view($this->pageLayout.'index', compact('html'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Edit Role
    ------------------------------------------------------------------------------------*/
    public function edit($id){
        $userRole = Helper::checkPermission(['role-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('errors.permission',compact('message'));
        }
        $role = RoleHasPermissions::with('permission')->where('role_id','=',$id)->get();
        $user_permission=[];
        foreach ($role as $key=>$value){
            foreach ($value->permission as $perm){
                $user_permission[]=$perm;
            }
        }
        $permissions = Permission::all();
        $permission = [];
        foreach ($permissions as $key => $value) {
            $permission[$value->module_name][] = $value;
        }
        $bol = $id;
        return view($this->pageLayout.'edit', compact('permission','user_permission','bol'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Update Role
    ------------------------------------------------------------------------------------*/
    public function update(Request $request){
        try{
            $role = Role::find($request->role_id);
            $role->syncPermissions($request->permission);
            Notify::success('Role Updated',$title = "Successfully..!");
            return redirect()->route('admin.role.index');
        }catch(\Exception $e){
            return back()->with(['alert-type' => 'danger','message' => $e->getMessage()]);
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Show Role
    ------------------------------------------------------------------------------------*/
    public function show(Request $request){
        $role = RoleHasPermissions::with('permission')->where('role_id','=',$request->id)->get();
        $user_permission=[];
        foreach ($role as $key=>$value){
            foreach ($value->permission as $perm){
                $user_permission[]=$perm;
            }
        }
        $permissions = Permission::all();
        $permission = [];
        foreach ($permissions as $key => $value) {
            $permission[$value->module_name][] = $value;
        }
        $bol = $request->id;
        return view($this->pageLayout.'show',compact('permission','user_permission','bol'));
    }
}