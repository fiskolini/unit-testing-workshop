<?php
declare(strict_types=1);

namespace App\Catalog\Repository;

use App\AmountCalculator\Operation\DiscountOperation;
use App\Catalog\Value\Amount;
use App\Catalog\Value\Discount;
use App\Catalog\Value\Product;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineProductRepository implements ProductRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Product[]
     */
    public function findProducts(): array
    {
        $productDtos = $this->entityManager
            ->createQueryBuilder()
            ->select('product', 'discount')
            ->from(\App\Entity\Product::class, 'product')
            ->leftJoin('product.discounts', 'discount')
            ->getQuery()
            ->execute();

        return array_map(function (\App\Entity\Product $productDto): Product {
            return new Product(
                $productDto->name,
                $this->getProductPrice($productDto)
            );
        }, $productDtos);
    }

    private function getProductPrice(\App\Entity\Product $productDto): Amount
    {
        $cost = new Amount($productDto->cost);

        // No discounts, so return its main value
        if ($productDto->discounts->isEmpty()) {
            return $cost;
        }

        $priceOperations = [];

        foreach ($productDto->discounts as $discountDto) {
            $priceOperations[] = $this->getProductDiscount($discountDto);
        }

        return (new DiscountOperation($priceOperations))->applyTo($cost);
    }

    private function getProductDiscount(\App\Entity\Discount $discountDto): Discount
    {
        return $discountDto->type === 'amount' ?
            Discount::fromAmount($discountDto->value) :
            Discount::fromPercent((float)$discountDto->value / 100);
    }
}
