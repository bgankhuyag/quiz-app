<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selected extends Model
{
    use HasFactory;
    protected $table = 'selecteds';

    protected $fillable = ['questions_id', 'options_id'];
}
