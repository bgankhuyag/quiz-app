<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Questions extends Model
{
  use CrudTrait;
    use HasFactory;
    protected $table = 'questions';

    protected $appends = ['image'];

    public function getImageAttribute() {
      if ($this->attributes['image'] != NULL) {
        // return url(asset('images')) . '/' . $this->attributes['image'];
        // dd(Storage::disk('s3')->url($this->attributes['image']));
        return Storage::disk('s3')->url($this->attributes['image']);
      }
    }

    protected $guarded = ['id'];

    public function options() {
        return $this->hasMany(Options::class);
    }

    public function answer() {
        return $this->hasOne(Answers::class)->select(['options_id', 'questions_id']);
    }

    public function selected() {
        return $this->hasMany(Selected::class);
    }

    public function category() {
      return $this->belongsTo(Categories::class, 'categories_id');
    }

    public function subcategory() {
      return $this->belongsTo(SubCategories::class, 'sub_categories_id');
    }

    public function correct_option() {
      return $this->belongsTo(Options::class, 'correct_option_id');
    }
}
