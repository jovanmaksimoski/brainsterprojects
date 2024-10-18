<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendas extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'date',
    ];
    public function events()
    {
        return $this->hasMany(Event::class, 'agendas_id');
    }


    public function conferences()
    {
        return $this->hasMany(Conference::class, 'agendas_id');
    }


    public function speakers()
    {
        return $this->hasMany(EventSpeaker::class, 'event_id');
    }


    public function specialGuests()
    {
        return $this->hasMany(SpecialGuestsSpeaker::class, 'conferences_id');
    }
}
