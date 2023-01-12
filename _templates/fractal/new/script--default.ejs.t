---
to: "<%= jsfile ? `fractal/components/${typePath}/${baseName}/${baseName}.js` : null %>"
---
console.log('Component loaded from', '<%= typePath %>/<%= baseName %>/<%= baseName %>.js')
