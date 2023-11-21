<?php

declare(strict_types=1);

namespace Mocniak\SortedLinkedList;

use Countable;
use Iterator;
use IteratorAggregate;
use Traversable;

use function is_int;
use function is_string;

class SortedLinkedList implements Countable, IteratorAggregate
{
    private ?ListNode $firstNode = null;
    private int $count = 0;
    private bool $storesIntegersOnly;

    public static function ofIntegers(): self
    {
        return new self(true);
    }

    public static function ofStrings(): self
    {
        return new self(false);
    }

    private function __construct(bool $storesIntegersOnly)
    {
        $this->storesIntegersOnly = $storesIntegersOnly;
    }

    /**
     * @throws AddingValueOfWrongTypeException
     */
    public function add(string | int $valueToAdd): void
    {
        if ($this->storesIntegersOnly && is_string($valueToAdd)) {
            throw new AddingValueOfWrongTypeException('Adding string value to integer only list.');
        }
        if (!$this->storesIntegersOnly && is_int($valueToAdd)) {
            throw new AddingValueOfWrongTypeException('Adding integer value to string only list.');
        }
        $this->count++;
        if ($this->firstNode === null) {
            $this->firstNode = new ListNode($valueToAdd, null);

            return;
        }
        $previousNode = null;
        $nextNode = $this->firstNode;
        while ($nextNode !== null) {
            if ($valueToAdd < $nextNode->value) {
                if ($previousNode === null) {
                    $this->firstNode = new ListNode($valueToAdd, $nextNode);

                    return;
                }
                $previousNode->changeNext(new ListNode($valueToAdd, $nextNode));

                return;
            }
            $previousNode = $nextNode;
            $nextNode = $nextNode->getNext();
        }
        $previousNode->changeNext(new ListNode($valueToAdd, null));
    }

    /**
     * @return string[]|int[]
     */
    public function getAll(): array
    {
        $valuesToReturn = [];
        $node = $this->firstNode;
        while ($node !== null) {
            $valuesToReturn[] = $node->value;
            $node = $node->getNext();
        }

        return $valuesToReturn;
    }

    public function getIterator(): Traversable
    {
        return new class ($this->firstNode) implements Iterator {
            private ?ListNode $firstNode;
            private ?ListNode $currentNode;
            private int $position = 0;

            public function __construct(?ListNode $firstNode)
            {
                $this->firstNode = $firstNode;
                $this->currentNode = $firstNode;
            }

            public function current(): mixed
            {
                return $this->currentNode->value;
            }

            public function next(): void
            {
                $this->currentNode = $this->currentNode->getNext();
                $this->position++;
            }

            public function key(): mixed
            {
                return $this->position;
            }

            public function valid(): bool
            {
                return $this->currentNode !== null;
            }

            public function rewind(): void
            {
                $this->currentNode = $this->firstNode;
                $this->position = 0;
            }
        };
    }

    public function count(): int
    {
        return $this->count;
    }

    /**
     * @throws RemovingElementNotPresentOnTheListException
     */
    public function remove(string $valueToRemove): void
    {
        $previousNode = null;
        $currentNode = $this->firstNode;
        while ($currentNode !== null) {
            if ($valueToRemove === $currentNode->value) {
                if ($previousNode === null) {
                    $this->firstNode = $currentNode->getNext();
                } else {
                    $previousNode->changeNext($currentNode->getNext());
                }
                unset($currentNode);
                $this->count--;

                return;
            }
            $previousNode = $currentNode;
            $currentNode = $currentNode->getNext();
        }

        throw new RemovingElementNotPresentOnTheListException();
    }

    public function clear(): void
    {
        $currentNode = $this->firstNode;
        while ($currentNode !== null) {
            $nextNode = $currentNode->getNext();
            unset($currentNode);
            $currentNode = $nextNode;
        }
        $this->firstNode = null;
        $this->count = 0;
    }
}
