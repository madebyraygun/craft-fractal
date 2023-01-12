const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'ready',
  title: 'Headings',
  context: {
    text: faker.lorem.words(faker.datatype.number({ min: 5, max: 15 })),
  }
}
