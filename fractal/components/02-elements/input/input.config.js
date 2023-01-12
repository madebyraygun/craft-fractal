const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'ready',
  title: 'Inputs',
  context: {
    id: 'name',
    placeholder: 'Your Name'
  },
  variants: [
    {
      name: 'Email',
      context: {
        id: 'email',
        placeholder: 'Your Email'
      }
    }
  ]
}
