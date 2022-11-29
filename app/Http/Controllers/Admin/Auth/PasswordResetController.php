<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\User;
use App\Models\PasswordReset;

class PasswordResetController extends Controller{
    public function showPasswordRest(){
        return view('admin.auth.restPassword');
    }
    
    public function create(Request $request){
        $request->validate(['email' => 'required|string|email',]);
        $user = User::where(['email'=> $request->email,'status'=>'active'])->whereIn('user_type',['superadmin'])->first();
        if (!$user)
            return back()->with(['alert-type'   => 'danger','message' => "We can't find a user with that e-mail address."]);
        $passwordReset = PasswordReset::updateOrCreate(['email' => $user->email],['email' => $user->email,'token' => str_random(60)]);
        if ($user && $passwordReset)
            $user->notify(new PasswordResetRequest($passwordReset->token));
        return back()->with(['alert-type'   => 'success','message' => 'We have e-mailed your password reset link!']);
    }

    public function find($token){
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (!$passwordReset)
            return back()->with(['alert-type'   => 'danger','message' => 'This password reset token is invalid.']);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return back()->with(['alert-type'   => 'danger','message' => 'This password reset token is invalid.']);
        }
        return view('admin.auth.reset',compact('passwordReset'));
    }

    public function reset(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required||min:6|string|confirmed',
            'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([['token', $request->token],['email', $request->email]])->first();
        if (!$passwordReset){
            return back()->with(['alert-type'   => 'danger','message'      => 'This password reset token is invalid.']);
        }
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return back()->with(['alert-type'   => 'danger','message' => "We can't find a user with that e-mail address."]);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return redirect()->route('admin.login')->with(['alert-type'    => 'success','message'       => "Password reset successfully."]);
    }
}