<?

namespace Drupal\ish_drupal_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityInterface;

/*
 * From: https://www.drupal.org/docs/drupal-apis/routing-system/introductory-drupal-routes-and-controllers-example
 * From: https://www.drupaleasy.com/blogs/ultimike/2020/07/entityquery-examples-everybody
 *
**/
class TagsController extends ControllerBase {

  public function show() {
    $storage = \Drupal::entityTypeManager()->getStorage('taxonomy_term');


    $query = \Drupal::entityQuery('taxonomy_term')
      ->condition('name', 'Au')
      ->accessCheck(true);
    $result = $query->execute();
    $tag_id = reset($result);

    $viewmode = 'default';

    // $vb = \Drupal::entityTypeManager()->getViewBuilder('taxonomy_term');
    // $nodeview = $vb->view($tag_id, $viewmode);

    $entity = $storage->load($tag_id);
    // $entity = drupal_entity('taxonomy_term', $tag_id, $viewmode);


    // dpm($result);
    // dpm($tag_id);
    // dpm($nodeview);
    // dpm($entity);

    $build = [
      '#theme' => 'tags_show',
      '#variable1' =>$entity,
    ];
    return $build;
  }
}
