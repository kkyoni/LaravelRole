<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class RoleHasPermissions extends Model{
    protected $table='role_has_permissions';

    public function permission(){
        return $this->hasMany(Permission::class,'id','permission_id');
    }
}