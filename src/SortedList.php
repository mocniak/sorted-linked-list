<?php

declare(strict_types=1);

namespace Mocniak\SortedLinkedList;

class SortedList
{
    /**
     * @var mixed[]
     */
    private array $values = [];

    public function add(string $string): void
    {
        $this->values[] = $string;
    }

    /**
     * @return mixed[]
     */
    public function getAll(): array
    {
        return $this->values;
    }
}
