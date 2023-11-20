<?php

declare(strict_types=1);

namespace Mocniak\SortedLinkedList;

use Iterator;
use IteratorAggregate;
use Traversable;

class SortedList implements IteratorAggregate
{
    private ?ListNode $firstNode = null;

    public function add(string $valueToAdd): void
    {
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
     * @return string[]
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
            }

            public function key(): mixed
            {
                return null;
            }

            public function valid(): bool
            {
                return $this->currentNode !== null;
            }

            public function rewind(): void
            {
                $this->currentNode = $this->firstNode;
            }
        };
    }
}
