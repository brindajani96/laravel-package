<?php

namespace App;

use DB;
use File;
use Illuminate\Database\Eloquent\Model;

/**
 * @category Class
 * @author  Brinda Jani
 *
 */
class productcurd extends Model {

    protected $table = 'productscurd';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'price', 'colour', 'start_date', 'end_date', 'category', 'sub_category'
    ];

    

    /*
     * Add and save product
     * @param type $request
     * @return boolean
     * @author brinda jani
     */

    public static function addproduct($request) {
        //dd($id);
        $categoryName = category::select('name')->where('id', $request['category'])->get()->toArray();
        //dd($categoryName[0]['name']);
        $subCategoryName = subcategory::select('name')->where('id', $request['subcategory'])->get()->toArray();
        //dd(($subCategoryName[0]['name']));
        $subcategory = subcategory::all();
        $productdata = new productcurd;
        $productdata->name = $request['name'];
        $productdata->description = $request['description'];
        $productdata->image = $request['image'];
        $productdata->price = $request['price'];
        $productdata->colour = $request['colour'];
        $productdata->start_date = $request['start_date'];
        $productdata->end_date = $request['end_date'];
        $productdata->category_name = ($categoryName[0]['name']);
        $productdata->subcategory_name = ($subCategoryName[0]['name']);
        //dd($request['subcategory']);

        if ($productdata->save()) {
            return true;
        }
        return false;
    }

    /**
     * edit  Data
     * @param Id $productId
     * @return Boolean
     */
    public static function edit($productId) {
        $query = self::select('id', 'name', 'description', 'image', 'price', 'colour', 'start_date', 'end_date', 'category', 'sub_category')->where('id', $productId)->get()->toArray();
       
        return $query;
    }

    /*
     * update product with specific id
     * @param type $request and $id
     * @return return view page
     * @author brinda jani
     */

    public static function updateData($request, $id) {
        // dd($id);
        $categoryName = \App\category::select('name')->where('id', $request['category'])->get()->toArray();
            //dd($categoryName[0]['name']);
        $subCategoryName = \App\subcategory::select('name')->where('id', $request['subcategory'])->get()->toArray();
        //dd(($subCategoryName[0]['name']));
        $subcategory = subcategory::all();
        return self::where('id', $id)->update([
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'image' =>  $request['image'],
                    'price' => $request['price'],
                    'colour' => $request['colour'],
                    'start_date' => $request['start_date'],
                    'end_date' => $request['end_date'],
                    'category'=> $request['category'],
                    'sub_category'=> $request['subcategory'],
                    'category_name' => ($categoryName[0]['name']),
                    'subcategory_name' => ($subCategoryName[0]['name']),
                        //dd($request['subcategory']),
       ]);
    }

    /*
     * delete product with specific id
     * @param type $productId
     * @return view page
     * @author brinda jani
     */

    public static function deleteData($productId) {
        return self::where('id', $productId)->delete();
    }

}
