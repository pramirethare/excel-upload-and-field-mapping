<?php

namespace App\Imports;
use Modules\Product\Entities\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        echo 'dasdasadas';
        // dd($collection);
    }
}
