<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MasterAdmin extends Authenticatable
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'master_admins';
    protected $fillable = [
        'username',
        'email',
        'password',
        'foto_profil',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
