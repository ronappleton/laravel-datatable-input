<?php

declare(strict_types=1);

namespace Tests\Unit\Objects\Column;

use Appleton\Datatable\Objects\Column;
use Tests\TestCase;

/**
 * @covers \Appleton\Datatable\Objects\Column
 */
final class DataTest extends TestCase
{
    public function testDataReturnsCorrectData(): void
    {
        $column = new Column(['data' => 'testData']);

        $this->assertEquals('testData', $column->data());
    }

    public function testDataReturnsNull(): void
    {
        $column = new Column([]);

        $this->assertNull($column->data());
    }

    public function testHasDataExecutesClosureWhenDataExistsAndResultIsTrue(): void
    {
        $column = new Column(['data' => 'testData']);

        $result = $column->hasData(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertSame('closure_fired', $result);
    }

    public function testHasDataDoesNotExecuteClosureWhenDataExistsAndResultIsFalse(): void
    {
        $column = new Column(['data' => 'testData']);

        $result = $column->hasData(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertTrue($result);
    }

    public function testHasDataExecutesClosureWhenDataDoesNotExistAndResultIsFalse(): void
    {
        $column = new Column([]);

        $result = $column->hasData(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertSame('closure_fired', $result);
    }

    public function testHasDataDoesNotExecutesClosureWhenDataDoesNotExistsAndResultIsTrue(): void
    {
        $column = new Column([]);

        $result = $column->hasData(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertFalse($result);
    }
}