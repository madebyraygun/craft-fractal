const fs = require('fs').promises
const path = require('path')

async function fileExists (dir) {
  try {
    await fs.access(dir)
    return true
  } catch (e) {
    return false
  }
}

async function createDirPath (dir) {
  if (!await fileExists(dir)) {
    await fs.mkdir(dir, { recursive: true })
  }
}

async function copyFile (src, destination) {
  await fs.mkdir(path.dirname(destination), { recursive: true })
  await fs.copyFile(src, destination).catch(console.error)
}

async function removeDirFiles (dir) {
  const files = await fs.readdir(dir, { withFileTypes: true })
  const jobs = files.map(file => {
    const target = path.join(dir, file.name)
    if (file.isDirectory()) {
      return removeDirFiles(target)
    }
    return fs.unlink(target)
  })
  return await Promise.all(jobs)
}

module.exports = {
  copyFile,
  createDirPath,
  removeDirFiles,
  fileExists
}
