/*
  Paths to be excluded from manifest export.
  Uses https://github.com/micromatch/micromatch for the rule matching
*/
module.exports = [
  '/01-tokens/*',
  '/01-templates/*',
  '/preview.twig'
]
