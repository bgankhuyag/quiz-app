<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    protected $guarded = ['id'];

    public function category() {
      return $this->belongsTo(Categories::class, 'categories_id');
    }
}
