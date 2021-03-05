<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    
    protected static function newFactory()
    {
        // return \Modules\Category\Database\factories\CategoryFactory::new();
    }
}
