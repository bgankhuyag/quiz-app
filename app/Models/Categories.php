<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
  use CrudTrait;
    use HasFactory;
    protected $table = 'categories';

    protected $guarded = ['id'];

    public function sub_category() {
      return $this->hasMany(SubCategories::class);
    }

    protected $appends = ['image'];

    public function getImageAttribute() {
      // dd(in_array('image', $this->attributes));
      if ($this->attributes['image'] != null) {
        return url(asset('images')) . '/' . $this->attributes['image'];
      }
    }

    public function questions() {
      return $this->hasMany(Questions::class);
    }
}
