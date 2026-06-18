/** @type {import('@commitlint/types').UserConfig} */
module.exports = {
  extends: ['@commitlint/config-conventional'],
  rules: {
    // Enforce known scopes — add project-specific scopes when needed
    'scope-enum': [
      2,
      'always',
      ['theme', 'plugin', 'api', 'infra', 'ci', 'deps', 'docs', 'auth', 'db'],
    ],
    'scope-empty': [1, 'never'], // warn if scope is missing
    'subject-max-length': [2, 'always', 100],
    'subject-full-stop': [2, 'never', '.'],
    'header-max-length': [2, 'always', 120],
    'body-max-line-length': [2, 'always', 200],
  },
};
