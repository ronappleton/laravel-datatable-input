<?php

declare(strict_types=1);

namespace Appleton\Datatable\Objects;

use Appleton\Datatable\Inputs\RequestInput;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Macroable;

/**
 * @implements Arrayable<int, array<string, int|string|null>>
 */
final class Order implements Arrayable
{
    use Macroable;

    /**
     * @param array<string, int|string|null> $order
     */
    public function __construct(private readonly array $order)
    {
    }

    public function column(?RequestInput $input = null): int|string|null
    {
        if (is_null($this->order['column'])) {
            return null;
        }

        if (!is_null($input)) {
            return $input->getColumnByIndex((int) $this->order['column'])?->name() ?? null;
        }


        return (int) $this->order['column'];
    }

    public function direction(): ?string
    {
        /** @var string|null $direction */
        $direction = Arr::get($this->order, 'dir');

        return $direction;
    }

    /**
     * @return array<string, int|string|null>
     */
    public function toArray(): array
    {
        return $this->order;
    }
}