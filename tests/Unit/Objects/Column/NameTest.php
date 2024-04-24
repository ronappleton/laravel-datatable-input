<?php

declare(strict_types=1);

namespace Tests\Unit\Objects\Column;

use Appleton\Datatable\Objects\Column;
use Tests\TestCase;

/**
 * @covers \Appleton\Datatable\Objects\Column
 */
class NameTest extends TestCase
{
    public function testNameReturnsCorrectData(): void
    {
        $column = new Column(['data' => 'testData']);

        $this->assertEquals('testData', $column->data());
    }

    public function testNameReturnsNull(): void
    {
        $column = new Column([]);

        $this->assertNull($column->data());
    }

    public function testHasNameExecutesClosureWhenDataExistsAndResultIsTrue(): void
    {
        $column = new Column(['name' => 'testData']);

        $result = $column->hasName(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertSame('closure_fired', $result);
    }

    public function testHasNameDoesNotExecuteClosureWhenDataExistsAndResultIsFalse(): void
    {
        $column = new Column(['name' => 'testData']);

        $result = $column->hasName(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertTrue($result);
    }

    public function testHasNameExecutesClosureWhenDataDoesNotExistAndResultIsFalse(): void
    {
        $column = new Column([]);

        $result = $column->hasName(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertSame('closure_fired', $result);
    }

    public function testHasNameDoesNotExecutesClosureWhenDataDoesNotExistsAndResultIsTrue(): void
    {
        $column = new Column([]);

        $result = $column->hasName(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertFalse($result);
    }
}