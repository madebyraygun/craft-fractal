const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'ready',
  title: 'Story',
  context: {
    tag: faker.lorem.words(faker.datatype.number({ min: 1, max: 3 })),
    url: '/',
    readTime: '4 minutes',
    date: 'May 4th, 2022',
    title: faker.lorem.words(faker.datatype.number({ min: 3, max: 15 }))
  }
}
