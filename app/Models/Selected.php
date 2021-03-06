<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selected extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $table = 'selecteds';

    protected $guarded = ['id'];

    protected $fillable = ['questions_id', 'options_id', 'users_id'];

    public function question() {
      return $this->belongsTo(Questions::class, 'questions_id');
    }

    public function user() {
      return $this->belongsTo(User::class, 'users_id');
    }

    public function option() {
      return $this->belongsTo(Options::class, 'options_id');
    }
}
