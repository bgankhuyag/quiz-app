<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;
    protected $table = 'answers';

    public function option() {
        return $this->belongsTo(Options::class, 'options_id');
    }

}
