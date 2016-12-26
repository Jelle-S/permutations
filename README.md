Generates (lexographical) permutations.

```php
use Jelle_S\Util\Permutation\LexographicalPermutation;
$number = 12345;
$next = LexographicalPermutation::getNextPermutation($number);
print "The next lexographical permutation of {$number} is {$next}.\n";

$number = 32154;
$previous = LexographicalPermutation::getPreviousPermutation($number);
print "The previous lexographical permutation of {$number} is {$previous}.\n";

$first = LexographicalPermutation::getFirstPermutation($number);
print "The first lexographical permutation of {$number} is {$first}.\n";

$last = LexographicalPermutation::getLastPermutation($number);
print "The last lexographical permutation of {$number} is {$last}.\n";

$number = 3124;
$all = print_r(LexographicalPermutation::getAllPermutations($number), TRUE);
print "All lexographical permutations of {$number} are \n{$all}\n";
```

Output:
```
The next lexographical permutation of 12345 is 12354.
The previous lexographical permutation of 32154 is 32145.
The first lexographical permutation of 32154 is 12345.
The last lexographical permutation of 32154 is 54321.
All lexographical permutations of 3124 are 
Array
(
    [0] => 1234
    [1] => 1243
    [2] => 1324
    [3] => 1342
    [4] => 1423
    [5] => 1432
    [6] => 2134
    [7] => 2143
    [8] => 2314
    [9] => 2341
    [10] => 2413
    [11] => 2431
    [12] => 3124
    [13] => 3142
    [14] => 3214
    [15] => 3241
    [16] => 3412
    [17] => 3421
    [18] => 4123
    [19] => 4132
    [20] => 4213
    [21] => 4231
    [22] => 4312
    [23] => 4321
)
```
