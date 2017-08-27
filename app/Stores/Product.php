<?php

namespace Crwlr\Stores;

use Crwlr\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'store_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['store_category_id', 'name', 'description', 'page_id', 'picture_url', 'price'];

    /**
     * Page relation
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
