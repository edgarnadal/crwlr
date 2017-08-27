<?php

namespace Crwlr\Stores;

use Crwlr\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'store_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'page_id', 'parent_id'];

    /**
     * Page relation
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
