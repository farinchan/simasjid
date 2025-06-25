<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvSetup extends Model
{
    protected $table = 'tv_setup';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

}
