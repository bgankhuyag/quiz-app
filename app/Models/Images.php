<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $table = 'images';

    protected $appends = ['name'];

    public function getNameAttribute() {
      return url(asset('images')) . '/' . $this->attributes['name'];
    }
}
