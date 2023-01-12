// https://github.com/jondot/hygen/issues/322
module.exports = {
  prompt: ({ inquirer, h }) => {
    const inputs = [
      {
        type: 'select',
        name: 'type',
        message: 'Component Type:',
        choices: [
          '01 - Token',
          '02 - Element',
          '03 - Module',
          '04 - Content Block',
          '05 - Global',
          '06 - Page'
        ]
      },
      {
        type: 'input',
        name: 'name',
        message: 'Component Name:'
      },
      {
        type: 'toggle',
        name: 'jsfile',
        message: 'Generate script file?',
        enabled: 'Yes',
        disabled: 'No'
      }
    ]

    return inquirer
      .prompt(inputs)
      .then(answers => {
        answers.typePath = h.changeCase.paramCase(h.inflection.pluralize(answers.type))
        answers.typeBase = h.changeCase.paramCase(answers.type.split('-').pop())
        answers.baseName = h.changeCase.paramCase(answers.name)
        answers.subaction = answers.type.includes('Content Block') ? 'contentBlock' : 'default'
        return inquirer.prompt([]).then(nextAnswers => Object.assign({}, answers, nextAnswers))
      })
  }
}
