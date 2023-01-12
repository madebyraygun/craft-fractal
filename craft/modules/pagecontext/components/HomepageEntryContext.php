<?php

namespace modules\pagecontext\components;
use craft\elements\Entry;
use modules\common\EntryUtils;
use Craft;

class HomepageEntryContext {
  public static function Hook() {
    Craft::$app->view->hook('homepage-context', function(array &$context) {
      $context['homepage_context'] = [
        'intro' => self::getIntro( $entry = $context['entry']),
        // 'stories' => self::getStories( $entry = $context['entry'])
      ];
    });
  }

  private static function getIntro($entry) {
    return [
      'avatar' => $entry->thumbnailImage,
      'heading' => $entry->heading,
      'introText' => $entry->introText
    ];
  }

  private function getStories($entry) {
    $entryQuery = Entry::find()
      ->section('blog')
      ->orderBy('postDate DESC')
      ->limit(3);
    $stories = $entryQuery->all();

    $items = [];
    foreach ($stories as $entry) {
      $shortDescription = $entry->position . "\n" . $entry->location;
      $items[] = [
        'heading' => $entry->title,
        'shortDescription' => $shortDescription,
        'url' => $entry->getUrl(),
        'image' => [
          'src' => $image->getUrl(),
          'srcset' => $image->getSrcset(['300w', '500w', '700w', '900w']),
          'alt' => $alt,
          'lazy' => true,
          'width' => 500,
          'height' => 600
        ],
      ];
    }
    return [
      'heading' => 'Stories',
      'shortDescription' => $entry->storiesHeading,
      'stories' => $items
    ];
  }
}
