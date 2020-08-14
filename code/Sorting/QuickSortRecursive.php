<?php
declare(strict_types=1);
require_once('Sort.php');

final class QuickSortRecursive implements Sort
{
    public function sort(array $elements): array
    {
        $this->sortAlgorithm($elements, 0, count($elements) - 1);
        return $elements;
    }

    private function sortAlgorithm(array &$elements, int $left, int $right)
    {
        if ($left >= $right) {
            return;
        }
        $pivot = $elements[($left + $right) / 2];
        $index = $this->partition($elements, $left, $right, $pivot);
        $this->sortAlgorithm($elements, $left, $index - 1);
        $this->sortAlgorithm($elements, $index, $right);
    }

    private function partition(array &$elements, int $left, int $right, int $pivot): int
    {
        while ($left <= $right) {
            while ($elements[$left] < $pivot) {
                $left++;
            }
            while ($elements[$right] > $pivot) {
                $right--;
            }

            if ($left <= $right) {
                $this->swap($elements, $left, $right);
                $left++;
                $right--;
            }
        }

        return $left;
    }

    private function swap(array &$elements, int $left, int $right)
    {
        $aux = $elements[$left];
        $elements[$left] = $elements[$right];
        $elements[$right] = $aux;
    }


}