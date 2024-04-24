<?php

declare(strict_types=1);

namespace Appleton\Datatable\Objects;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Traits\Macroable;

/**
 * @implements Arrayable<string, int|string|array<string, string>>
 */
final class Column implements Arrayable
{
    use Macroable;

    /**
     * Column constructor.
     *
     * @param array<string, int|string|array<string, string>> $column
     */
    public function __construct(private readonly array $column)
    {
    }

    public function data(): ?string
    {
        /** @var string|null $data */
        $data = $this->column['data'] ?? null;

        return $data;
    }

    public function hasData(?Closure $closure = null, bool $result = true): mixed
    {
        $bool = $this->data() !== null;

        if (is_callable($closure) && $bool === $result) {
            return $closure($this);
        }

        return $bool;
    }

    public function name(): ?string
    {
        /** @var string|null $name */
        $name = $this->column['name'] ?? null;

        return $name;
    }

    public function hasName(?Closure $closure = null, bool $result = true): mixed
    {
        $bool = $this->name() !== null;

        if (is_callable($closure) && $bool === $result) {
            return $closure($this);
        }

        return $bool;
    }

    public function searchable(?Closure $closure = null, bool $result = true): mixed
    {
        $bool = $this->column['searchable'] === 'true';

        if (is_callable($closure) && $bool === $result) {
            return $closure($this);
        }

        return $bool;
    }

    public function orderable(?Closure $closure = null, bool $result = true): mixed
    {
        $bool = $this->column['orderable'] === 'true';

        if (is_callable($closure) && $bool === $result) {
            return $closure($this);
        }

        return $bool;
    }

    public function searchValue(): ?string
    {
        return !empty($this->column['search']['value']) ? $this->column['search']['value'] : null;
    }

    public function hasSearchValue(?Closure $closure = null, bool $result = true): mixed
    {
        $bool = $this->searchValue() !== null;

        if (is_callable($closure) && $bool === $result) {
            return $closure($this);
        }

        return $bool;
    }

    public function isSearchRegex(?Closure $closure = null, bool $result = true): mixed
    {
        /** @var string|null $search */
        $search = Arr::get($this->column, 'search.regex');

        $bool = $search === 'true';

        if (is_callable($closure) && $bool === $result) {
            return $closure($this);
        }

        return $bool;
    }

    /**
     * @return array<string, int|string|array<string, string>>
     */
    public function toArray(): array
    {
        return $this->column;
    }
}