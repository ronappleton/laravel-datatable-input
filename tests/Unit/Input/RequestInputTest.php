<?php

declare(strict_types=1);

namespace Tests\Unit\Input;

use Appleton\Datatable\Inputs\RequestInput;
use Appleton\Datatable\Objects\Column;
use Appleton\Datatable\Objects\Order;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Http\Request;

/**
 * @covers \Appleton\Datatable\Inputs\RequestInput
 * @covers \Appleton\Datatable\Objects\Order
 * @covers \Appleton\Datatable\Objects\Column
 * @covers \Appleton\Datatable\Objects\Search
 */
class RequestInputTest extends TestCase
{
    protected array $fakeInput = [
        'draw' => 1,
        'start' => 0,
        'length' => 10,
        'search' => [
            'value' => '',
        ],
        'order' => [
            [
                'column' => 0,
                'dir' => 'asc',
            ],
        ],
        'columns' => [
            [
                'data' => 'id',
                'name' => 'id',
                'searchable' => true,
                'orderable' => true,
                'search' => [
                    'value' => '',
                    'regex' => false,
                ],
            ],
        ],
    ];

    protected RequestInput $requestInput;

    protected function setUp(): void
    {
        $request = new Request($this->fakeInput);

        $this->requestInput = new RequestInput($request);
    }

    public function testGetDrawReturnsCorrectValue(): void
    {
        $input = ['draw' => 1];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertEquals(1, $requestInput->getDraw());
    }

    public function testGetStartReturnsCorrectValue(): void
    {
        $input = ['start' => 0];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertEquals(0, $requestInput->getStart());
    }

    public function testGetLengthReturnsCorrectValue(): void
    {
        $input = ['length' => 10];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertEquals(10, $requestInput->getLength());
    }

    public function testGetSearchValueReturnsCorrectValue(): void
    {
        $input['search']['value'] = 'search';

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertEquals('search', $requestInput->getSearch()->value());
    }

    public function testGetSearchRegexReturnsCorrectValue(): void
    {
        $input['search']['regex'] = 'true';

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertEquals('true', $requestInput->getSearch()->regex());
    }

    public function testGetOrdersReturnsCollectionOfOrders(): void
    {
        $input['order'] = [['column' => 0, 'dir' => 'asc']];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertInstanceOf(Collection::class, $requestInput->getOrders());
        $this->assertInstanceOf(Order::class, $requestInput->getOrders()->first());
    }

    public function testGetColumnsReturnsCollectionOfColumns(): void
    {
        $input['columns'] = [
            [
                'data' => 'id',
                'name' => 'id',
                'searchable' => true,
                'orderable' => true,
                'search' => [
                    'value' => '',
                    'regex' => false,
                ],
            ],
        ];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertInstanceOf(Collection::class, $requestInput->getColumns());
        $this->assertInstanceOf(Column::class, $requestInput->getColumns()->first());
    }

    public function testGetColumnByNameReturnsCorrectColumn(): void
    {
        $input['columns'] = [
            [
                'data' => 'id',
                'name' => 'id',
                'searchable' => true,
                'orderable' => true,
                'search' => [
                    'value' => '',
                    'regex' => false,
                ],
            ],
        ];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertInstanceOf(Column::class, $requestInput->getColumnByName('id'));
        $this->assertSame('id', $requestInput->getColumnByName('id')->name());
    }

    public function testGetColumnByNameReturnsNullIfColumnDoesNotExist(): void
    {
        $input['columns'] = [];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertNull($requestInput->getColumnByName('name'));
    }

    public function testGetColumnByNameReturnsNullIfColumnsAreEmpty(): void
    {
        $input['columns'] = [];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertNull($requestInput->getColumnByName('name'));
    }

    public function testGetColumnByIndexReturnsCorrectValue(): void
    {
        $input['columns'] = [
            [
                'data' => 'id',
                'name' => 'id',
                'searchable' => true,
                'orderable' => true,
                'search' => [
                    'value' => '',
                    'regex' => false,
                ],
            ],
        ];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertInstanceOf(Column::class, $requestInput->getColumnByIndex(0));
        $this->assertSame('id', $requestInput->getColumnByIndex(0)->name());
    }

    public function testGetColumnByIndexReturnsNullIfColumnDoesNotExist(): void
    {
        $input['columns'] = [];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertNull($requestInput->getColumnByIndex(1));
    }

    public function testGetColumnByIndexReturnsNullIfColumnsAreEmpty(): void
    {
        $input['columns'] = [];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertNull($requestInput->getColumnByIndex(0));
    }

    public function testGetSearchReturnsNullWhenNotPresent(): void
    {
        $input = [];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertNull($requestInput->getSearch());
    }

    public function testGetOrdersReturnsNullWhenNotPresent(): void
    {
        $input = [];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertNull($requestInput->getOrders());
    }

    public function testGetColumnsReturnsNullWhenNotPresent(): void
    {
        $input = [];

        $request = new Request($input);

        $requestInput = new RequestInput($request);

        $this->assertNull($requestInput->getColumns());
    }
}