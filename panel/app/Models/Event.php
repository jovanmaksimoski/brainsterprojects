<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'theme',
        'description',
        'objective',
        'location',
        'date',
        'ticket_price',
        'agendas_id'
    ];

    public function agenda()
    {

        return $this->belongsTo(Agendas::class, 'agendas_id');
    }







}
