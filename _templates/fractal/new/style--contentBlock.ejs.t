---
to: <%= `fractal/components/${typePath}/${baseName}/${baseName}.scss` %>
---

.block--<%= baseName %> {
  @extend %cb-is-default;
  @extend %cb-has-inline-heading;
}