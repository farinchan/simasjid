<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvPage extends Model
{
    protected $table = 'tv_page';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

}
