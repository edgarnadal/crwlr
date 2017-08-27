<?php

namespace Crwlr\Crawlers\AlSuper;

use Crwlr\Crawlers\Crawl;
use Symfony\Component\DomCrawler\Crawler;

class CategoriesPageCrawler extends Crawl
{
    protected function run(Crawler $crawler)
    {
        $crawler
            ->filter('.subfolderstyle')
            ->each(function (Crawler $node) {
                $this->crawl($node->attr('href'), CategoryPageCrawler::class);
            });
    }
}
