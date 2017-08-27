<?php

namespace Crwlr\Crawlers\AlSuper;

use Symfony\Component\DomCrawler\Crawler;
use Crwlr\Crawlers\AlSuper\ProductPageCrawler;

class ProductRefsPageCrawler extends ProductPageCrawler
{
    public function run(Crawler $crawler)
    {
        $this->processProductInfo($crawler);
    }
}
