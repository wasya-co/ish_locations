<?php

namespace Drupal\ish_drupal_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 * From: https://www.drupal.org/docs/creating-modules/creating-custom-blocks/create-a-custom-block
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 *   category = @Translation("Hello World"),
 * )
 */
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
  **/
  // public function build() {
  //   return [
  //     '#markup' => $this->t('Hello, World!'),
  //   ];
  // }

  /**
   * {@inheritdoc}
  **/
  // public function build() {
  //   return [
  //     '#theme' => 'hello_block',
  //     '#data' => ['age' => '31', 'DOB' => '2 May 2000'],
  //   ];
  // }

  /**
   * {@inheritdoc}
  **/
  public function build() {
    $some_array = [
      0 => [
        'is_active' => 'active',
        'label' => 'lorem ipsum',
        'url' => 'http://google.com',
      ],
      1 => [
        'is_active' => 'inactive',
        'label' => 'lorem ipsum',
        'url' => 'http://amazon.com',
      ],
    ];

    return [
      '#theme' => 'hello_block',
      '#active_tab' => 'some_string',
      '#body_text' => [
        '#markup' => 'some_html_string',
      ],
      '#tabs' => $some_array,
    ];
  }

}
