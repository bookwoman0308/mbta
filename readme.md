Overview
-------------

This is a simple Drupal 8 custom module that ingests data from the Massachusetts Bay Transportation Authority API and displays schedule information for each route. Routes are sorted by type, with the background and text colors designated by the API route attributes.


Installation
--------------------------

1. See Drupal.org documentation if needed on how to install custom modules:
https://drupal.org/documentation/install/modules-themes/modules-8 
In short, download the tarball and expand it into the modules/ directory in your Drupal 8
installation.

2. Enable the module by going to your site's admin menu and then selecting Extend.

3. Clear all caches by navigating to your site's admin menu and selecting Configuration > Performance > Clear all caches.

4. Content should appear at the specified route: http://[hostname]/mbta


Related Resources
--------------------------

The MBTA API for developers page: https://www.mbta.com/developers/v3-api

The Swagger documentation for the API: https://api-v3.mbta.com/docs/swagger/index.html