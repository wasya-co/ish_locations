<?php

namespace Drupal\ish_drupal_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;

use Drupal\jwt\Transcoder\JwtTranscoder;

/**
 * Implements an example form.
**/
class ContributedPostForm extends FormBase {

  /**
   * {@inheritdoc}
  **/
  public function getFormId() {
    return 'contributed_post_form';
  }

  /**
   * {@inheritdoc}
  **/
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Post Title'),
    ];
    // $form['jwt_token'] = [
    //   '#type' => 'textarea',
    //   '#title' => $this->t('jwt_token'),
    // ];
    $form['body'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Post Body'),
    ];

    $options = array(
      NULL => '',
      '1' => 'one',
      '2' => 'two',
      '3' => 'three',
    );
    $options = array(
      NULL => '',
    );
    $vid = 'tagscontrib';
    $terms = \Drupal::entityTypeManager()
                ->getStorage('taxonomy_term')
                ->loadByProperties([
                  'vid' => $vid,
             ]);

    foreach ($terms as $term) {
      $options[$term->id()] = $term->getName();
    }
    $form['tag_contrib'] = [
      '#type' => 'select',
      '#title' => 'Tags Contrib',
      '#description' => 'some descr',
      // '#multiple' => true,
      '#options' =>  $options,
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Create'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
  **/
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // if (strlen($form_state->getValue('phone_number')) < 3) {
    //   $form_state->setErrorByName('phone_number', $this->t('The phone number is too short. Please enter a full phone number.'));
    // }
  }

  /**
   * {@inheritdoc}
  **/
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // $this->messenger()->addStatus($this->t('Your phone number is @number',
    //   [ '@number' => $form_state->getValue('phone_number') ]
    // ));

    // Create file object from remote URL.
    // $data = file_get_contents('https://www.drupal.org/files/druplicon.small_.png');
    // $file = file_save_data($data, 'public://druplicon.png', FILE_EXISTS_REPLACE);

    // $jwt_token = $form_state->getValue('jwt_token');
    // echo '+++jwt_token: ';
    // echo $jwt_token ;

    // $this_key = '<>';
    // $decoded = JWT::decode($jwt_token, $this_key);
    // echo '+++jwt_token decoded: ';
    // echo $decoded ;


    // Create node object with attached file.
    $node = Node::create([
      'type'        => 'contributed_post',
      'title'       => $form_state->getValue('title'),
      'field_tag_contrib' => [
        ['target_id' => $form_state->getValue('tag_contrib')]
      ],
      // 'field_image' => [
      //   'target_id' => $file->id(),
      //   'alt' => 'Hello world',
      //   'title' => 'Goodbye world'
      // ],
    ]);
    $node->save();

    $this->messenger()->addStatus(
      $this->t('Than you for your submission. We will let you know once this article is approved.')
    );

  }

}
