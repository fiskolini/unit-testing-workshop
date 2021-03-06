<?php

namespace App\Tests\Catalog\Handler;

use App\Catalog\Handler\ProductListHandler;
use App\Catalog\Repository\ProductRepository;
use App\Catalog\SearchAnalytics\SearchAnalytics;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class ProductListHandlerTest extends TestCase
{
    public function testHandleProductList_searchAnalyticsTrack_shouldBeCalledOnce(): void
    {
        $repository = $this->createStub(ProductRepository::class);
        $searchAnalytics = $this->createMock(SearchAnalytics::class);
        $serverRequest = $this->createStub(ServerRequestInterface::class);

        $searchAnalytics
            ->expects($this->once())
            ->method('track')
            ->with(['price' => null, 'name' => null]);

        $handler = new ProductListHandler($repository, $searchAnalytics);
        $handler->handle($serverRequest);
    }
}
