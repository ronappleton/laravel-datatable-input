<?php

declare(strict_types=1);

namespace Tests\Unit\Objects\Column;

use Appleton\Datatable\Objects\Column;
use Tests\TestCase;

/**
 * @covers \Appleton\Datatable\Objects\Column
 */
class SearchValueTest extends TestCase
{
    public function testSearchValueReturnsTheValueWhenSearchValueExists(): void
    {
        $column = new Column(['search' => ['value' => 'testValue']]);

        $this->assertSame('testValue', $column->searchValue());
    }

    public function testSearchValueReturnsNullWhenSearchValueDoesNotExist(): void
    {
        $column = new Column(['search' => []]);

        $this->assertNull($column->searchValue());
    }


    public function testHasSearchValueExecutesClosureWhenHasSearchValueIsTrueAndResultIsTrue(): void
    {
        $column = new Column(['search' => ['value' => 'search']]);

        $result = $column->hasSearchValue(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertSame('closure_fired', $result);
    }

    public function testHasSearchValueDoesNotExecuteClosureWhenHasSearchValueIsTrueAndResultIsFalse(): void
    {
        $column = new Column(['search' => ['value' => 'search']]);

        $result = $column->hasSearchValue(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertTrue($result);
    }

    public function testHasSearchValueExecutesClosureWhenHasSearchValueIsFalseAndResultIsFalse(): void
    {
        $column = new Column(['search' => ['value' => '']]);

        $result = $column->hasSearchValue(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertSame('closure_fired', $result);
    }

    public function testHasSearchValueDoesNotExecuteClosureWhenHasSearchValueIsFalseAndResultIsTrue(): void
    {
        $column = new Column(['search' => ['value' => '']]);

        $result = $column->hasSearchValue(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertFalse($result);
    }
}