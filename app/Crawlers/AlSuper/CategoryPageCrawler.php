<?php

namespace Crwlr\Crawlers\AlSuper;

use Crwlr\Crawlers\Crawl;
use Symfony\Component\DomCrawler\Crawler;
use Crwlr\Crawlers\AlSuper\NextCategoryPageCrawler;

class CategoryPageCrawler extends Crawl
{
    public function run(Crawler $crawler)
    {
        $category = $this->processCategoryName($crawler);
        $this->processProducts($crawler);
        $this->processSubcategories($crawler, $category);
        $this->processNextPage($crawler);

    }

    /**
     * [processCategoryName description]
     *
     * @param  Crawler $crawler [description]
     * @return [type]           [description]
     */
    protected function processCategoryName(Crawler $crawler)
    {
        $category = $crawler->filter('h2 a')->first()->text();

        return $this->store()->category()->updateOrCreate(['name' => $category], [
            'description' => null,
            'page_id' => $this->page()->id
        ]);
    }

    /**
     * [processProducts description]
     *
     * @param  Crawler $crawler [description]
     * @return [type]           [description]
     */
    protected function processProducts(Crawler $crawler)
    {
        $crawler
            ->filter('div.product-container:nth-of-type(1) span.desc a')
            ->each(function (Crawler $node) {
                $this->crawl($node->attr('href'), ProductPageCrawler::class);
            });
    }

    /**
     * [processSubcategories description]
     *
     * @param  Crawler $crawler  [description]
     * @param  [type]  $category [description]
     * @return [type]            [description]
     */
    protected function processSubcategories(Crawler $crawler, $category)
    {
        $crawler
            ->filter('div.cpt_maincontent li a')
            ->each(function (Crawler $node) use ($category) {

                $this->store()->category()->updateOrCreate(['name' => $node->text()], [
                    'parent_id' => $category->id
                ]);

                $this->crawl($node->attr('href'), CategoryPageCrawler::class);
            });
    }

    /**
     * [processNextPage description]
     *
     * @param  Crawler $crawler [description]
     * @return [type]           [description]
     */
    protected function processNextPage(Crawler $crawler)
    {
        $node = $crawler->filter('div.cpt_maincontent p.paginationf a:last-of-type')->first();

        if ($node->count()) {
            $this->crawl($node->attr('href'), NextCategoryPageCrawler::class);
        }
    }
}
