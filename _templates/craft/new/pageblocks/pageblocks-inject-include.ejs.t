---
inject: true
after: HYGEN_BLOCK_INCLUDES
to: <%= `craft/modules/${typePath}/PageBlocks.php` %>
---
use modules\pageblocks\blocks\<%= baseName %>Block;