// eslint.config.js — ESLint v9 flat config
// Used for webapp projects. WordPress projects use PHPCS instead.
import js from '@eslint/js';

export default [
  js.configs.recommended,
  {
    rules: {
      // Error on these — blocks CI
      'no-console': ['error', { allow: ['warn', 'error'] }],
      'no-unused-vars': ['error', { argsIgnorePattern: '^_' }],
      'no-undef': 'error',
      'no-var': 'error',
      'prefer-const': 'error',
      'no-promise-executor-return': 'error',
      'no-await-in-loop': 'error',
      'require-await': 'error',

      // Warn — logged but does not block
      'no-warning-comments': ['warn', { terms: ['todo', 'fixme', 'hack'] }],
    },
    languageOptions: {
      ecmaVersion: 2022,
      sourceType: 'module',
    },
  },
  {
    // Ignore generated and dependency paths
    ignores: [
      'node_modules/**',
      'vendor/**',
      'dist/**',
      'build/**',
      'coverage/**',
      'playwright-report/**',
      '*.min.js',
    ],
  },
];
