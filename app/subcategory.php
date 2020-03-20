<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcategory extends Model {
    
    protected $table = 'subcategory';
    protected $fillable = ['id','category_id','name'];
    public function category()
    {
    return $this->belongsTo('App\Category');
    }

//    public static function getsubCategory($id) { {
//
//            $subcategory = self::select('name', 'id')->where("category_id", $id)->get()->toArray();
//            //dd($subcategory);
//            return $subcategory;
//        }
//    }

}
