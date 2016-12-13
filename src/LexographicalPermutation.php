<?php

namespace Jelle_S\Util\Permutation;

/**
 * Generates the next, previous or all lexographical permutations of a number.
 *
 * @author Jelle Sebreghts
 */
class LexographicalPermutation {

  /**
   * Gets the next lexographical permutation for the given number.
   *
   * @param string|int $number
   *   The number to get the next permutation for.
   *
   * @return string|boolean
   *   The next lexographical permutation, FALSE if the number is the last
   *   lexographical permutation.
   */
  public static function getNextPermutation($number) {
    $length = strlen($number);
    $pieces = str_split($number);
    // Find non-increasing suffix
    $i = $length - 1;
    while ($i > 0 && $pieces[$i - 1] >= $pieces[$i]) {
      $i--;
    }
    if ($i <= 0) {
      return FALSE;
    }

    // Find successor to pivot.
    $j = $length - 1;
    while ($pieces[$j] <= $pieces[$i - 1]) {
      $j--;
    }
    $temp = $pieces[$i - 1];
    $pieces[$i - 1] = $pieces[$j];
    $pieces[$j] = $temp;

    // Reverse suffix
    $j = $length - 1;
    while ($i < $j) {
      $temp = $pieces[$i];
      $pieces[$i] = $pieces[$j];
      $pieces[$j] = $temp;
      $i++;
      $j--;
    }
    return implode('', $pieces);
  }

  /**
   * Gets the previous lexographical permutation for the given number.
   *
   * @param string|int $number
   *   The number to get the previous lexographical permutation for.
   *
   * @return string|boolean
   *   The previous lexographical permutation, FALSE if the number is the first
   *   lexographical permutation.
   */
  public static function getPreviousPermutation($number) {
    $length = strlen($number);
    $pieces = str_split($number);
    // Find non-decreasing suffix
    $i = $length - 1;
    while ($i > 0 && $pieces[$i - 1] <= $pieces[$i]) {
      $i--;
    }
    if ($i <= 0) {
      return FALSE;
    }

    // Find successor to pivot.
    $j = $length - 1;
    while ($pieces[$j] >= $pieces[$i - 1]) {
      $j--;
    }
    $temp = $pieces[$i - 1];
    $pieces[$i - 1] = $pieces[$j];
    $pieces[$j] = $temp;

    // Reverse suffix
    $j = $length - 1;
    while ($i < $j) {
      $temp = $pieces[$i];
      $pieces[$i] = $pieces[$j];
      $pieces[$j] = $temp;
      $i++;
      $j--;
    }
    return implode('', $pieces);
  }

  /**
   * Gets the first lexographical permutation for the given number.
   *
   * @param string|int $number
   *   The number to get the first lexographical permutation for.
   *
   * @return string
   *   The first lexographical permutation.
   */
  public static function getFirstPermutation($number) {
    $pieces = str_split($number);
    sort($pieces);
    return implode('', $pieces);
  }

  /**
   * Gets the last lexographical permutation for the given number.
   *
   * @param string|int $number
   *   The number to get the last lexographical permutation for.
   *
   * @return string
   *   The last lexographical permutation.
   */
  public static function getLastPermutation($number) {
    return strrev(static::getLastPermutation($number));
  }

  /**
   * Gets all lexographical permutations for the given number.
   *
   * @param string|int $number
   *   The number to get the lexographical permutations for.
   *
   * @return string[]
   *   The lexographical permutations of this number.
   */
  public static function getAllPermutations($number) {
    $permutations = [];
    $permutation = static::getFirstPermutation($number);
    $permutations[] = $permutation;
    while($permutation = static::getNextPermutation($permutation)) {
      $permutations[] = $permutation;
    }
    return $permutations;
  }
}
