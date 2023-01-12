<?php 

namespace modules\cpbodyclasses;
use yii\base\Module;
use yii\base\Event;
use craft\helpers\App;
use craft\events\TemplateEvent;
use craft\web\View;
use modules\cpbodyclasses\assetbundles\CpAssetsAsset;
use Craft;

/* Loads custom body classes and asset bundles for CP */

class CpBodyClasses extends Module 
{
  public function init(): void
  {
    Craft::setAlias('@modules/cpbodyclasses', __DIR__);
    // If control panel page, load body classes
    if (Craft::$app->getRequest()->getIsCpRequest()) {
        $this->_bodyClasses();

        Event::on(
          View::class,
          View::EVENT_BEFORE_RENDER_TEMPLATE,
          function (TemplateEvent $event) {
              try {
                  Craft::$app->getView()->registerAssetBundle(CpAssetsAsset::class);
              } catch (InvalidConfigException $e) {
                  Craft::error(
                      'Error registering AssetBundle - '.$e->getMessage(),
                      __METHOD__
                  );
              }
          }
        );
    }
    parent::init();
  }

  /**
   * Load all specified body classes.
   */
  private function _bodyClasses(): void
  {
      // Apply body classes as needed
      Craft::$app->getView()->hook(
          'cp.layouts.base',
          static function(array &$context) {
              $classes = [];
              $classes[] = App::env('ENVIRONMENT') === 'production' ? 'environment-production' : 'environment-dev';
              // Append body classes to bodyAttributes.class
              array_push($context['bodyAttributes']['class'], ...$classes);
          }
      );
  }
}
