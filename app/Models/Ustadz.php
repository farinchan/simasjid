<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ustadz extends Model
{
    protected $table = 'ustadz';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function getPhotoAttribute()
    {
        $photo = $this->attributes['photo'] ?? null;
        return $photo ? asset('storage/' . $photo) : "https://ui-avatars.com/api/?background=15365F&color=C3A356&size=128&name=" . $this->name;
    }
}
