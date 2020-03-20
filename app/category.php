<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model {
    
    protected $table = 'category';
    protected $fillable = ['id','name'];
    public function subCategories()
    {
    return $this->hasMany('\App\subcategory','category_id');
    }
//    public static function getCategory() { {
//            $category = self::select("name", "id")->get()->toArray();
//            return $category;
////  print_R($category);die;
//        }
//    }

}
