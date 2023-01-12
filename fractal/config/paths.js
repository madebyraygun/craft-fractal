const path = require('path')

function resolve (relativePathString) {
  return path.join(process.env.PWD, relativePathString)
}

module.exports = Object.freeze({
  base: resolve('/fractal/components'), /* Root path of fractal/components/ */
  build: resolve('/fractal/build'), /* To set the directory within which any static HTML exports of the web UI should be generated */
  docs: resolve('/fractal/docs'), /* Tell Fractal where the documentation pages will live */
  extras: resolve('/fractal/extras'), /* Tell Fractal where the documentation pages will live */
  static: resolve('/fractal/public'), /* Specify a directory of static assets */
  components: resolve('/fractal/components'), /* Tell Fractal where the components will live */
  craft: resolve('/craft'),
  craftTemplates: resolve('/craft/templates/_components')
})
