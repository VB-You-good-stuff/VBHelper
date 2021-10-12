<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guestbook extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'owner',
        'name',
        'article',
        'created_at',
        'updated_at',
        'last_content_time',
    ];
}
