<?php

namespace Crwlr\Stores;

use Crwlr\Stores\Product;
use Crwlr\Stores\Category;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function category()
    {
        return $this->hasMany(Category::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
