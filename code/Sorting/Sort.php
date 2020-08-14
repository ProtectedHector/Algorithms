<?php
declare(strict_types=1);

interface Sort
{
    public function sort(array $elements): array;
}