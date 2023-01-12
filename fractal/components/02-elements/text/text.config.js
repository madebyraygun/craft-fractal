const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'ready',
  title: 'Text',
  context: {
    text: '<p>' + faker.lorem.words(faker.datatype.number({ min: 15, max: 40 })) + '</p>',
  }
}
