<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Role;

class User_Role extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $guarded = ["userRoleId"];
    protected $table = "user_roles";
    protected $primaryKey = 'userRoleId';
    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'user_id','userId');
    }
    
    public function Role(){
        return $this->belongsTo(Role::class, 'role_id','roleId');
    }
}
