<?php

namespace modules\pagecontext;
use modules\pagecontext\components\HomepageEntryContext;
use modules\pagecontext\components\PageEntryContext;
use modules\pagecontext\components\StoryEntryContext;
use modules\pagecontext\components\StoriesIndexContext;
// HYGEN_CONTEXT_INCLUDES

use yii\base\Module;
use Craft;

class PageContext extends Module {
  /**
  * Initializes the module.
  */
  public function init() {
    // Set a @modules alias pointed to the modules/ directory
    Craft::setAlias('@modules/pagecontext', $this->getBasePath());
    HomepageEntryContext::Hook();
    StoryEntryContext::Hook();
    StoriesIndexContext::Hook();
    // HYGEN_CONTEXT_HOOKS
    parent::init();
  }
}
