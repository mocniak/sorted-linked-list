<?php

declare(strict_types=1);

namespace Mocniak\Test\SortedLinkedList;

use Mocniak\SortedLinkedList\AddingValueOfWrongTypeException;
use Mocniak\SortedLinkedList\RemovingElementNotPresentOnTheListException;
use Mocniak\SortedLinkedList\SortedLinkedList;
use Ramsey\Dev\Tools\TestCase as BaseTestCase;

class SortedListTest extends BaseTestCase
{
    public function testListStoresAValue(): void
    {
        $list = SortedLinkedList::ofStrings();
        $list->add('some-value');
        $this->assertEquals(['some-value'], $list->getAll());
    }

    public function testEmptyListReturnsEmptyArray(): void
    {
        $list = SortedLinkedList::ofStrings();
        $this->assertEquals([], $list->getAll());
    }

    public function testListStoresTwoValues(): void
    {
        $list = SortedLinkedList::ofStrings();
        $list->add('apple');
        $list->add('banana');
        $this->assertEquals(['apple', 'banana'], $list->getAll());
    }

    public function testListStoresTwoValuesOrdered(): void
    {
        $list = SortedLinkedList::ofStrings();
        $list->add('banana');
        $list->add('apple');
        $this->assertEquals(['apple', 'banana'], $list->getAll());
    }

    public function testListStoresMoreThanOneValueOrdered(): void
    {
        $list = SortedLinkedList::ofStrings();
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
        $list = SortedLinkedList::ofStrings();
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
        $list = SortedLinkedList::ofStrings();
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
        $list = SortedLinkedList::ofStrings();
        $this->expectException(RemovingElementNotPresentOnTheListException::class);
        $list->remove('banana');
    }

    public function testListIsCountable(): void
    {
        $list = SortedLinkedList::ofStrings();
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
        $list = SortedLinkedList::ofStrings();
        $list->add('apple');
        $list->add('banana');
        $list->add('cherry');
        $list->clear();
        $this->assertEquals([], $list->getAll());
        $this->assertEquals(0, $list->count());
    }

    public function testListInIntegerModeCanStoreIntegerValuesOnly(): void
    {
        $list = SortedLinkedList::ofIntegers();
        $list->add(2);
        $list->add(1);
        $this->assertEquals([1, 2], $list->getAll());
        $this->expectException(AddingValueOfWrongTypeException::class);
        $list->add('banana');
    }

    public function testListInStringModeCanStoreStringValuesOnly(): void
    {
        $list = SortedLinkedList::ofStrings();
        $list->add('banana');
        $this->assertEquals(['banana'], $list->getAll());
        $this->expectException(AddingValueOfWrongTypeException::class);
        $list->add(1);
    }
}
