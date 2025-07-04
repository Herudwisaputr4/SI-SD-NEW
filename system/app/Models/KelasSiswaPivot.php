<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class KelasSiswaPivot extends Pivot
{
    protected $table = 'kelas_siswa_pivots';
    public $timestamps = true;
    protected $fillable = [
        'siswa_id',
        'kelas_id'
    ];
}
