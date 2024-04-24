<?php

declare(strict_types=1);

namespace Unit\Objects\Search;

use Appleton\Datatable\Objects\Search;
use Tests\TestCase;

/**
 * @covers \Appleton\Datatable\Objects\Search
 */
class SearchTest extends TestCase
{
    public function testSearchValueReturnsTheValueWhenSearchValueExists(): void
    {
        $search = new Search(['value' => 'testValue']);

        $this->assertSame('testValue', $search->value());
    }

    public function testSearchValueReturnsNullWhenSearchValueDoesNotExist(): void
    {
        $search = new Search([]);

        $this->assertNull($search->value());
    }

    public function testSearchRegexReturnsTrueWhenSearchRegexIsTrue(): void
    {
        $search = new Search(['regex' => 'true']);

        $this->assertTrue($search->regex());
    }

    public function testSearchRegexReturnsFalseWhenSearchRegexIsFalse(): void
    {
        $search = new Search(['regex' => 'false']);

        $this->assertFalse($search->regex());
    }

    public function testSearchIsMacroable(): void
    {
        Search::macro('testMacro', function () {
            return 'testMacro';
        });

        $search = new Search([]);

        $this->assertSame('testMacro', $search->testMacro());
    }

    public function testSearchToArrayReturnsSearchArray(): void
    {
        $search = new Search(['value' => 'testValue', 'regex' => 'true']);

        $this->assertSame(['value' => 'testValue', 'regex' => 'true'], $search->toArray());
    }
}