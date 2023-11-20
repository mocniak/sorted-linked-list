<?php

declare(strict_types=1);

namespace Mocniak\Test\SortedLinkedList;

use Mocniak\SortedLinkedList\SortedList;

class SortedListTest extends TestCase
{
    public function testListStoresANumericValue(): void
    {
        $list = new SortedList();
        $list->add('some-value');
        $this->assertEquals(['some-value'], $list->getAll());
    }

    public function testEmptyListReturnsEmptyArray(): void
    {
        $list = new SortedList();
        $this->assertEquals([], $list->getAll());
    }

    public function testListStoresValuesOrdered(): void
    {
        $list = new SortedList();
        $list->add('banana');
        $list->add('apple');
        $list->add('cherry');
        $this->assertEquals(['apple', 'banana', 'cherry'], $list->getAll());
    }
}
