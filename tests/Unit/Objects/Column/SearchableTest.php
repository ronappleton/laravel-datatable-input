<?php

declare(strict_types=1);

namespace Tests\Unit\Objects\Column;

use Appleton\Datatable\Objects\Column;
use Tests\TestCase;

/**
 * @covers \Appleton\Datatable\Objects\Column
 */
class SearchableTest extends TestCase
{
    public function testSearchableReturnsTrueWhenSearchableIsTrue(): void
    {
        $column = new Column(['searchable' => 'true']);

        $this->assertTrue($column->searchable());
    }

    public function testSearchableReturnsFalseWhenSearchableIsFalse(): void
    {
        $column = new Column(['searchable' => 'false']);

        $this->assertFalse($column->searchable());
    }

    public function testSearchableReturnsFalseWhenSearchableIsNotSet(): void
    {
        $column = new Column([]);

        $this->assertFalse($column->searchable());
    }

    public function testSearchableExecutesClosureWhenSearchableIsTrueAndResultIsTrue(): void
    {
        $column = new Column(['searchable' => 'true']);

        $result = $column->searchable(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertSame('closure_fired', $result);
    }

    public function testSearchableDoesNotExecuteClosureWhenSearchableIsTrueAndResultIsFalse(): void
    {
        $column = new Column(['searchable' => 'true']);

        $result = $column->searchable(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertTrue($result);
    }

    public function testSearchableExecutesClosureWhenSearchableIsFalseAndResultIsFalse(): void
    {
        $column = new Column(['searchable' => 'false']);

        $result = $column->searchable(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertSame('closure_fired', $result);
    }

    public function testSearchableDoesNotExecuteClosureWhenSearchableIsFalseAndResultIsTrue(): void
    {
        $column = new Column(['searchable' => 'false']);

        $result = $column->searchable(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertFalse($result);
    }
}