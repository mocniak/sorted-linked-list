<?php

declare(strict_types=1);

namespace Mocniak\SortedLinkedList;

class SortedList
{
    private ?ListNode $firstNode = null;

    public function add(string $valueToAdd): void
    {
        if ($this->firstNode === null) {
            $this->firstNode = new ListNode($valueToAdd, null);

            return;
        }
        $this->firstNode->changeNext(new ListNode($valueToAdd, null));
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
}
