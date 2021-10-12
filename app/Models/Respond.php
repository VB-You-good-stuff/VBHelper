<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respond extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'content_id',
        'reply_account',
        'name',
        'reply',
        'created_at',
        'updated_at',
    ];
}
