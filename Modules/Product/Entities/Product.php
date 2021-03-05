<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Entities\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title','sku','description','price','quantity'];
    public static $fields = [
        'title' => 'Title',
        'sku' => 'SKU',
        'description' => 'Description',
        'price' => 'Price',
        'quantity' => 'Quantity'
    ];
    protected static function newFactory()
    {
        // return \Modules\Product\Database\factories\ProductFactory::new();
    }

    public static function saveAttachments($file)
    {
        $destinationPath = "uploads/product/";
        $ext = $file->extension();
        $fileName = 'Products.'.$ext;
        $upload = $file->move($destinationPath, $fileName);
        if ($upload) {
            return true;
        }
        return false;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
