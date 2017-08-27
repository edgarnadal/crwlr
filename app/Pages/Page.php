<?php

namespace Crwlr\Pages;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'crawled_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['store_id', 'url', 'title'];
}
