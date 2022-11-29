<?php
namespace App\Traits;
use App\Models\Activity;
use Carbon\Carbon;

trait ActivityTraits{
    public function logCreatedActivity($logModel,$changes,$request){
        $ip_address = request()->getClientIp();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $activity = activity()->causedBy(\Auth::user())->performedOn($logModel)->withProperties(['attributes'=>$request,'ip_address'=>$ip_address,'user_agent'=>$user_agent])->log($changes);
        $lastActivity = Activity::all()->last();
        return true;
    }

    public function logUpdatedActivity($list,$before,$list_changes){
        $ip_address = request()->getClientIp();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        unset($list_changes['updated_at']);
        $old_keys = [];
        $old_value_array = [];
        if(empty($list_changes)){
            $changes = 'No attribute changed';
        }else{
            if(count($before)>0){
                foreach($before as $key=>$original){
                    if(array_key_exists($key,$list_changes)){
                        $old_keys[$key]=$original;
                    }
                }
            }
            $old_value_array = $old_keys;
            $changes = 'Updated with attributes '.implode(', ',array_keys($old_keys)).' with '.implode(', ',array_values($old_keys)).' to '.implode(', ',array_values($list_changes));
        }
        $properties = ['attributes'=>$list_changes,'old' =>$old_value_array,'ip_address' =>$ip_address,'user_agent' =>$user_agent];
        $activity = activity()->causedBy(\Auth::user())->performedOn($list)->withProperties($properties)->log($changes.' made by '.\Auth::user()->first_name." ".\Auth::user()->last_name);
        return true;
    }

    public function logDeletedActivity($list,$changeLogs){
        $attributes = $this->unsetAttributes($list);
        $properties = ['attributes' => $attributes->toArray()];
        $activity = activity()->causedBy(\Auth::user())->performedOn($list)->withProperties($properties)->log($changeLogs);
    }

    public function logLoginDetails($user){
        $ip_address = request()->getClientIp();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $updated_at = Carbon::now()->format('d/m/Y H:i:s');
        $properties = ['attributes' =>['name'=>$user->user_name,'description'=>'Login into the system by '.$updated_at],'ip_address'=>$ip_address,'user_agent'=>$user_agent];
        $changes = 'User '.\Auth::user()->first_name." ".\Auth::user()->last_name.' loged in into the system';
        $activity = activity()->causedBy(\Auth::user())->performedOn($user)->withProperties($properties)->log($changes);
        return true;
    }

    public function logLogout($user){
        $ip_address = request()->getClientIp();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $updated_at = Carbon::now()->format('d/m/Y H:i:s');
        $properties = ['attributes' =>['name'=>$user->first_name." ".$user->last_name,'description'=>'Logout from the system by '.$updated_at],'ip_address'=>$ip_address,'user_agent'=>$user_agent];
        $changes = 'User '.$user->first_name." ".$user->last_name.' logedout from the system';
        $activity = activity()->causedBy(\Auth::user())->performedOn($user)->withProperties($properties)->log($changes);
        return true;
    }

    public function unsetAttributes($model){
        unset($model->created_at);
        unset($model->updated_at);
        return $model;
    }
}