<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Message;
 
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    
    public $timestamps = false;

    protected $fillable = [
        'id','full_name','type' , 'email', 'password','phone'//,'updated_at','created_at'//'email_verified_at',
    ];

    protected $hidden = [
        'password', 'remember_token' ,//'updated_at','created_at'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function messages()
    {
    return $this->hasMany(Message::class);
    }
        // Rest omitted for brevity

    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

 
 
