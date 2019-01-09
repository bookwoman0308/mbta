<?php

/**
 * @file
 * Contains Drupal\mbta_transit\Schedule.
 */

namespace Drupal\mbta_transit;

use DateTime;


/**
 * Class Schedule.
 *
 * @package Drupal\mbta_transit
 */
class Schedule extends Transit {

  public function __construct() {
  }

  /**
  * Helper function that builds an array from transit schedule data from the MBTA API.
  */
  public function buildScheduleAttributeArray($data) {
    $schedule_attributes_array = [];
    foreach ($data as $key) {
        $schedule_attributes_array[] = array(
         'arrival_time' => $this->renderTimeFormat($key['attributes']['arrival_time']),
         'vehicle_name' => $key['relationships']['trip']['data']['id'],
         'stop_name' => $key['relationships']['stop']['data']['id'],
        );
      }
    return $schedule_attributes_array;
  }

  /**
  * Helper function used to convert the ISO 8601 time format from the API data into a human-readable format.
  */
  public function renderTimeFormat($arrivalTime) {

    $timeObj = DateTime::createFromFormat(DateTime::ISO8601, $arrivalTime);
    //Format the time for users in the targeted time zone that does not use military time
    $timeDisplay = $timeObj->format('g:i a');
    return $timeDisplay;
  }

}