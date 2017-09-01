<?php

namespace Drupal\howler_js\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceFormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\file\Entity\File;

/**
 * Plugin implementation of the 'howler_default_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "howler_default_formatter",
 *   label = @Translation("HowlerJS Simple"),
 *   field_types = {
 *     "file"
 *   }
 * )
 */
class HowlerDefaultFormatter extends EntityReferenceFormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Implement settings form.
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    if ($files = $this->getEntitiesToView($items, $langcode)) {
      foreach ($files as $delta => $file) {
        $title = $file->_referringItem->get('description')->getValue() ?: $file->getFilename();
        $audiofiles[] = [
          'title' => $title,
          'file' => file_create_url($file->getFileUri()),
          'howl' => NULL,
        ];
      }
      $elements = [
        '#theme' => 'howler_js',
        '#rows' => $rows,
        '#attached' => [
          'library' => 'howler_js/player',
          'drupalSettings' => [
            'howler_js' => [
              'player' => [
                'audiofiles' => $audiofiles,
              ]
            ]
          ]
        ],
      ];
    }

    return $elements;
  }

}
