<?php

namespace App\Http\Controllers;
use App\category;
use App\subcategory;
use App\productcurd;
use Illuminate\Http\Request;
use FILE;

/*
 * productcurdController Class
 * This controller contains methods for Get Data
 * @category Class
 * @author brinda jani
 */

class productcurdcontroller extends Controller {
   
    
    /**
     * View Page
     * @param $productcurd
     * @author brinda jani
     * @return view page
     */
    public function index() {
        $productcurd = productcurd::paginate(10);
        return view('index', compact('productcurd'));
    }

    /**
     * Create Page
     * @author brinda jani
     * @return add product page
     */
    public function create() {
        $category = category::all();
        return view('add', compact('category'));
    }

    /**
     * Add product Data
     * @param  Request $request
     * @author brinda jani
     * @return index page
     */
    public function store(Request $request) {
      
        request()->validate([
          'name' => 'required|alpha_num|max:255',
            'description' => 'required|alpha_num|max:255',
            'image' => 'required ',
            'price' => 'required|numeric',
            'colour' => 'required',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|after:start_date',
            'category' => 'required',
            'subcategory' => 'required',
        ]);
        [
            'name.required' => 'Product Name Field should be maximun 255',
            'description.required' => 'Product description Field Must be Required',
            'image.required' => ' image Field Must be in jpeg,jpg,gif,png',
            'price.required' => 'Product price Field Must be number',
            'colour.required' => 'Product colour Field Must be Required',
            'start_date.required' => 'Product start date Field Must be smaller than end date ',
            'end_date.required' => 'Product end date Field Must be greater than start date ',
            'category.required' => 'Product category Field Must be Required',
            'subcategory.required' => 'Product sub_category Field Must be Required',
        ];

        
        $saveData = productcurd::addproduct($request->all());
        return redirect('/index')->with('message', 'data inserted');
    }

    /**
     * Edit product Data
     * @param  $productId
     * @author brinda jani
     * @return edit page
     */
    public function edit($productId) {
        $product = productcurd::edit($productId);
        $category = category::all();
        $sub_category = subcategory::all();
 //dd( $product);
        return view('/edit', compact('product', 'category', 'sub_category'));
    
    }

    /**
     * update product Data of specific Id
     * @param  $request ,$productId
     * @author brinda jani
     * @return view page
     */
    public function update(Request $request,$productId) {
      
        request()->validate([
                'name' => 'required|alpha_num|max:255',
                'description' => 'required|alpha_num|max:255',
                'image' => 'required',
                'price' => 'required|numeric',
                'colour' => 'required',
                'start_date' => 'required|date|before:end_date',
                'end_date' => 'required|after:start_date',
                'category' => 'required',
                'subcategory' => 'required',
        ]);
        [
            'name.required' => 'Product Name Field should be maximun 255',
            'description.required' => 'Product description Field Must be Required',
            'image.required' => 'Product image Field Must be Required',
            'price.required' => 'Product price Field Must be number',
            'colour.required' => 'Product colour Field Must be Required',
            'start_date.required' => 'Product start date Field Must be smaller than end date ',
            'end_date.required' => 'Product end date Field Must be greater than start date ',
            'category.required' => 'Product category Field Must be Required',
            'subcategory.required' => 'Product sub_category Field Must be Required',
        ];
       
        //dd($request->all());
         $save = productcurd::updateData($request->all(), $productId);
        return redirect('index')->with('message', 'data updated');
    }

    /**
     * delete product Data of specific Id
     * @param  $productId
     * @author brinda jani
     * @return view page
     */
    public function delete($productId) {

        $product = productcurd::deleteData($productId);
        $productcurd = productcurd::paginate(10);
        return view('/index', compact('productcurd'));
    }

    /**
     * fetch subcategory Data of specific name from specific category id
     * @param  $categoryID
     * @author brinda jani
     * @return add page
     */
    public function fetchdata($categoryID) {
        //  echo "<pre>";print_R($Id);die;
        $subcategory = category::with('subCategories')->find($categoryID); 
       //dd($subcategory->subCategories);
        return json_encode($subcategory->subCategories);
    }
      
}
