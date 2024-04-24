<?php

declare(strict_types=1);

namespace Appleton\Datatable\Inputs;

use Appleton\Datatable\Objects\Column;
use Appleton\Datatable\Objects\Order;
use Appleton\Datatable\Objects\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RequestInput
{
    /**
     * @var array<int, string>
     */
    protected array $relevantKeys = [
        'draw',
        'start',
        'length',
        'search',
        'order',
        'columns',
    ];

    /**
     * @var Collection<int|string, mixed>
     */
    protected Collection $input;

    public function __construct(Request $request)
    {
        $this->input = collect($request->only($this->relevantKeys));
    }

    public function getDraw(): ?int
    {
        /** @var int|null $draw */
        $draw = $this->input->get('draw');

        return $draw;
    }

    public function getStart(): ?int
    {
        /** @var int|null $start */
        $start = $this->input->get('start');

        return $start;
    }

    public function getLength(): ?int
    {
        /** @var int|null $length */
        $length = $this->input->get('length');

        return $length;
    }

    public function getSearch(): ?Search
    {
        if (! $this->input->has('search')) {
            return null;
        }

        /** @var array<string, string> $search */
        $search = $this->input->get('search');

        return new Search($search);
    }

    /**
     * @return Collection<int, Order>|null
     */
    public function getOrders(): ?Collection
    {
        /** @var array<int, array<string, string>>|null $order */
        $order = $this->input->get('order');

        if ($order === null) {
            return null;
        }

        $orders = collect($order)->map(fn ($order) => new Order($order));

        return $orders->isNotEmpty() ? $orders : null;
    }

    /**
     * @return Collection<int, Column>|null
     */
    public function getColumns(): ?Collection
    {
        /** @var array<int, array<string, string>>|null $columns */
        $columns = $this->input->get('columns');

        if ($columns === null) {
            return null;
        }

        $columns = collect($columns)->map(fn (array $column) => new Column($column));

        return $columns->isNotEmpty() ? $columns : null;
    }

    public function getColumnByName(string $name): ?Column
    {
        $column = $this->getColumns()?->filter(fn (Column $column) => $column->name() === $name)->first() ?? null;

        return $column instanceof Column ? $column : null;
    }

    public function getColumnByIndex(int $index): ?Column
    {
        return $this->getColumns()?->get($index) ?? null;
    }
}