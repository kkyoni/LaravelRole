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
use App\Models\User;
use Event;
use App\Helpers\Helper;

class UsersController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * * * * * Create a new controller instance.
     * * * * *
     * * * * * @return void
     * * * * */

    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.user.';
        $this->middleware('auth');
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Update profile details
    ---------------------------------------------------------------------------------- */
    public function updateProfile(){
        $user = User::where(['status'=>'active','id'=>Auth::user()->id])->first();
        if(empty($user)){
            Notify::error('User not found..!',$title = "Error..!");
            return redirect()->to('admin/dashboard');
        }
        return view($this->pageLayout.'updateprofile',compact('user'));
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for Update profile details
    ---------------------------------------------------------------------------------- */
    public function updateProfileDetail(Request $request){
        $validatedData = $request->validate([
            'user_name'    => 'required',
            'first_name'    => 'required',
            'last_name'    => 'required',
            'email'    => 'required|unique:users,email,'.Auth::user()->id,
        ]);
        try{
            User::where('id',Auth::user()->id)->update(['user_name' => $request->user_name,'first_name' => $request->first_name,'last_name' => $request->last_name,'email' => $request->email]);
            Notify::success('Profile Updated',$title = "Successfully..!");
            return redirect()->back();
        }catch(\Exception $e){
            Notify::error($e->getMessage());
        }
    }

    /*-----------------------------------------------------------------------------------
    @Description: Function for update Password
    ---------------------------------------------------------------------------------- */
    public function updatePassword(Request $request){
        try{
            $validatedData = Validator::make($request->all(),[
                'old_password'          => 'required',
                'password'              => 'required|min:6',
                'password_confirmation' => 'required|min:6',
            ],[
                'old_password.required'          => 'The current password field is required.',
                'password.required'              => 'The new password field is required.',
                'password_confirmation.required' => 'The confirm password field is required.'
            ]);
            $validatedData->after(function() use($validatedData,$request){
                if($request->get('password') !== $request->get('password_confirmation')){
                    $validatedData->errors()->add('password_confirmation','The Confirm Password does not match.');
                }
            });
            if ($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }
            if (\Hash::check($request->get('old_password'),auth()->user()->password) === false) {
                Notify::error('Your current Password does not matches with the Previous Password. Please try again.',$title = "Error..!");
                return redirect()->back();
            }
            $user = auth()->user();
            $user->password =\Hash::make($request->get('password'));
            $user->save();
            Notify::success('Password Updated',$title = "Successfully..!");
            return redirect()->back();
        }catch(Exception $e){
            Notify::error($e->getMessage());
        }
    }
}