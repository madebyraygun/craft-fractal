---
to: <%= `craft/modules/${typePath}/blocks/${baseName}Block.php` %>
---
<?php

namespace modules\pageblocks\blocks;

use Craft;
use modules\pageblocks\blocks\BaseBlock;
use modules\common\EntryUtils;

class <%= baseName %>Block extends BaseBlock {
  public static function Init(array &$context) {
    static::PushBlocks($context, [
        self::GetBlock($context),
    ]);
  }

  public static function GetBlock($context) {
    $result = [];
    // Block Context extraction
    return $result;
  }
}
