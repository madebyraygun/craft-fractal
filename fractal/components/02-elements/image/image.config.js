const { faker } = require('@faker-js/faker')

module.exports = {
  title: 'Image',
  context: {
    src: faker.image.unsplash.imageUrl(1200, 700, 'business', true, true),
    srcset: faker.image.unsplash.imageUrl(500, 292, 'business', true, true) + ' 500w, ' + faker.image.unsplash.imageUrl(700, 409, 'business', true, true) + ' 700w, ' + faker.image.unsplash.imageUrl(900, 525, 'business', true, true) + ' 900w, ' + faker.image.unsplash.imageUrl(1200, 700, 'business', true, true) + ' 1200w, ' + faker.image.unsplash.imageUrl(1600, 934, 'business', true, true) + ' 1600w',
    alt: faker.lorem.words(faker.datatype.number({ min: 5, max: 30 })),
    lazy: true,
    class: 'width--full',
    width: '1200',
    height: '700',
    caption: null,
    sizes: null
  },
  variants: [
    {
      name: 'Image with caption',
      context: {
        src: faker.image.unsplash.imageUrl(1200, 700, 'business', true, true),
        srcset: faker.image.unsplash.imageUrl(500, 292, 'business', true, true) + ' 500w, ' + faker.image.unsplash.imageUrl(700, 409, 'business', true, true) + ' 700w, ' + faker.image.unsplash.imageUrl(900, 525, 'business', true, true) + ' 900w, ' + faker.image.unsplash.imageUrl(1200, 700, 'business', true, true) + ' 1200w, ' + faker.image.unsplash.imageUrl(1600, 934, 'business', true, true) + ' 1600w',
        alt: faker.lorem.words(faker.datatype.number({ min: 5, max: 30 })),
        lazy: true,
        class: 'width--full',
        caption: 'Image caption: ' + faker.lorem.words(faker.datatype.number({ min: 5, max: 60 })),
        width: '1200',
        height: '700',
      }
    }
  ]
}
