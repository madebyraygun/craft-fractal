const { cleanupExport, buildFractal, exportComponents } = require('../build')
const { createManifest, writeManifest } = require('../manifest')

/*
  Export Components Command.
*/
function registerCommand (fractal) {
  fractal.cli.command('export-components', async (args, done) => {
    const success = await buildFractal(fractal)
    if (!success) {
      fractal.cli.console.logger.error('Something went wrong')
    }

    // Cleanup files from previous export
    await cleanupExport(fractal)

    // Create new manifest and write it
    const manifest = createManifest(fractal)
    await writeManifest(manifest)

    // Export
    await exportComponents(fractal, manifest)
    done()
  }, { description: 'Builds the manifest and export all components' })
}

module.exports = {
  registerCommand
}
