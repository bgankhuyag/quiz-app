<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    use HasFactory;
    protected $table = 'points';

    protected $fillable = ['users_id', 'points', 'categories_id'];
}
