---
inject: true
after: HYGEN_CONTEXT_INCLUDES
to: <%= `craft/modules/${typePath}/PageContext.php` %>
---
use modules\pagecontext\components\<%= baseName %>Context;