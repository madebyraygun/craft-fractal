---
to: <%= `craft/modules/${typePath}/components/${baseName}Context.php` %>
---
<?php
namespace modules\layoutcontext\components;

use Craft;
use modules\common\EntryUtils;

class <%= baseName %>Context {
  public static function Hook() {
    Craft::$app->view->hook('<%= pathName  %>_context', function(array &$context) {
      $context['<%= pathName  %>_context'] = [
        'key' => self::getKey($context),
      ];
    });
  }

  public static function getKey($context) {
    return 'value';
  }
}
