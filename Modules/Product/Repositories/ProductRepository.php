<?php

namespace Modules\Product\Repositories;

use Exception;
use Modules\Product\Repositories\ProductRepositoryInterface;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{
    public function index()
    {
        $products = Product::paginate(5);
        return view('product::index',compact('products'));
    }

    public function store($request)
    {
        try {
            $upload = Product::saveAttachments($request->file('attachment'));
            if ($upload) {
                return $this->showMessage('success','File uploaded successfully.',200);
            } else {
                return $this->showMessage('failure', 'Unable to upload the file.', 500);
            }
        } catch (Exception $e) {
            return $this->showMessage('failure', 'Something went wrong.', 500);
        }

        
    }

    public function showMessage($status, $message, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $statusCode);
    }

    public function map()
    {
        $filePath = public_path('/uploads/product/Products.xlsx');
        $headings = (new HeadingRowImport)->toArray($filePath)[0][0];
        $headings = array_filter($headings, function ($data) {
            return strtolower($data) != 'category';
        });
        $columns = Product::$fields;
        return view('product::product.map',compact('columns','headings'));
    }

    public function import($request)
    {
        try {

            $excel = Excel::toArray(new ProductImport, public_path('uploads/product/Products.xlsx'));
            $keyMapping = ($request->toArray())['header'];
            DB::beginTransaction();

            foreach ($excel[0] as $key => $value)
            {
                $data = [];
                $categoryId = [];

                if ($key != 0) {
                    $categories = explode("|", $value[count($value) - 1]) ;

                    foreach($categories as $category){
                        $checkCategory = Category::where('title',$category);
                        if ($checkCategory->exists())
                        {
                            array_push($categoryId, $checkCategory->first()->id);
                        } else {
                            $newCategory = Category::create(['title' => $category]);
                            array_push($categoryId, $newCategory->id);
                        }
                    }
                    
                    foreach ($keyMapping as $mKey => $mValue)
                    {
                        $data[$mKey] = $value[$keyMapping[$mKey]];
                    }
                    
                    $product = Product::updateOrCreate(['sku' => $data['sku']], $data);
                    $product->categories()->sync($categoryId);
                } 
            }
            DB::commit();

            return redirect(route('index'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->showMessage('failure', 'Something went wrong.', 500);
        }
    }

    public function download()
    {
        return response()->download(public_path("Products.xlsx"));
    }
}