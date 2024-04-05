<?

namespace Drupal\ish_drupal_module\Controller;

use Drupal\node\NodeInterface;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Users controller.
**/
class UsersController extends ControllerBase {

  /**
   * index()
  **/
  // public function index() {
  //   return [
  //     '#markup' => "<h1>Locations Index !!!</h1>",
  //   ];
  // }

  /**
   * edit() - myself only
  **/
  public function my_edit( Request $request ) {

    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());

    return [
      '#theme'   => 'ish_users_edit',
      '#user'    => $user,
      '#request' => $request,
    ];
  }

}
