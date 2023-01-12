<?php 

namespace modules\cpbodyclasses\assetbundles;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use Craft;

class CpAssetsAsset extends AssetBundle
{
    public function init()
    {
        $this->depends = [
            CpAsset::class,
        ];
        
        $view = Craft::$app->getView();
                
        // Enable for custom CSS
        // $this->css = ['/dist/cp.css?v=' . time()];
        
        // Enable for custom JS 
        //$this->js = [$jsFile . '?' . time()];

        parent::init();
    }
}