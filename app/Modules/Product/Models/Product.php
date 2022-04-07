<?php

namespace App\Modules\Product\Models;

use App\Modules\Category\Models\Category;
use App\Modules\Colour\Models\Colour;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table ="product";

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function colour()
    {
        return $this->belongsTo(Colour::class,'colour_id','id');
    }
}
