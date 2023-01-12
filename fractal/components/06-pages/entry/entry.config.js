const { faker } = require('@faker-js/faker');

module.exports = {
  status: 'prototype',
  title: 'Post',
  context: {
    hero: '@hero',
    richText: '@cb-rich-text',
    blockquote: '@cb-blockquote',
    image: '@cb-image'
  }
}
