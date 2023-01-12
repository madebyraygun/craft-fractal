<?php

namespace modules\layoutcontext\components;
use craft\helpers\UrlHelper;
use modules\common\EntryUtils;
use Craft;

class MastheadContext {
  public static function Hook() {
    Craft::$app->view->hook('global-context', function(array &$context) {
      $context['masthead'] = [
        'siteName' => Craft::$app->getSites()->getCurrentSite()->name
      ];
    });
  }

  private function getTopNav() {
    $nodes = [];
    $nodeQuery = \verbb\navigation\elements\Node::find()
    ->handle('topNavigation')
    ->level(1)
    ->all();
    foreach ($nodeQuery as $node)
    {
      $nodes[] = [
        'title' => $node->title,
        'url' => $node->url,
        'class' => $node->active ? 'active' : null
      ];
    }
    return [
      'nodes' => $nodes
    ];
  }

  private function getContactLink($context) {
    $app = $context['craft']->app;
    $utilityNavGlobal =  $app->getGlobals()->getSetByHandle('utilityNav');
    $links = $utilityNavGlobal['topNav'];
    $links = $links->one();
    return [
      'url' => $links['contactLink']->getUrl(),
      'text' => $links['contactLink']->getText(),
      'class' => 'primary'
    ];
  }

  private function getDonateLink($context) {
    $app = $context['craft']->app;
    $utilityNavGlobal =  $app->getGlobals()->getSetByHandle('utilityNav');
    $links = $utilityNavGlobal['topNav'];
    $links = $links->one();
    return [
      'url' => $links['donateLink']->getUrl(),
      'text' => $links['donateLink']->getText(),
      'class' => 'primary'
    ];
  }

  private function getPrimaryNav($context) {
    return [
      'nodes' => EntryUtils::getNodesNav('primaryNav'),
      'donate' => self::getDonateLink($context),
      'contact' => self::getContactLink($context),
    ];
  }

  private function getLanguageNodes($context) {
    $app = $context['craft']->app;
    $languagesGlobal =  $app->getGlobals()->getSetByHandle('utilityNav');
    $languages = $languagesGlobal['languages'];
    if ( !$languages ) return;
    $children = [];
    foreach ($languages as $language)
    {
      $children[] = [
        'title' => $language->languageName,
        'url' => '#Weglot-' . $language->languageCode
      ];
    }
    return [[
      'title' => 'Language',
      'children' => $children
    ]];
  }

  private function getTopUtilityNav($context) {
    $searchButton = [
        'ariaLabel' =>'Search'
    ];
    return [
      'nodes' => self::getLanguageNodes($context),
      'searchButton' => $searchButton,
      'donate' => self::getDonateLink($context),
      'contact' => self::getContactLink($context),
    ];
  }

  private function getLogo() {
    return ['url' => '/'];
  }

  private function getSearchBar() {
    return [
      'input' => [
        'placeholder' => 'Search',
      ],
      'submitButton' => [
        'text' => 'Search',
        'class' => 'search-submit'
      ],
      'closeButton' => [
        'ariaLabel' => 'Close'
      ],
      'form_action' => UrlHelper::siteUrl('/search')
    ];
  }

  private function getButtonSearch() {
    return [
      'ariaLabel' => 'Search'
    ];
  }

  private function getMobileButton() {
    return [
      'ariaLabel' => 'Open Mobile Menu'
    ];
  }

  private function getMobileCloseButton() {
    return [
      'ariaLabel' => 'Close Mobile Menu'
    ];
  }

  private function getLanguageSelector($context) {
    return [
      'nodes' => self::getLanguageNodes($context),
      'title' => 'Language'
    ];
  }
}
