<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialGuestsSpeaker extends Model
{
    use HasFactory;


    protected $fillable = [
        'conferences_id',
        'name',
        'title',
        'category'
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class, 'conference_id');
    }


}
