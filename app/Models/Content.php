<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory;
    use SoftDeletes;
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
