<?php

namespace Drupal\one_punch_counting\Traits;

trait onePushTrait {

  /**
   * Function to generate all subsets of a set
   *
   * @param $set
   *
   * @return array[]
   */
  function powerSet($set) {
    $subsets = [[]];
    foreach ($set as $num) {
      $subsetLength = count($subsets);
      for ($i = 0; $i < $subsetLength; $i++) {
        $currentSet = $subsets[$i];
        $mergedSet = array_merge($currentSet, [$num]);
        $subsets[] = $mergedSet;
      }
    }
    return $subsets;
  }

  /**
   * Function for checking closeness under a union
   *
   * @param $sets
   *
   * @return bool
   */
  function isClosedUnderUnion($sets) {
    $setStrings = array_map(function($set) {
      sort($set);
      return implode(',', $set);
    }, $sets);
    $setStringSet = array_flip($setStrings);

    foreach ($sets as $set1) {
      foreach ($sets as $set2) {
        $union = array_unique(array_merge($set1, $set2));
        sort($union);
        $unionString = implode(',', $union);
        if (!isset($setStringSet[$unionString])) {
          return FALSE;
        }
      }
    }
    return TRUE;
  }

  /**
   * Function for checking the closeness under the intersection
   *
   * @param $sets
   *
   * @return bool
   */
  function isClosedUnderIntersection($sets) {
    $setStrings = array_map(function($set) {
      sort($set);
      return implode(',', $set);
    }, $sets);
    $setStringSet = array_flip($setStrings);

    foreach ($sets as $set1) {
      foreach ($sets as $set2) {
        $intersection = array_intersect($set1, $set2);
        sort($intersection);
        $intersectionString = implode(',', $intersection);
        if (!isset($setStringSet[$intersectionString])) {
          return FALSE;
        }
      }
    }
    return TRUE;
  }

  /**
   * Function to check whether a given set is a topology
   *
   * @param $sets
   * @param $set
   *
   * @return bool
   */
  function isTopology($sets, $set) {
    $containsEmptySet = in_array([], $sets);
    $containsSet = in_array($set, $sets);

    return $containsEmptySet &&
      $containsSet &&
      $this->isClosedUnderUnion($sets) &&
      $this->isClosedUnderIntersection($sets);
  }

  /**
   * Function to generate all set topologies
   *
   * @param $set
   *
   * @return array[]
   */
  function generateTopologies($set) {
    $pSet = $this->powerSet($set);
    $possibleTopologies = $this->powerSet($pSet);
    $topologies = array_filter($possibleTopologies, function($t) use ($set) {
      return $this->isTopology($t, $set);
    });
    return $topologies;
  }

}