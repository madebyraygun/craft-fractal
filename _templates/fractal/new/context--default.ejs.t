---
to: <%= `fractal/components/${typePath}/${baseName}/${baseName}.config.js` %>
---
const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'prototype',
  title: '<%= Name %>',
  context: {
  }
}
