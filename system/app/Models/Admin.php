<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'sekolah_id',
        'username',
        'email',
        'phone',
        'password',
        'foto_profil',
    ];

    public function sekolahs()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
