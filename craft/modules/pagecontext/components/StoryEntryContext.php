<?php

namespace modules\pagecontext\components;
use modules\common\EntryUtils;
use Craft;

class StoryEntryContext {
  public static function Hook() {
    Craft::$app->view->hook('story-entry-context', function(array &$context) {
      $context['story_entry_context'] = [
        'hero' => self::getHero($context),
      ];
    });
  }

  private function getHero($context) {
    $entry = $context['entry'];
    return [
      'type' => 'text-only',
      'heading' => [
        'text' => EntryUtils::RemoveWidows($entry->title),
        'tag' => 'h1',
        'class' => 'heading-1'
      ],
    ];
  }
}
