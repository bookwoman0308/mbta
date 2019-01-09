<?php

/**
 * @file
 * Contains \Drupal\mbta_transit\Controller\MBTAController.
 */

namespace Drupal\mbta_transit\Controller;

use Drupal\mbta_transit\Transit;
use Drupal\mbta_transit\Route;
use Drupal\mbta_transit\Schedule;
use Drupal\Core\Controller\ControllerBase;

/**
 * Controller routines for mbta_transit routes.
 */
class MBTAController extends ControllerBase {

  /**
   * A controller method to render all routes, sorted by type, retrieved from the MBTA API.
   */
  public function bay_state_routes() {

    $route_data = [];
    $Transit = new Transit('routes/');
    $route_data = $Transit->getResponse();

    if (!$route_data) {
      $output['error'] = [
        '#type' => 'markup',
        '#markup' => $this->t('An error occurred with retrieving route data from the MBTA API. Please try back again later.'),
        ];
    }
    else {
      $Route = new Route();
      $route_attribute_array = $Route->buildRouteAttributeArray($route_data);
      $route_types = $Route->identifyRouteTypes($route_attribute_array);
      $output['routes'] = [
        '#theme' => 'route_display',
        '#route_attributes' => $route_attribute_array,
        '#types' => $route_types
      ];
    }

    return $output;
  }

  /**
   * A controller method to render schedule data per schedule retrieved from the MBTA API.
   */
  public function bay_state_schedules($id = NULL) {

    $Transit = new Transit('schedules/?filter[route]=' . $id);
    $schedule_data = $Transit->getResponse();
    $date = date('F j, Y', time());

    if (!$schedule_data) {
      $output['schedule_notice'] = [
        '#markup' => $this->t('There are no vehicles scheduled for Route ' . $id . ' today: ' . $date),
      ];
    }
    else {
      $Schedule = new Schedule();
      $schedule_attribute_array = $Schedule->buildScheduleAttributeArray($schedule_data['data']);
      $output['schedule_display'] = [
        '#theme' => 'schedule_display',
        '#schedule_attributes' => $schedule_attribute_array,
        '#route_id' => $id,
        '#today_date' => $date,
      ];
    }

    return $output;
	}

}