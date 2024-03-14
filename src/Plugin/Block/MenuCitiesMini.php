<?php

namespace Drupal\ish_drupal_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;


/**
 *
 * @Block(
 *   id = "menu_cities_mini",
 *   admin_label = @Translation("Menu Cities Mini"),
 * )
 */
class MenuCitiesMini extends BlockBase {

  /**
   * {@inheritdoc}
  **/
  public function build() {
    $nids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'city')
      ->sort('created', 'DESC')
      ->execute();
    $_cities = Node::loadMultiple($nids);
    // $cities = [];
    // foreach ($_cities as $k => $entity) {
    //   $vb = \Drupal::EntityTypeManager()->getViewBuilder('node');
    //   $articles[] = $vb->view($entity, 'teaser');
    // }

    return [
      '#theme' => 'menu_cities_mini',
      '#cities' => $_cities,
    ];
  }

}
