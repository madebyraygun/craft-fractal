<?php

namespace modules\layoutcontext\components;
use modules\common\EntryUtils;
use Craft;

class FooterContext {
  public static function Hook() {
    Craft::$app->view->hook('global-context', function(array &$context) {
      $context['footer'] = [
        'copyright' => '&copy;' . date("Y") . ' ' . Craft::$app->getSites()->getCurrentSite()->name
      ];
    });
  }

  private static function getCopyrightTitle($context) {
    return $seoGlobal->seoTitle;
  }
}
