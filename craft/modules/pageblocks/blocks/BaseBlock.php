<?php

namespace modules\pageblocks\blocks;
use Craft;

class BaseBlock {
  public static function GetMatrixBlocksByType($context, string $fieldHandle, array $types, $limit = 99) {
    $result = [];
    $entry = $context['entry'];
    if ( $entry && $entry[$fieldHandle]) {
      /*
        Avoid mutating the original block query by cloning the object.
        https://craftcms.com/docs/3.x/matrix-fields.html#working-with-matrix-field-data
      */
      $queryBlock = clone($entry[$fieldHandle]);
      if ($limit == 1) {
        $result = $queryBlock->type($types)->one();
      } else {
        $result = $queryBlock->type($types)->limit($limit)->all();
      }
    }
    return $result;
  }

  public static function GetAssetUrl($asset) {
    if (!is_null($asset) && $asset->one()) {
      return $asset->one()->getUrl();
    }
    return '';
  }

  public static function GetLink($linkField, $buttonStyle = "is-primary", $tabindex = 0) {
    return [
      'text' => $linkField->getText(),
      'url' => $linkField->getUrl(),
      'target' => $linkField->getTarget(),
      'title' => $linkField->getTitle(),
      'class' => $buttonStyle,
      'tabindex' => $tabindex
    ];
  }

  public static function PushBlocks(&$context, $blocks, $handle = 'blocks') {
    // get rid of null entries
    $blocks = array_filter($blocks);
    // initialize blocks if it doesn't exists
    $context[$handle] = $context[$handle] ?? [];
    if (!empty($blocks))
    $context[$handle] = array_merge($context[$handle], $blocks[0]);
    // sort blocks by order
    usort($context[$handle], function($a, $b) {
      return $a['order'] <=> $b['order'];
    });
  }
  
  public static function CreateBlockWithContext($handle, $matrixBlock, $context) {
    if (empty($matrixBlock)) return null;
    return [
      /**
       * This handle is directly related to the component name
       * we gave in fractal. Should include the @ prefix
       */
      'handle' => $handle,
      'context' => $context,
      'order' => intval($matrixBlock->sortOrder),
      /**
       * Attach original block from which the context was generated
       * just in case we need to do some custom stuff later on
      */
      'matrixBlock' => $matrixBlock,
    ];
  }

  public static function Hook() {
    Craft::$app->view->hook('page-blocks', function(array &$context) {
      static::Init($context);
    });
  }
}