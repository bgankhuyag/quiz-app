<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
  use CrudTrait;
    use HasFactory;
    protected $table = 'answers';

    protected $guarded = ['id'];

    public function option() {
        return $this->belongsTo(Options::class, 'options_id');
    }

}
