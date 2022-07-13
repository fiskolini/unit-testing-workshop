<?php
declare(strict_types=1);

namespace App\Catalog\Exception;

final class AmountBelowZeroException extends \InvalidArgumentException
{
    /**
     * @param int $amountInCents
     */
    public function __construct(int $amountInCents)
    {
        parent::__construct('Money amount cannot be below zero, ' . $amountInCents . ' given');
    }
}
