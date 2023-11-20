<?php

declare(strict_types=1);

namespace Mocniak\SortedLinkedList;

class SortedList
{
    private ?ListNode $firstNode = null;

    public function add(string $string): void
    {
        $this->firstNode = new ListNode($string, null);
    }

    /**
     * @return string[]
     */
    public function getAll(): array
    {
        return $this->firstNode === null ? [] : [$this->firstNode->value];
    }
}
