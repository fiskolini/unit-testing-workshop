<?php
declare(strict_types=1);

namespace App\Catalog\SearchAnalytics;

use Symfony\Component\Filesystem\Filesystem;

final class FilesystemSearchAnalytics implements SearchAnalytics
{
    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @inheritDoc
     */
    public function track(array $searchFilters): void
    {
        // Silence is golden...
    }
}
