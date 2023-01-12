---
inject: true
after: HYGEN_CONTEXT_INCLUDES
to: <%= `craft/modules/${typePath}/LayoutContext.php` %>
---
use modules\layoutcontext\components\<%= baseName %>Context;