<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password','dni','personal_id',// 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function findById($id)
    {
        if($id){
           $user = static::where('id', $id)->first();
           if($user){
             return $user;
         }
       }return null;
    }
    public function getRol()
    {
     $roles=$this->getRoleNames();
     foreach ($roles as $role) {
       return $role;
       break;
     }
    }
    public function personal()
    {
      return $this->belongsTo('App\Personal', 'personal_id');
    }
}
