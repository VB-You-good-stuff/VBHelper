<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guestbook extends Model
{
    use HasFactory;
    public $timestamps = false;
    use SoftDeletes;
    protected $fillable = [
        'owner',
        'name',
        'article',
        'created_at',
        'updated_at',
        'last_content_time',
    ];
}
