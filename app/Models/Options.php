<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
  use CrudTrait;
    use HasFactory;
    protected $table = 'options';

    protected $guarded = ['id'];

    public function question() {
      return $this->belongsTo(Questions::class, 'questions_id');
    }
}
