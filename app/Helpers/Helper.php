<?php
namespace App\Helpers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\RoleHasPermissions;
use App\Models\User;
use DateTime;
use Auth;

class Helper {
    
    public static function date_Time_format($data){
        return date_format($data,"Y-m-d H:i:s");
    }
    
    public static function ORM_to_string($object){
        $query = $object->toSql();
        $bindings = $object->getBindings();
        foreach ($bindings as $key => $binding) {
            if (!is_numeric($binding)) {
                $binding = "'" . $binding . "'";
            }
            $regex = is_numeric($key) ? " / \?(?=(?:[^'\\\']*'[^'\\\']*')*[^'\\\']*$)/" : "/:{$key}(?=(?:[^'\\\']*'[^'\\\']*')*[^'\\\']*$)/";
            $query = preg_replace($regex, $binding, $query, 1);
        }
        return $query;
    }
    
    public static function auth(){
        $users = User::with('role')->whereHas('role',function ($q){
            return $q->where('id','=',\Auth::user()->role_id);
        })->orderBy('id','desc')->first();
        if ($users){
            return $users->role->name;
        }
        return null;
    }

    public static function checkPermission($permissionName=0){
        if(Auth::user()->user_type == "superadmin"){
            return true;
        }else{
            $user = Auth::user();
            $role = RoleHasPermissions::with('permission')->where('role_id','=',$user->role_id)->get();
            $user_permission=[];
            foreach ($role as $key=>$value){
                foreach ($value->permission as $perm){
                    if(in_array($perm->name, $permissionName)){
                        $user_permission[]=$perm;
                    }
                }
            }
            if(empty($user_permission)){
                return false;
            }else{
                return true;
            }
        }
        return false;
    }
}