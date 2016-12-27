<?php

namespace Jelle_S\Test\Util\Permutation;

use PHPUnit\Framework\TestCase;
use Jelle_S\Util\Permutation\LexographicalPermutation;

/**
 * Tests \Jelle_S\Util\Permutation\LexographicalPermutation.
 *
 * @author Jelle Sebreghts
 *
 * @coversDefaultClass \Jelle_S\Util\Permutation\LexographicalPermutation
 */
class LexographicalPermutationTest extends TestCase {

  const TEST_ITERATIONS = 3;

  protected function getRandomNumber($iteration) {
    $nums = range(0, 9);
    $random_number = '';
    for ($i = 0; $i < 3; $i++) {
      $number = array_rand($nums);
      // Make sure the number consists of 4 different numbers.
      unset($nums[$number]);
      $random_number .= $number;
    }
    $random_number = intval($random_number);
    // Make sure this is not the first or last permutation, and make sure
    // the number consists of 4 different numbers.
    $while = 0;
    while ($this->isFirstPermutation($random_number) || $this->isLastPermutation($random_number)) {
      $random_number = str_shuffle($random_number);
      $while ++;
      if ($while > 100) {
        $random_number = '423';
        $nums = array_diff(range(0, 9), array(4,2,3));
        break;
      }
    }
    $random_number .= ($iteration % 2) ? min($nums) : max($nums);
    return intval($random_number);
  }

  protected function isFirstPermutation($number) {
    $arr_num = str_split($number);
    sort($arr_num);
    return intval(join('', $arr_num)) === intval($number);
  }

  protected function isLastPermutation($number) {
    $arr_num = str_split($number);
    rsort($arr_num);
    return intval(join('', $arr_num)) === intval($number);
  }

  /**
   * @covers ::getNextPermutation()
   */
  public function testGetNextPermutation() {
    for ($iteration = 1; $iteration <= static::TEST_ITERATIONS; $iteration++) {
      $number = $this->getRandomNumber($iteration);
      $next = LexographicalPermutation::getNextPermutation($number);
      $arr_next = str_split($next);
      $arr_num = str_split($number);
      sort($arr_next);
      sort($arr_num);
      $this->assertGreaterThan($number, $next);
      $this->assertEquals($arr_next, $arr_num);
      // Assert getting the next permutation of the last one returns FALSE.
      $this->assertFalse(LexographicalPermutation::getNextPermutation(join('', array_reverse($arr_num))));
    }
  }

  /**
   * @covers ::getPreviousPermutation()
   */
  public function testGetPreviousPermutation() {
    for ($iteration = 1; $iteration <= static::TEST_ITERATIONS; $iteration++) {
      $number = $this->getRandomNumber($iteration);
      $previous = LexographicalPermutation::getPreviousPermutation($number);
      $arr_previous = str_split($previous);
      $arr_num = str_split($number);
      sort($arr_previous);
      sort($arr_num);
      $this->assertGreaterThan($previous, $number);
      $this->assertEquals($arr_previous, $arr_num);
      // Assert getting the previous permutation of the first one returns FALSE.
      $this->assertFalse(LexographicalPermutation::getPreviousPermutation(join('', $arr_num)));
    }
  }

  /**
   * @covers ::getFirstPermutation()
   */
  public function testGetFirstPermutation() {
    for ($iteration = 1; $iteration <= static::TEST_ITERATIONS; $iteration++) {
      $number = $this->getRandomNumber($iteration);
      $first = LexographicalPermutation::getFirstPermutation($number);
      $this->assertLessThan($number, $first);
      $arr_num = str_split($number);
      $arr_first = str_split($first);
      sort($arr_num);
      sort($arr_first);
      $this->assertEquals($arr_first, $arr_num);
      $this->assertEquals($first, join('', $arr_num));
    }
  }

  /**
   * @covers ::getLastPermutation()
   */
  public function testGetLastPermutation() {
    for ($iteration = 1; $iteration <= static::TEST_ITERATIONS; $iteration++) {
      $number = $this->getRandomNumber($iteration);
      $last = LexographicalPermutation::getLastPermutation($number);
      $this->assertGreaterThan($number, $last);
      $arr_num = str_split($number);
      $arr_last = str_split($last);
      sort($arr_num);
      sort($arr_last);
      $this->assertEquals($arr_last, $arr_num);
      $this->assertEquals($last, join('', array_reverse($arr_num)));
    }
  }

  /**
   * @covers ::getAllPermutations()
   */
  public function testGetAllPermutations() {
    for ($iteration = 1; $iteration <= static::TEST_ITERATIONS; $iteration++) {
      $number = $this->getRandomNumber($iteration);
      $permutations = LexographicalPermutation::getAllPermutations($number);
      $this->assertTrue($this->isLastPermutation(end($permutations)));
      $this->assertTrue($this->isFirstPermutation(reset($permutations)));
      $this->assertCount(count($permutations), array_unique($permutations));
      $factorial = 1;
      for ($i=strlen($number); $i>=1; $i--) {
        $factorial *= $i;
      }
      $this->assertCount($factorial, $permutations);

      $previous = array_shift($permutations);
      while($permutations) {
        $current = array_shift($permutations);
        $this->assertGreaterThan($previous, $current);
        $arr_previous = str_split($previous);
        $arr_current = str_split($current);
        sort($arr_previous);
        sort($arr_current);
        $this->assertEquals(join('', $arr_current), join('', $arr_previous));
        $previous = $current;
      }
    }
  }
}
