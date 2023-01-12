const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'prototype',
  title: 'Home',
  context: {
    intro: '@cb-intro',
    richText: '@cb-rich-text',
    stories: [
      '@story-card',
      '@story-card',
      '@story-card'
    ]
  }
}
