<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Permission;
use App\Models\Role;
class Role_Permission extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $table = 'role_permissions';
    protected $guarded = ['rolePermissionId'];
protected $primaryKey= 'rolePermissionId';
    protected $fillable = [
        'role_id',
        'permission_id'
    ];

    public function Permission(){
        return $this->belongsTo(Permission::class,'permission_id','permissionId');
    }

    public function Role(){
        return $this->belongsTo(Role::class, 'role_id','roleId');
    }
}
