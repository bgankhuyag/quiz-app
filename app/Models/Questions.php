<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $table = 'questions';

    public function options() {
        return $this->hasMany(Options::class);
    }

    public function answer() {
        return $this->hasOne(Answers::class)->select(['options_id', 'questions_id']);
    }

    public function selected() {
        return $this->hasOne(Selected::class);
    }

    public function subcategory() {
      return $this->belongsTo(SubCategories::class, 'sub_categories_id');
    }
}
