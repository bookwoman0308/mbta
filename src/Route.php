<?php

/**
 * @file
 * Contains Drupal\mbta_transit\Route.
 */

namespace Drupal\mbta_transit;


/**
 * Class Route.
 *
 * @package Drupal\mbta_transit
 */
class Route extends Transit {

  public function __construct() {
  }

  /**
  * Helper function that builds an array from transit route data from the MBTA API.
  */
  public function buildRouteAttributeArray($response) {
    $route_array = $response['data'];
    $route_attribute_array = [];
    foreach ($route_array as $key) {
      $long_name = $key['attributes']['long_name'];
      if ($long_name == '') {
        $long_name = $key['id'];
      }
     $route_attribute_array[] = [
       'type' => $key['attributes']['description'],
       'long_name' => $long_name,
       'bg_color' => $key['attributes']['color'],
       'text_color' => $key['attributes']['text_color'],
       'route_id' => $key['id'],
       ];
    }
    return $route_attribute_array;
  }

  /**
  * Helper function that identifies the transit types from the API call, i.e. Rapid Transit, Local Bus, etc.
  */
  public function identifyRouteTypes($routes) {
    $route_types = array_unique(array_column($routes, 'type'));
    return $route_types;
  }

}