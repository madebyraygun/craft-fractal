<?php

namespace modules\pageblocks;
use modules\pageblocks\blocks\PullquoteBlock;
use modules\pageblocks\blocks\RichTextBlock;
use modules\pageblocks\blocks\SingleImageBlock;
// HYGEN_BLOCK_INCLUDES
use Craft;

class PageBlocks extends \yii\base\Module {
  /**
  * Initializes the module.
  */
  public function init() {
    // Set a @modules alias pointed to the modules/ directory
    Craft::setAlias('@modules/pageblocks', $this->getBasePath());
    PullquoteBlock::Hook();
    RichTextBlock::Hook();
    SingleImageBlock::Hook();
    // HYGEN_BLOCK_HOOKS

    parent::init();
  }
}
