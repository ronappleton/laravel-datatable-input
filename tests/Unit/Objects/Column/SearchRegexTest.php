<?php

declare(strict_types=1);

namespace Tests\Unit\Objects\Column;

use Appleton\Datatable\Objects\Column;
use Tests\TestCase;

/**
 * @covers \Appleton\Datatable\Objects\Column
 */
class SearchRegexTest extends TestCase
{
    public function testSearchRegexReturnsTrueWhenSearchRegexIsTrue(): void
    {
        $column = new Column(['search' => ['regex' => 'true']]);

        $this->assertTrue($column->isSearchRegex());
    }

    public function testSearchRegexReturnsFalseWhenSearchRegexIsFalse(): void
    {
        $column = new Column(['search' => ['regex' => 'false']]);

        $this->assertFalse($column->isSearchRegex());
    }

    public function testSearchRegexReturnsFalseWhenSearchRegexIsNotSet(): void
    {
        $column = new Column([]);

        $this->assertFalse($column->isSearchRegex());
    }

    public function testSearchRegexExecutesClosureWhenSearchRegexIsTrueAndResultIsTrue(): void
    {
        $column = new Column(['search' => ['regex' => 'true']]);

        $result = $column->isSearchRegex(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertSame('closure_fired', $result);
    }

    public function testSearchRegexDoesNotExecuteClosureWhenSearchRegexIsTrueAndResultIsFalse(): void
    {
        $column = new Column(['search' => ['regex' => 'true']]);

        $result = $column->isSearchRegex(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertTrue($result);
    }

    public function testSearchRegexExecutesClosureWhenSearchRegexIsFalseAndResultIsFalse(): void
    {
        $column = new Column(['search' => ['regex' => 'false']]);

        $result = $column->isSearchRegex(function (Column $column) {
            return 'closure_fired';
        }, false);

        $this->assertSame('closure_fired', $result);
    }

    public function testSearchRegexDoesNotExecuteClosureWhenSearchRegexIsFalseAndResultIsTrue(): void
    {
        $column = new Column(['search' => ['regex' => 'false']]);

        $result = $column->isSearchRegex(function (Column $column) {
            return 'closure_fired';
        }, true);

        $this->assertFalse($result);
    }
}