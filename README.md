# ArdentOps WordPress Theme

Custom **WordPress Classic** theme generated and maintained under the ArdentOps Unified Agency Engineering Framework (UAEF).

> This repository contains the **generated WordPress theme project**, not the `@ardentops/cli` source package. The active stack is recorded in [`.project-stack`](./.project-stack).

## What this project is

ArdentOps is a traditional PHP WordPress theme for shared hosting / cPanel environments.

It includes:

- WordPress theme setup and lifecycle hooks
- Responsive navigation and theme assets
- Template files for posts, pages, search, archives, comments, and 404 responses
- Sass-based frontend styles compiled to the theme's CSS asset
- JavaScript behavior in `assets/js/main.js`
- Theme helpers under `inc/`
- PHPUnit and Playwright test scaffolding
- GitHub Actions checks for formatting, secrets, PHP standards, tests, E2E, Lighthouse, and dependency scanning

## Theme structure

```text
.
├── assets/
│   ├── css/          Sass source and compiled CSS
│   └── js/           Frontend JavaScript
├── inc/              Shared PHP helpers
├── template-parts/   Reusable WordPress template fragments
├── tests/
│   ├── unit/php/     PHPUnit tests
│   └── e2e/          Playwright tests
├── docs/             Project and operational documentation
├── functions.php     Theme setup, hooks, assets, widgets
├── header.php
├── footer.php
├── index.php
├── page.php
├── single.php
├── archive.php
├── search.php
├── comments.php
├── searchform.php
├── sidebar.php
└── 404.php
```

## Development

The repository is a traditional WordPress theme rather than a Bedrock installation.

Before changing the project, read:

1. [AGENT-RULES.md](./AGENT-RULES.md)
2. [CLAUDE.md](./CLAUDE.md)
3. [CONTRIBUTING.md](./CONTRIBUTING.md)
4. [`.project-stack`](./.project-stack)

Project conventions, testing requirements, security rules, and branch/PR expectations are documented there.

## Testing

The repository includes automated checks for:

- PHP unit tests
- WordPress Coding Standards
- JavaScript/TypeScript tooling
- Playwright end-to-end flows
- Lighthouse checks
- Secret scanning
- Dependency vulnerability scanning

Use the project's existing CI configuration as the source of truth for the commands and environment required in each check.

## Architecture

The active project stack is:

```json
{
  "primary": "wordpress-classic"
}
```

The theme follows the traditional WordPress model:

- **Theme:** presentation, templates, hooks, and frontend assets
- **Plugins:** application/domain functionality that should not be coupled to the theme
- **WordPress core:** external runtime, not stored or modified here
- **Secrets:** managed outside the repository according to the project's operational rules

## Documentation

Useful project documentation lives under [`docs/`](./docs), including environment, testing, branch-protection, secret management, and operational guidance.

## License

MIT