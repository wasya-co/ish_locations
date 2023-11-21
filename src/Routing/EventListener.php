<?php

namespace Drupal\ish_drupal_module\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * .....
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('ckeditor5.upload_image')) {
      $route->setMethods(['POST', 'GET']);
    }
  }
}
