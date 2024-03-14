<?

namespace Drupal\ish_drupal_module\Controller;

use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Cities controller.
**/
class CitiesController extends ControllerBase {

  /**
   * index()
  **/
  public function index() {
    return [
      '#markup' => "<h1>Cities Index !!!</h1>",
    ];
  }

  /**
   * show()
  **/
  public function show( $city_slug, Request $request ) {
    // dump( $city_slug );

    $city = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties([
      'type' => 'city',
      'field_slug' => $city_slug,
    ]);
    $city = $city[ array_keys($city)[0] ];
    // var_dump($city);

    $tmp = NULL;

    /**
     * From: https://www.katcoders.com/blog/drupal-9-how-query-nodes-field-or-properties-programatically
     * From: https://www.drupaleasy.com/blogs/ultimike/2020/07/entityquery-examples-everybody
    **/
    $nids = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type', 'article')
      ->condition('field_city', $city->id() )
      ->sort('created', 'DESC')
      ->execute();
    $_articles = Node::loadMultiple($nids);
    $articles = [];
    foreach ($_articles as $k => $entity) {
      $vb = \Drupal::EntityTypeManager()->getViewBuilder('node');
      $articles[] = $vb->view($entity, 'teaser');
    }

    return [
      '#theme'    => 'ish_cities_show',
      '#city'     => $city,
      '#articles' => $articles,
      '#request'  => $request,
      '#tmp' => $tmp,
      '#nids' => $nids,
    ];
  }

}
