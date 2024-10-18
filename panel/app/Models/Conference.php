<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'theme',
        'description',
        'objective',
        'location',
        'date',
        'status',
        'agendas_id'
    ];

    public function agenda()
    {
        return $this->belongsTo(Agendas::class, 'agendas_id');
    }




}
