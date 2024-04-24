<?php

declare(strict_types=1);

namespace Unit\Objects\Order;

use Appleton\Datatable\Inputs\RequestInput;
use Appleton\Datatable\Objects\Order;
use Illuminate\Http\Request;
use Tests\TestCase;

/**
 * @covers \Appleton\Datatable\Objects\Order
 * @covers \Appleton\Datatable\Inputs\RequestInput
 * @covers \Appleton\Datatable\Objects\Column
 */
class OrderTest extends TestCase
{
    public function testColumnReturnsColumnIndex(): void
    {
        $order = new Order(['column' => 1, 'dir' => 'asc']);

        $this->assertEquals(1, $order->column());
    }

    public function testColumnReturnsColumnName(): void
    {
        $requestData = [
            'columns' => [
                ['name' => 'column1'],
                ['name' => 'column2'],
            ],
            'order' => [
                [
                    'column' => 0,
                    'dir' => 'asc'
                ],
            ],
        ];

        $request = new Request($requestData);

        $requestInput = new RequestInput($request);

        $orders = $requestInput->getOrders();
        $order = $orders->first();

        $this->assertEquals('column1', $order->column($requestInput));
    }
    public function testOrderReturnsCorrectData(): void
    {
        $order = new Order(['column' => 1, 'dir' => 'asc']);

        $this->assertEquals(1, $order->column());
        $this->assertEquals('asc', $order->direction());
    }

    public function testOrderReturnsNull(): void
    {
        $order = new Order([]);

        $this->assertNull($order->column());
        $this->assertNull($order->direction());
    }

    public function testOrderIsMacroable(): void
    {
        Order::macro('testMacro', function () {
            return 'macro_fired';
        });

        $order = new Order([]);

        $this->assertEquals('macro_fired', $order->testMacro());
    }

    public function testOrderToArrayReturnsCorrectData(): void
    {
        $order = new Order(['column' => 1, 'dir' => 'asc']);

        $this->assertEquals(['column' => 1, 'dir' => 'asc'], $order->toArray());
    }
}