<?php

declare(strict_types=1);

namespace Mocniak\SortedLinkedList;

class ListNode
{
    public readonly string $value;
    private ?ListNode $next;

    public function __construct(string $value, ?ListNode $next)
    {
        $this->value = $value;
        $this->next = $next;
    }

    public function getNext(): ?ListNode
    {
        return $this->next;
    }

    public function changeNext(ListNode $newNext): void
    {
        $this->next = $newNext;
    }
}
