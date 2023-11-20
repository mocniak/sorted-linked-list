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

    public function testListStoresTwoValues(): void
    {
        $list = new SortedList();
        $list->add('apple');
        $list->add('banana');
        $this->assertEquals(['apple', 'banana'], $list->getAll());
    }

    public function testListStoresTwoValuesOrdered(): void
    {
        $list = new SortedList();
        $list->add('banana');
        $list->add('apple');
        $this->assertEquals(['apple', 'banana'], $list->getAll());
    }

    public function testListStoresMoreThanOneValueOrdered(): void
    {
        $list = new SortedList();
        $list->add('fig');
        $list->add('banana');
        $list->add('eggplant');
        $list->add('cherry');
        $list->add('dragon fruit');
        $list->add('apple');
        $this->assertEquals(['apple', 'banana', 'cherry', 'dragon fruit', 'eggplant', 'fig'], $list->getAll());
    }
}
