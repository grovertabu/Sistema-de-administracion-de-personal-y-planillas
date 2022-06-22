<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use HasRoles;


    protected $fillable = [
        'name', 'username', 'password','tipo_user'
    ];


    protected $hidden = [
        'password',
    ];




    protected $appends = [
        'profile_photo_url',
    ];
    public function adminlte_desc(){
        return Auth()->user()->roles[0]->name;
    }
    public function adminlte_profile_url(){
        return "user/profile";
    }
    public function adminlte_image()
    {
        return asset('images/default-avatar.jpg');
    }




}
