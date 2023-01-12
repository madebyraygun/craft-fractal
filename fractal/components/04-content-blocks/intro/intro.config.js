// https://www.notion.so/raygun/Content-Blocks-b4c0a047d5e44adebc0a8145b7617782
const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'ready',
  title: 'Intro',
  context: {
    avatar: {
      imgSrc: '/dist/assets/author.jpg'
    },
    button: {
      text: 'Say Hello',
      url: '/'
    },
    heading: {
      text: faker.lorem.words(faker.datatype.number({ min: 3, max: 10 })),
    },
    introText: {
      text: faker.lorem.words(faker.datatype.number({ min: 15, max: 40 })),
    }
  }
}
