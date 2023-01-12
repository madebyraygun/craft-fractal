const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'ready',
  title: 'Tag',
  context: {
    text: faker.lorem.words(faker.datatype.number({ min: 1, max: 3 })),
  }
}
