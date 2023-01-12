---
inject: true
after: HYGEN_CONTEXT_HOOKS
to: <%= `craft/modules/${typePath}/LayoutContext.php` %>
---
    <%= baseName %>Context::Hook();