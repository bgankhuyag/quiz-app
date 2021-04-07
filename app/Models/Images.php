<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
  use CrudTrait;
    use HasFactory;
    protected $table = 'images';

    protected $guarded = ['id'];

    protected $appends = ['name'];

    public function getNameAttribute() {
      return url(asset('images')) . '/' . $this->attributes['name'];
    }
}
