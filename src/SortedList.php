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
}
