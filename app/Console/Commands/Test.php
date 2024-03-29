<?php

namespace Crwlr\Console\Commands;

use Crwlr\Stores\Store;
use Illuminate\Console\Command;
use Crwlr\Crawlers\AlSuper\ProductPageCrawler;
use Crwlr\Crawlers\AlSuper\CategoriesPageCrawler;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // ProductPageCrawler::dispatch(Store::first(), 'http://www.alsuper.do/productos/detail/refresco-coca-cola-light-20-oz');
        CategoriesPageCrawler::dispatch(Store::first(), 'http://alsuper.com.do');
    }
}
