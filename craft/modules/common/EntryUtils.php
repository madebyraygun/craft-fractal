<?php

namespace modules\common;
use craft\helpers\Html;
use craft\elements\Asset;
use craft\elements\Entry;
use yii\base\Module;
use Craft;

class EntryUtils extends Module {
  public static function QueryOne($queryElement, $default = null) {
    if (!is_null($queryElement) && $queryElement->one()) {
      return $queryElement->one();
    }
    return $default;
  }

  public static function QueryAll($queryElement, $default = null) {
    if (!is_null($queryElement) && $queryElement->all()) {
      return $queryElement->all();
    }
    return $default;
  }

  public static function SvgContents($queryImage) {
    $icon = self::QueryOne($queryImage);
    $svg = $icon && $icon->extension == 'svg' ? $icon->getContents() : null;
    return $svg ? Html::sanitizeSvg($svg) : null;
  }

  public static function ImageWith($queryOrImage, $props, array|string $transform = null) {
    if (empty($queryOrImage)) {
      return [];
    }
    $isAssetQuery = get_class($queryOrImage) == 'craft\elements\db\AssetQuery';
    $image = $isAssetQuery ? self::QueryOne($queryOrImage) : $queryOrImage;
    if ($image) {

      $props['width'] = $props['width'] ?? $image->width;
      $props['height'] = $props['height'] ?? $image->height;

      if (is_string($transform)) {
        $transform = [
          'mode' => $transform,
          'width' => $props['width'] ?? 0,
          'height' => $props['height'] ?? 0,
        ];
      }
      if (!empty($transform)) {
        $image->setTransform($transform);
      }

      return [
        'src' => $image->getUrl(),
        'srcset' => $image->getSrcset(['500w', '700w', '900w', '1200w']),
        'alt' => $image->altText,
        'lazy' => true,
        'animate' => true,
        ...$props,
      ];
    }
    return [];
  }

  public static function ImageOrPlaceholder($queryElement, $placeHolderId = 123) {
    $placeholderQuery = Asset::find()->id($placeHolderId);
    return self::QueryOne($queryElement, $placeholderQuery->one());
  }

  public static function GetLink($linkField, $buttonStyle = "is-primary", $tabindex = 0, $icon = null) {
    if ( !$linkField || !is_object($linkField) || $linkField->isEmpty()) return false;
    return [
      'text' => $linkField->getText(),
      'url' => $linkField->getUrl(),
      'target' => $linkField->getTarget(),
      'title' => $linkField->getTitle(),
      'class' => $buttonStyle,
      'tabindex' => $tabindex,
      'icon' => $icon
    ];
  }

  public static function GetBreadcrumbs($entry) {
    $nodes = [];
    if ($entry->parent) {
      $ancestor = $entry->ancestors->level(1)->one();
      $ancestors = $entry->ancestors->all();
      foreach ($ancestors as $ancestor) {
        $nodes[] = [
          "url" => $ancestor->getUrl(),
          "title" => $ancestor->title
        ];
      }
    }
    return [
      'nodes' => $nodes
    ];
  }


  public static function GetNodesNav($handle) {
    $nodes = [];
    $nodeQuery = \verbb\navigation\elements\Node::find()
      ->handle($handle)
      ->level(1)
      ->all();

    foreach ($nodeQuery as $node) {
      $nodes[] = [
        'id' => $node->id,
        'title' => $node->title,
        'url' => $node->url,
        'active' => $node->active,
        'children' => []
      ];
    }
    return $nodes;
  }

  public static function GetSubnav($context) {
    $app = $context['craft']->app;
    $entry = $context['entry'];
    $nodes = [];
    $parent = $entry->ancestors->level(1)->one() ?? $entry ?? null;

    $entryQuery = Entry::find()
    ->descendantOf($parent)
    ->excludeFromSubNavigation(false)
    ->level(2);

    $entries = $entryQuery->all();
    foreach ($entries as $entry) {
      $nodes[] = [
        'id' => $entry->id,
        'title' => $entry->title,
        'name' => $entry->title,
        'value' => $entry->id,
        'url' => $entry->getUrl(),
        'class' => in_array($entry->slug, $app->request->segments) ? 'active' : null,
      ];
    }
    if (count($nodes)) {
      array_unshift($nodes, [
        'id' => $parent->id,
        'title' => 'Overview',
        'name' => 'Overview',
        'value' => $parent->id,
        'url' => $parent->getUrl(),
        'class' => $parent->slug == $app->request->getSegment(-1) ? 'active' : null,
      ]);
    }

    return [
      'name' => 'Explore',
      'nodes' => $nodes,
      'mobileLabel' => 'Explore',
      'mobileOptions' => $nodes
    ];
  }

  public static function GetEntryShare($entry) {
    return [
      'sharing' => [
        'hash' => uniqid(),
        'title' => $entry->title,
        'intro' => EntryUtils::TruncateWords($entry->shortDescription ?? '', 20),
        'url' => $entry->getUrl()
      ],
      'socials' => [
        [
          'name' => 'facebook',
          'url' => 'https://www.facebook.com/Kidango'
        ],
        [
          'name' => 'twitter',
          'url' => 'https://twitter.com/kidango'
        ]
      ]
    ];
  }

  public static function getImportedContent($context) {
    $entry = $context['entry'];
    return ($entry->importedContent ? (string) $entry->importedContent : false);
  }

  public static function TruncateWords($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
  }

  public static function RemoveWidows($text) {
    return preg_replace( '|([^\s])\s+([^\s]+)\s*$|', '$1<span class="no-widow"> </span>$2', $text);
  }
}
