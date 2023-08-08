<?php

namespace modules\pagecontext\components;
use craft\elements\Entry;
use craft\helpers\Template;
use modules\pagecontext\Pagination;
use modules\common\EntryUtils;
use Craft;

class StoriesIndexContext {
  public static function Hook() {
    Craft::$app->view->hook('stories-index-context', function(array &$context) {
      $paginatedResults = self::getPaginatedResults($context);
      $context['stories_index_context'] = [
        'hero' => self::getHero($context, $paginatedResults),
        'pagination' => Pagination::GetContext($paginatedResults),
        'stories' => self::getStories($paginatedResults),
        'pageSeoTitle' => self::getSeoTitle($context, $paginatedResults),
      ];
    });
  }

  private function getHero($context, $paginatedResults) {
    $pagination = $paginatedResults[0];
    $currentPage = $pagination->currentPage;
    return [
      'type' => 'text-only',
      'heading' => [
        'text' => $context['entry']->title,
        'tag' => 'h1',
        'class' => 'heading-1'
      ],
      'subheading' => $currentPage != 1 ? 'Page ' . $pagination->currentPage : null,
    ];
  }

  private function getPaginatedResults($context) {
    $entryQuery = Entry::find()
      ->section('stories')
      ->orderBy('postDate DESC')
      ->limit(12);
    return Template::paginateQuery($entryQuery);
  }

  private function getStories($paginatedResults) {
    $entries = $paginatedResults[1];
    $results = [];
    foreach ($entries as $entry) {
      $options = [
        'mode'=> 'crop',
        'width' => 500,
        'height' => 600
      ];
      $alt = '';
      $image = EntryUtils::ImageOrPlaceholder($entry->thumbnailImage);
      $image = $image->setTransform($options);
      $alt = $image->altText;
      $shortDescription = $entry->position . "\n" . $entry->location;
      $results[] = [
        'heading' => $entry->title,
        'shortDescription' => $shortDescription,
        'url' => $entry->getUrl(),
        'image' => [
          'src' => $image->getUrl(),
          'srcset' => $image->getSrcset(['300', '500w', '700w', '900w']),
          'alt' => $alt,
          'height' => 600,
          'width' => 500,
          'lazy' => true
        ],
      ];
    }
    return [
      'stories' => $results
    ];
  }

  private function getSeoTitle($context, $paginatedResults) {
    $string = $context['entry']->title;
    $pagination = $paginatedResults[0];
    $currentPage = $pagination->currentPage;
    if ( $currentPage != 1 ) $string .= ' - Page ' . $pagination->currentPage;
    return $string;
  }
}
