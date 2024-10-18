<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSpeaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'title',
        'social_media'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class , 'event_id');
    }


}
