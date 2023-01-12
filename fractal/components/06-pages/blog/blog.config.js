const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'prototype',
  title: 'Blog',
  context: {
    heading: {
      text: 'Blog'
    },
    introText: {
      text: faker.lorem.words(faker.datatype.number({ min: 25, max: 40 })),
    },
    subscribe: '@subscribe',
    stories: [
      '@story-card',
      '@story-card',
      '@story-card',
      '@story-card',
      '@story-card',
      '@story-card'
    ]
  }
}
