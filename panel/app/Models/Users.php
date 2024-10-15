<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $fillable = [
        'name',
        'surname',
        'bio',
        'title',
        'phone',
        'city',
        'country',
        'cv_upload',
        'photo_upload',
        'email',
        'password',
    ];
}
