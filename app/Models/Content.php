<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'guest_id',
        'detail_account',
        'name',
        'detail',
        'floor',
        'created_at',
        'updated_at',
    ];
}
