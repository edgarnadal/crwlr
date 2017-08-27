<?php

namespace Crwlr\Crawlers\AlSuper;

use Crwlr\Crawlers\Crawl;
use Symfony\Component\DomCrawler\Crawler;
use Crwlr\Crawlers\AlSuper\ProductRefsPageCrawler;

class ProductPageCrawler extends Crawl
{
    public function run(Crawler $crawler)
    {
        $product = $this->processProductInfo($crawler);
        // $this->processRefs($crawler, $product);
    }

    /**
     * [processCategoryName description]
     *
     * @param  Crawler $crawler [description]
     * @return [type]           [description]
     */
    protected function processProductInfo(Crawler $crawler)
    {
        $category = $crawler->filter('h2')->first()->text();
        $category = $this->store->category()->whereName($category)->first();

        $name = $crawler->filter('h1')->first()->text();
        $description = $crawler->filter('div.cpt_product_description div')->first()->text();
        $picture_url = $crawler->filter('img.small_product')->first()->attr('src');
        $price = $crawler->filter('div.cpt_product_price')->first()->text();

        return $this->store()->product()->updateOrCreate(['page_id' => $this->page()->id], [
            'store_category_id' => $category->id,
            'name' => $name,
            'description' => $description,
            'picture_url' => $pictureUrl,
            'price' => $price
        ]);
    }

    /**
     * [processProducts description]
     *
     * @param  Crawler $crawler [description]
     * @return [type]           [description]
     */
    protected function processRefs(Crawler $crawler, $parent)
    {
        $crawler
            ->filter('div.product-liquidcarousel a')
            ->each(function (Crawler $node) {

                // save
                $this->crawl($node->attr('href'), ProductRefsPageCrawler::class);
            });
    }
}
