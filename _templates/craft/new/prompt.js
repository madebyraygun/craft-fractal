const path = require('path')

function resolvePath (dir) {
  return path.resolve(__dirname, dir)
}

// https://github.com/jondot/hygen/issues/322
module.exports = {
  prompt: ({ inquirer, h }) => {
    const inputs = [
      {
        type: 'select',
        name: 'type',
        message: 'Module Type:',
        choices: [
          { name: 'pageblocks', message: 'Content Block' },
          { name: 'pagecontext', message: 'Entry Page' },
          { name: 'layoutcontext', message: 'Site Layout' }
        ]
      },
      {
        type: 'input',
        name: 'name',
        message: 'Module Name:'
      }
    ]

    return inquirer
      .prompt(inputs)
      .then(answers => {
        answers.typePath = h.changeCase.paramCase(answers.type)
        answers.actionfolder = resolvePath(answers.type)
        // remove ending 'block' or 'context' string from name if it exists
        const normalizedName = answers.name.replace(/block|context$/i, '')
        answers.baseName = h.inflection.camelize(normalizedName.replace(/\s/g, '_'), false)
        answers.pathName = h.changeCase.paramCase(normalizedName)
        return inquirer.prompt([]).then(nextAnswers => Object.assign({}, answers, nextAnswers))
      })
  }
}
