<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JumatanTime extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function ustadz() {
        return $this->belongsTo(Ustadz::class, 'ustadz_id');
    }

}
