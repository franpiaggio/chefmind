<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $filable = [
      'title', 'body', 'published_at' 
    ];
}
