<?php

declare(strict_types=1);

namespace App\Contracts\Common\Dto;

use InvalidArgumentException;

/**
 * @template T
 */
abstract class PaginatedData
{
    protected static string $instance;

    /**
     * @param array<T> $items
     */
    public function __construct(
        readonly public array $items,
        readonly public int $page,
        readonly public int $perPage,
        readonly public int $total,
    ) {
        $this->validateItems($this->items);
    }

    /**
     * @param array<T> $items
     */
    protected function validateItems(array $items): void
    {
        array_map(function ($item) {
            if (!($item instanceof $this::$instance)) {
                throw new InvalidArgumentException(
                    'Objects must be an instance of a class: ' . $this::$instance
                );
            }
        }, $items);
    }
}
