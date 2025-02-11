<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\User_Role;
use App\Models\Role_Permission;
use App\Models\User;
class Role extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'roles';
    protected $guarderd=["roleId"];
    protected $primaryKey = 'roleId';
    protected $fillable = [
        'roleName',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }
    public function User_Role(){
        return $this->hasMany(User_Role::class,'role_id','roleId');
    }
    public function Role_Permission(){
        return $this->hasMany(Role_Permission::class,'role_id','roleId');
    }
}
