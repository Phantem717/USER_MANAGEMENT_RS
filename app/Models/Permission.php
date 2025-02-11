<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role_Permission;

class Permission extends Model
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $table = "permissions";
    protected $guarded = ["permissionId"];
    protected $primaryKey = 'permissionId';
    protected $fillable = [
    'permissionName',
    'description',
    ];

    public function Role_Permission(){
return $this->hasMany(Role_Permission::class,'permission_id','permissionId');
    }


}
