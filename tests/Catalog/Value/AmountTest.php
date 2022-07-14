<?php
declare(strict_types=1);

namespace App\Tests\Catalog\Value;

use App\Catalog\Exception\AmountBelowZeroException;
use App\Catalog\Value\Amount;
use PHPUnit\Framework\TestCase;

final class AmountTest extends TestCase
{
    public function testGetCents_WithValidCents_ReturnsUnchangedCents(): void
    {
        $amount = new Amount(1000);
        $cents = $amount->getCents();
        self::assertEquals(1000, $cents);
    }
}
