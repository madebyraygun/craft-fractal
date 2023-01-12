---
inject: true
after: HYGEN_CONTEXT_HOOKS
to: <%= `craft/modules/${typePath}/PageContext.php` %>
---
    <%= baseName %>Context::Hook();