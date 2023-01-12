/*
  If a function you need is not implemented you can
  take a look at https://github.com/locutusjs/locutus/tree/master/src/php
  before going for a custom implementation.
*/
module.exports = {
  /*
  Mock function call for plugin at
  https://nystudio107.com/docs/typogrify/#typogrify
*/
  typogrify: function (str) {
    return str
  },
  /*
    Text transform utils from typogrify
    https://nystudio107.com/docs/typogrify/#text-manipulation
  */
  striptags: function (str) { return str },
  truncate: function (str, len) { return str },
  truncateOnWord: function (str, len, terminator) { return str },
  wordLimit: function (str, len) { return str },
  humanFileSize: function (str) { return str },
  humanDuration: function (str) { return str },
  humanRelativeTime: function (str) { return str },
  ordinalize: function (str) { return str },
  pluralize: function (str) { return str },
  singularize: function (str) { return str },
  transliterate: function (str) { return str }
}
