---
to: <%= `fractal/components/${typePath}/${baseName}/${baseName}.config.js` %>
---
// https://www.notion.so/raygun/Content-Blocks-b4c0a047d5e44adebc0a8145b7617782
const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'prototype',
  title: '<%= Name %>',
  context: {
    sectionHeading: faker.lorem.words(faker.datatype.number({ min: 5, max: 20 })),
    body: faker.lorem.sentences(faker.datatype.number({ min: 2, max: 7 }))
  }
}
