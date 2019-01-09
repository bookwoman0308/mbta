<?php

/**
 * @file
 * Contains Drupal\mbta_transit\Transit.
 */

namespace Drupal\mbta_transit;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;


/**
 * Class Transit.
 *
 * @package Drupal\mbta_transit
 */
class Transit {

  // Property declaration
  private $urlPath;

  CONST API_URL = 'https://api-v3.mbta.com/';
  CONST API_KEY = '6d7970cabacd4881ac48a4863aa8b8d7';

  // Method declaration
  /**
   * Constructor
   */
  public function __construct($urlPath) {
    $this->setUrlPath($urlPath);
  }

  /**
   * Getters and Setters
   */
  public function getUrlPath() {
    return $this->urlPath;
  }

  public function setUrlPath($urlPath) {
    $this->urlPath = $urlPath;
  }

  /**
  * Helper function used to set up the API call to retrieve either all routes or all schedule data for a specified route.
  */
  public function getResponse() {
    $url = self::API_URL . $this->urlPath;
  	try {
  	  $client = \Drupal::httpClient();
      $request = $client->get($url, array('headers' => array('Content-Type' => 'application/json', 'Authorization' => self::API_KEY)));
      $data = json_decode((string) $request->getBody(), true);
      if (empty($data)) {
        return FALSE;
      }
    }
    catch (RequestException $e) {
      return FALSE;
    }
    return $data;
  }

}
