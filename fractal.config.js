'use strict'
const paths = require('./fractal/config/paths')
const bluebird = require('bluebird')

bluebird.config({
  warnings: false
})

/* Create a new Fractal instance */
const fractal = require('@frctl/fractal').create()
const mandelbrot = require('@frctl/mandelbrot')

const customisedTheme = mandelbrot({
  skin: {
    name: 'black',
    accent: '#363378',
    links: '#eb4646'
  },
  styles: ['default', '/dist/extras.css'],
  scripts: ['default', '/dist/extras.js']
})
customisedTheme.addLoadPath(paths.extras)
fractal.web.theme(customisedTheme)

/* Set the title of the project */
fractal.set('project.title', 'Fractal Craft Demo Component Library')

/* Configure Paths */
fractal.components.set('path', paths.components)
fractal.components.set('default.preview', '@preview')
fractal.web.set('builder.dest', paths.build)
fractal.web.set('static.path', './public')
fractal.docs.set('path', paths.docs)
/*
  Twig template enginge adapter for Fractal.
  https://github.com/frctl/fractal/tree/main/packages/twig
*/
const twigAdapter = require('@frctl/twig')({
  filters: require('./fractal/config/filters'),
  functions: require('./fractal/config/functions'),
  // should missing variable/keys emit an error message
  // If false, they default to null.
  // default is false
  allow_async: true,
  strict_variables: true
})
fractal.components.engine(twigAdapter)
fractal.components.set('ext', '.twig')

fractal.components.on('updated', (...args) => {
  // console.log(args);
  // TODO: If performance is poor when file count gets bigger we might need to patch the changes
})

/*
  Register custom commands
  https://fractal.build/guide/cli/custom-commands.html
*/
require('./fractal/config/commands/export-components').registerCommand(fractal)

module.exports = fractal
