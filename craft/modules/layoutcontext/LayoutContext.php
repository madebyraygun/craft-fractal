<?php

namespace modules\layoutcontext;
use modules\layoutcontext\components\BodyClassesContext;
use modules\layoutcontext\components\FooterContext;
use modules\layoutcontext\components\MastheadContext;
// HYGEN_CONTEXT_INCLUDES

use yii\base\Module;
use Craft;

class LayoutContext extends Module {
  /**
  * Initializes the module.
  */
  public function init() {
    // Set a @modules alias pointed to the modules/ directory
    Craft::setAlias('@modules/layoutcontext', $this->getBasePath());
    // Register Component's Hooks
    BodyClassesContext::Hook();
    FooterContext::Hook();
    MastheadContext::Hook();
    // HYGEN_CONTEXT_HOOKS

    parent::init();
  }
}
