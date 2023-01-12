---
inject: true
after: HYGEN_BLOCK_HOOKS
to: <%= `craft/modules/${typePath}/PageBlocks.php` %>
---
    <%= baseName %>Block::Hook();