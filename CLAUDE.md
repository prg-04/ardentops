# Working with Claude on ArdentOps

## Quick Facts

- **Tech Stack:** WordPress — Classic (Shared Hosting / cPanel)
- **AI Guide:** This file — explains how the project works
- **Guardrails:** `AGENT-RULES.md` — what AI agents MUST NOT do
- **Composition:** `.project-stack` — confirms which adapters are active

## Project Structure

### WordPress — Classic (Shared Hosting / cPanel)

```
wp-content/themes/{slug}/           Active theme (template files, functions.php, style.css)
wp-content/plugins/                 Custom plugins
wp-content/mu-plugins/              Must-use plugins (auto-loaded)
wp-content/uploads/                 Media uploads (not in version control)
```

Additional UAEF files are placed at the project root (CI configs, linting, etc.).
See the generated file list above for the full picture.

## How This Project Works

WordPress hooks (actions/filters) drive the request lifecycle. Themes control presentation; plugins add functionality. The Loop processes posts/pages from the database.

## Important Files

- `.project-stack` — This project's composition (which adapters are active)
- `AGENT-RULES.md` — Guardrails and behavioral contract (READ THIS FIRST)
- `README.md` — Project overview and setup instructions
- `docs/decisions/` — Architecture Decision Records
- `.env.example` — Required environment variables (documented per stack)

## Common Workflows

### Working with WordPress — Classic (Shared Hosting / cPanel)

- Edit theme: modify `wp-content/themes/{slug}/` files
- Add a plugin: create `wp-content/plugins/{{name}}/{{name}}.php`
- Activate: WP Admin → Plugins or Themes
- Run tests: `composer test`

## Before You Start

- [ ] Read `AGENT-RULES.md` (required — this is your behavioral contract)
- [ ] Read `.project-stack` to confirm the active adapters
- [ ] Run the project's test suite to verify the baseline
- [ ] Review `docs/decisions/` for relevant ADRs
- [ ] Check `.env.example` for required environment variables