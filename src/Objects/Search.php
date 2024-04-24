<?php

declare(strict_types=1);

namespace Appleton\Datatable\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Macroable;

/**
 * @implements Arrayable<int, array<string, string>>
 */
final class Search implements Arrayable
{
    use Macroable;

    /**
     * @param array<string, string> $search
     */
    public function __construct(private readonly array $search)
    {
    }

    public function value(): ?string
    {
        return !empty($this->search['value']) ? $this->search['value'] : null;
    }

    public function regex(): bool
    {
        /** @var string|null $regex */
        $regex = Arr::get($this->search, 'regex');

        return $regex === 'true';
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return $this->search;
    }
}