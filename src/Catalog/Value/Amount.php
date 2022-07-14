<?php
declare(strict_types=1);

namespace App\Catalog\Value;


final class Amount
{
    private int $cents;

    // TODO #01 cover this with unit test
    public function __construct(int $cents)
    {
        $this->cents = $cents;
    }

    public function getCents(): int
    {
        return $this->cents;
    }
}
