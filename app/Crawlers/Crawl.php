<?php

namespace Crwlr\Crawlers;

use Carbon\Carbon;
use Crwlr\Pages\Page;
use Crwlr\Stores\Store;
use Crwlr\Pages\Referrer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

abstract class Crawl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * [$store description]
     * @var [type]
     */
    protected $store;

    /**
     * [$page description]
     * @var [type]
     */
    protected $page;

    /**
     * [$referrer description]
     * @var [type]
     */
    protected $referrer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Store $store, $page, $referrer = null)
    {
        $this->store = $store;

        $this->page = Page::firstOrCreate(['url' => $page], [
            'store_id' => $store->id
        ]);

        $this->referrer = $referrer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // crawl
        $this->run($this->getCrawler());

        // update the page and referrer
        $this->updatePage();
        $this->updateReferrer();

    }

    abstract protected function run(Crawler $crawler);

    /**
     * [fw description]
     *
     * @param  [type] $page    [description]
     * @param  Crawl  $crawler [description]
     * @return [type]          [description]
     */
    protected function crawl($page, $crawler)
    {
        dispatch(new $crawler($this->store, $page, $this->page));
    }

    /**
     * Update or create the page eloquent model
     *
     * @return Page
     */
    private function updatePage(): Page
    {
        $this->page->crawled_at = Carbon::now();
        $this->page->crawled += 1;
        $this->page->save();

        return $this->page;
    }

    /**
     * [updateReferrer description]
     *
     * @return [type] [description]
     */
    private function updateReferrer() //: Referrer
    {

    }

    /**
     * Get crawler instance for the given page url
     *
     * @return Crawler
     */
    private function getCrawler(): Crawler
    {
        $crawler = new Crawler(file_get_contents($this->page->url));

        // update the page title
        $this->page->title = $crawler->filterXPath('//title')->text();

        return $crawler;
    }

    public function store(): Store
    {
        return $this->store;
    }

    public function page(): Page
    {
        return $this->page;
    }
}


// public function getProducts($page)
// {
//     $crawler = new Crawler(file_get_contents('http://www.alsuper.do/productos/categorie_products/aceites'));

//     $crawler = $crawler
//         ->filter('.product-item > .img > a')
//         ->each(function (Crawler $node, $i) {
//             var_dump($node->attr('href'));
//         });
// }

// public function getCategoryPages()
// {
//     $crawler = new Crawler(file_get_contents('http://www.alsuper.do/productos/categorie_products/aceites'));

//     $crawler = $crawler
//         ->filter('#cat_product_sort > .paginationf > a')
//         ->last();

//     var_dump($crawler->attr('href'));

//         // ->reduce(function (Crawler $node, $i) {

//         //     dd($node);
//         //     if ($node->attr('text') === '>') {
//         //         return false;
//         //     }
//         // })
//         // ->each(function (Crawler $node, $i) {
//         //     var_dump($node->attr('href'));
//         // });
// }

