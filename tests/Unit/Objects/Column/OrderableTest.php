<?php

declare(strict_types=1);

namespace Tests\Unit\Objects\Column;

use Appleton\Datatable\Objects\Column;
use Tests\TestCase;

/**
 * @covers \Appleton\Datatable\Objects\Column
 */
class OrderableTest extends TestCase
{
    public function testOrderableReturnsTrueWhenOrderableIsTrue(): void
    {
        $column = new Column(['orderable' => 'true']);

        $this->assertTrue($column->orderable());
    }

    public function testOrderableReturnsFalseWhenOrderableIsFalse(): void
    {
        $column = new Column(['orderable' => 'false']);

        $this->assertFalse($column->orderable());
    }

    public function testOrderableReturnsFalseWhenOrderableIsNotSet(): void
    {
        $column = new Column([]);

        $this->assertFalse($column->orderable());
    }

    public function testOrderableExecutesClosureWhenOrderableIsTrueAndResultIsTrue(): void
    {
        $column = new Column(['orderable' => 'true']);

        $result = $column->orderable(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertSame('closure_fired', $result);
    }

    public function testOrderableDoesNotExecuteClosureWhenOrderableIsTrueAndResultIsFalse(): void
    {
        $column = new Column(['orderable' => 'true']);

        $result = $column->orderable(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertTrue($result);
    }

    public function testOrderableExecutesClosureWhenOrderableIsFalseAndResultIsFalse(): void
    {
        $column = new Column(['orderable' => 'false']);

        $result = $column->orderable(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertSame('closure_fired', $result);
    }

    public function testOrderableDoesNotExecuteClosureWhenOrderableIsFalseAndResultIsTrue(): void
    {
        $column = new Column(['orderable' => 'false']);

        $result = $column->orderable(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertFalse($result);
    }
}