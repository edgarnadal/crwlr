<?php

namespace Crwlr\Crawlers\AlSuper;

use Symfony\Component\DomCrawler\Crawler;
use Crwlr\Crawlers\AlSuper\CategoryPageCrawler;

class NextCategoryPageCrawler extends CategoryPageCrawler
{
    public function run(Crawler $crawler)
    {
        $this->processProducts($crawler);
        $this->processNextPage($crawler);
    }
}
