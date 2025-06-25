<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceCategory extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
}
