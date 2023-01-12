const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'ready',
  title: 'Blockquote',
  context: {
    text: faker.lorem.sentences(faker.datatype.number({ min: 1, max: 5 }))
  }
}
