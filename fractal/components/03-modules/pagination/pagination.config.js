const { faker } = require('@faker-js/faker');

module.exports = {
  title: 'Pagination',
  context: {
    sprigTarget: 'results',
    totalPages: '4',
    currentPage: {
      page: '2',
      url: 'page/2'
    },
    nextPage: {
      page: '3',
      url: 'page/3'
    },
    prevPage: {
      page: '1',
      url: 'page/1'
    },
    getPrevUrls: [
      {
        page: '1',
        url: ''
      }
    ],
    getNextUrls: [
      {
        page: '3',
        url: 'page/3'
      },
      {
        page: '4',
        url: 'page/4'
      }
    ],
    firstPage: {
      clamped: false,
      dots: null,
      page: null
    },
    lastPage: {
      clamped: false,
      dots: null,
      page: null
    }
  }
}
