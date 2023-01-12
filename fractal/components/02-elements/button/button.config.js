const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'ready',
  title: 'Button',
  context: {
    url: '/',
    text: 'Button'
  },
  variants: [
    {
      name: 'Submit',
      context: {
        text: 'Submit'
      }
    }
  ]
}
