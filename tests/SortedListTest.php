<?php

declare(strict_types=1);

namespace Mocniak\Test\SortedLinkedList;

use Mocniak\SortedLinkedList\RemovingElementNotPresentOnTheListException;
use Mocniak\SortedLinkedList\SortedLinkedList;
use Ramsey\Dev\Tools\TestCase as BaseTestCase;

class SortedListTest extends BaseTestCase
{
    public function testListStoresANumericValue(): void
    {
        $list = new SortedLinkedList();
        $list->add('some-value');
        $this->assertEquals(['some-value'], $list->getAll());
    }

    public function testEmptyListReturnsEmptyArray(): void
    {
        $list = new SortedLinkedList();
        $this->assertEquals([], $list->getAll());
    }

    public function testListStoresTwoValues(): void
    {
        $list = new SortedLinkedList();
        $list->add('apple');
        $list->add('banana');
        $this->assertEquals(['apple', 'banana'], $list->getAll());
    }

    public function testListStoresTwoValuesOrdered(): void
    {
        $list = new SortedLinkedList();
        $list->add('banana');
        $list->add('apple');
        $this->assertEquals(['apple', 'banana'], $list->getAll());
    }

    public function testListStoresMoreThanOneValueOrdered(): void
    {
        $list = new SortedLinkedList();
        $list->add('fig');
        $list->add('banana');
        $list->add('eggplant');
        $list->add('cherry');
        $list->add('dragon fruit');
        $list->add('apple');
        $this->assertEquals(['apple', 'banana', 'cherry', 'dragon fruit', 'eggplant', 'fig'], $list->getAll());
    }

    public function testListIsIterable(): void
    {
        $list = new SortedLinkedList();
        $list->add('apple');
        $list->add('banana');
        $elements = [];
        foreach ($list as $element) {
            $elements[] = $element;
        }
        $this->assertEquals(['apple', 'banana'], $elements);
    }

    public function testItemsCanBeDeletedFromTheList(): void
    {
        $list = new SortedLinkedList();
        $list->add('apple');
        $list->add('banana');
        $list->add('cherry');
        $list->add('dragon fruit');
        $list->remove('dragon fruit');
        $this->assertEquals(['apple', 'banana', 'cherry'], $list->getAll());
        $list->remove('banana');
        $this->assertEquals(['apple', 'cherry'], $list->getAll());
        $list->remove('apple');
        $this->assertEquals(['cherry'], $list->getAll());
        $list->remove('cherry');
        $this->assertEquals([], $list->getAll());
    }

    public function testRemovingItemFromEmptyListThrowsAnException(): void
    {
        $list = new SortedLinkedList();
        $this->expectException(RemovingElementNotPresentOnTheListException::class);
        $list->remove('banana');
    }

    public function testListIsCountable(): void
    {
        $list = new SortedLinkedList();
        $this->assertEquals(0, $list->count());
        $list->add('apple');
        $this->assertEquals(1, $list->count());
        $list->add('banana');
        $this->assertEquals(2, $list->count());
        $list->remove('banana');
        $this->assertEquals(1, $list->count());
        $list->clear();
        $this->assertEquals(0, $list->count());
    }

    public function testClearingListMakesItEmpty(): void
    {
        $list = new SortedLinkedList();
        $list->add('apple');
        $list->add('banana');
        $list->add('cherry');
        $list->clear();
        $this->assertEquals([], $list->getAll());
        $this->assertEquals(0, $list->count());
    }
}
