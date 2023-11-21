<h1 align="center">mocniak/sorted-linked-list</h1>

<p align="center">
    <strong>Library with sorted linked list of integers or strings</strong>
</p>

## Installation

Install this package as a dependency using [Composer](https://getcomposer.org).

``` bash
composer require mocniak/sorted-linked-list
```

## Usage

``` php
use Mocniak\SortedLinkedList\Example;

$listOfStrings = SortedLinkedList::ofStrings();
$listOfStrings->add('fig');
$listOfStrings->add('banana');
$listOfStrings->add('eggplant');
foreach ($listOfStrings as $element) {
    echo $element;
}
$listOfIntegers = SortedLinkedList::ofIntegers();
$listOfStrings->add(42);
(...)
```

## Contributing

Contributions are welcome! To contribute, please familiarize yourself with
[CONTRIBUTING.md](CONTRIBUTING.md).

## Copyright and License

mocniak/sorted-linked-list is free and unencumbered software released into the
public domain. Please see [UNLICENSE](UNLICENSE) for more information.

