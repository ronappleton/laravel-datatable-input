<?php

declare(strict_types=1);

namespace Unit\Objects\Column;

use Tests\TestCase;
use Appleton\Datatable\Objects\Column;

/**
 * @covers \Appleton\Datatable\Objects\Column
 */
class ColumnTest extends TestCase
{
    public function testColumnIsMacroable(): void
    {
        Column::macro('testMacro', function () {
            return 'testMacro';
        });

        $column = new Column([]);

        $this->assertSame('testMacro', $column->testMacro());
    }

    public function testColumnToArrayReturnsColumnArray(): void
    {
        $column = new Column([
            'data' => 'id',
            'name' => 'id',
            'searchable' => true,
            'orderable' => true,
            'search' => [
                'value' => '',
                'regex' => false,
            ],
        ]);

        $this->assertSame([
            'data' => 'id',
            'name' => 'id',
            'searchable' => true,
            'orderable' => true,
            'search' => [
                'value' => '',
                'regex' => false,
            ],
        ], $column->toArray());
    }
}