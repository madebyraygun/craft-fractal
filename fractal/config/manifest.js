const paths = require('./paths')
const fs = require('fs').promises
const path = require('path')
const { fileExists } = require('./utils')
const MANIFEST_PATH = path.join(paths.base, '/manifest.json')
const ignore = require('./ignore')
const micromatch = require('micromatch')
/**
 * Reads the manifest file from manifest.json and returs its contents
 * @returns Manifest object
 */
async function readManifest (fractal) {
  if (!await manifestExists()) {
    const logger = fractal.cli.console
    logger.error(`No Manifest found at: ${MANIFEST_PATH}`)
  }
  return require(MANIFEST_PATH)
}

async function manifestExists () {
  return fileExists(MANIFEST_PATH)
}

/**
 * Writes the manifest object into manifest.json
 * @returns Promise
 */
async function writeManifest (manifest) {
  return await fs.writeFile(MANIFEST_PATH, JSON.stringify(manifest, null, 2))
}

/**
 * Creates a manifest object with all components pending to export
 * @param {fractalInstance} fractal
 * @returns Promise
 */
function createManifest (fractal) {
  const logger = fractal.cli.console

  const map = {}
  // generate map
  const exported = []
  const skipped = []
  const ignored = []

  for (const item of fractal.components.flattenDeep()) {
    if (micromatch.contains(item.viewPath, ignore)) {
      ignored.push(item)
      continue
    }

    if (item.status.label.toLowerCase() !== 'ready') {
      skipped.push(item)
      continue
    }

    const handle = item.handle.replace('--default', '')
    const relativeDir = path.relative(paths.components, item.viewPath)
    const dst = path.resolve(paths.craftTemplates, relativeDir)

    exported.push(item)
    map[`@${handle}`] = {
      src: path.resolve(paths.base, item.viewPath),
      target: path.resolve(paths.craftTemplates, dst),
      handle: handle
    }
  }

  if (ignored.length > 0) {
    logger.warn(`(${ignored.length}) components ignored.`)
  }

  if (skipped.length > 0) {
    logger.warn(`(${skipped.length}) components skipped:`)
    skipped.forEach((item) => {
      const componentPath = path.relative(paths.components, item.viewPath)
      logger.log(`\t[${item.status.label}] ${componentPath}`)
    })
  }

  logger.success(`(${exported.length}) components exported.`)

  return map
}

module.exports = {
  readManifest,
  writeManifest,
  manifestExists,
  createManifest
}
