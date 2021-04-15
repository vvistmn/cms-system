<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getCreatedAtAttribute($value)
    {
        $date = Carbon::now();
        $value = Carbon::create($value);

        if ($date->format('F d, Y') == $value->format('F d, Y')) {
            return $value->diffForHumans();
        }
        return $value->format('F d, Y');
    }

    public function getUpdatedAtAttribute($value)
    {
        $date = Carbon::now();
        $value = Carbon::create($value);

        if ($date->format('F d, Y') == $value->format('F d, Y')) {
            return $value->diffForHumans();
        }
        return $value->format('F d, Y');
    }

    public function getAvatarAttribute($value)
    {
        if (stripos($value, 'http') !== false) {
            return $value;
        } else {
           return asset('storage/' . $value);
        }
    }

    public function posts ()
    {
        return $this->hasMany(Post::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function userHasRole($roleName)
    {
        foreach ($this->roles as $role) {
            if (Str::lower($role->name) === Str::lower($roleName)) {
                return true;
            }
        }

        return false;
    }
}
