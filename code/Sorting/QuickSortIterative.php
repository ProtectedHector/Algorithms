<?php
declare(strict_types=1);


final class QuickSortIterative implements Sort
{
    public function sort(array $elements): array
    {
        $this->sortAlgorithm($elements, 0, count($elements) - 1);
        return $elements;
    }

    private function swap ( &$a, &$b )
    {
        $t = $a;
        $a = $b;
        $b = $t;
    }

    function partition (&$elements, $left, $right)
    {
        $x = $elements[$right];
        $i = ($left - 1);

        for ($j = $left; $j <= $right- 1; $j++)
        {
            if ($elements[$j] <= $x)
            {
                $i++;
                $this->swap ($elements[$i], $elements[$j]);
            }
        }
        $this->swap ($elements[$i + 1], $elements[$right]);
        return ($i + 1);
    }

    function sortAlgorithm (&$elements, $left, $right)
    {
        // Create an auxiliary stack
        $stack=array_fill(0, $right - $left, 0);

        // initialize top of stack
        $top = -1;

        // push initial values of left and right to stack
        $stack[ ++$top ] = $left;
        $stack[ ++$top ] = $right;

        // Keep popping from stack while is not empty
        while ( $top >= 0 )
        {
            // Pop right and left
            $right = $stack[ $top-- ];
            $left = $stack[ $top-- ];

            // Set pivot element at its correct position
            // in sorted array
            $pivot = $this->partition( $elements, $left, $right );

            // If there are elements on left side of pivot,
            // then push left side to stack
            if ( $pivot-1 > $left )
            {
                $stack[ ++$top ] = $left;
                $stack[ ++$top ] = $pivot - 1;
            }

            // If there are elements on right side of pivot,
            // then push right side to stack
            if ( $pivot+1 < $right )
            {
                $stack[ ++$top ] = $pivot + 1;
                $stack[ ++$top ] = $right;
            }
        }
    }
}