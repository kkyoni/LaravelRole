<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable{
    use Notifiable,SoftDeletes;
    public $table = 'users';
    protected $fillable = ['user_name','first_name','last_name','email','password','pin','address_line_1','address_line_2','phone_no','city','zip_code','state','country','user_type','role_id','ref_id','status'];
    protected $hidden = ['password', 'remember_token' ];

    public function role(){
        return $this->hasOne(Role::class,'id','role_id');
    }

    public function referralCount(){
        return $this->hasMany(\App\Models\User::class,'ref_id','id');
    }
}