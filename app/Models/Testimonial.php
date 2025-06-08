<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Testimonial extends Model
{
    use HasFactory, LogsActivity;
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logUnguarded()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    }
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getPhoto()
    {
        return $this->photo ? asset('storage/' . $this->photo) : "https://ui-avatars.com/api/?background=A58672&color=fff&size=128&name=" . $this->name;
    }

    public function getAvatar()
    {
        return $this->photo ? asset('storage/' . $this->photo) : "https://api.dicebear.com/9.x/bottts/jpg?seed=" . $this->name;
    }
}
