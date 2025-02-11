<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User_Role;
use App\Models\Role;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'userId';
     protected $table = 'users';
    protected $guarded = ["userId"];
    protected $fillable = [
        'userName',
        'email',
        'password',
    ];

    public function User_Role() {
        return $this->hasMany(User_Role::class,'user_id','userId');
    }
    public function roles()
    {
        try {
            return $this->belongsToMany(Role::class, 'user_roles', foreignPivotKey: 'user_id', relatedPivotKey: 'role_id');
        } catch (\Exception $e) {
            report($e);
            return collect(); // Return an empty collection on failure
        }
    }
  
    public function hasRole($userId) {
        // dd($role);
        return $this->User_Role()->where('user_id', $userId)->first( ); // Ensure the correct column name
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
