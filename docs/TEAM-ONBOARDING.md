# ArdentOps — Team Onboarding Guide

> Update this file during bootstrap. Keep it current for every project change.

There are two roles in the project lifecycle. Find yours below.

---

## Role A — Project Lead

_You create the project. Team members never do this._

### Prerequisites (one-time machine setup)

```bash
# 1. Install gh CLI and authenticate
brew install gh          # macOS — see https://cli.github.com for Linux
gh auth login
gh auth status           # confirm: Logged in to github.com as <you>

# 2. Clone the project template
git clone https://github.com/ArdentOps/ardentops-project-template.git
cd ardentops-project-template
```

### Create a New Project

```bash
# Greenfield — creates a new project directory from the template
bash scripts/bootstrap.sh

# Or with explicit adapter selection:
bash scripts/bootstrap.sh --compose
# This shows a multi-select UI — pick the adapters your project needs:
#   [✔] nextjs         (App Router, Vercel or VPS)
#   [✔] wordpress-bedrock  (Roots Bedrock, VPS)
#   [ ] node-api        (Express/Fastify/Hono)
#   ... etc

# Or add adapters after bootstrap:
bin/ardentops stack add nextjs
bin/ardentops stack add wordpress-bedrock
```

### After Bootstrap — Manual Steps

```text
1. Create Doppler project
   → https://dashboard.doppler.com/workplace/ArdentOps/projects
   → New project: {project-slug}
   → Create configs: dev / staging / production
   → Add all secrets from .env.example

2. Add GitHub repository secrets
   → https://github.com/ArdentOps/{project-slug}/settings/secrets/actions
   → SNYK_TOKEN       (from https://app.snyk.io/account)
   → DOPPLER_CI_TOKEN (from Doppler → project → staging → service tokens)
   → STAGING_URL      (add after first staging deploy)

3. Apply branch protection
   → bash scripts/protect-branches.sh (if gh CLI is configured)
   → Or follow docs/BRANCH-PROTECTION-SETUP.md for manual setup

4. Push and share the repo URL with the team
```

---

## Role B — Team Member

_You join an existing project. You never run `bootstrap.sh --compose`._

### Prerequisites (one-time machine setup)

| Tool           | Version | Install                                                                            |
| -------------- | ------- | ---------------------------------------------------------------------------------- |
| nvm            | Latest  | `curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh \| bash` |
| Node.js        | 20 LTS  | `nvm install 20 && nvm use 20 && nvm alias default 20`                             |
| Docker Desktop | Latest  | https://docs.docker.com/get-docker                                                 |
| Lando          | Latest  | https://lando.dev/download                                                         |
| Doppler CLI    | Latest  | `brew install dopplerhq/cli/doppler`                                               |
| gh CLI         | Latest  | `brew install gh`                                                                  |
| Composer       | 2.x     | `brew install composer` (WordPress projects only)                                  |

**Verify:**

```bash
node --version    # v20.x.x
docker --version  # Docker version 24+
lando version     # v3.x.x
doppler --version # 3.x.x
gh --version      # gh version 2.x.x
```

### Join a Project

```bash
# 1. Clone
git clone https://github.com/ArdentOps/{project-slug}.git
cd {project-slug}

# 2. Bootstrap local tooling
bash scripts/bootstrap.sh
# → Confirms Node version
# → Detects project type from .project-stack
# → Installs npm deps
# → Activates Husky git hooks
# → Installs Composer deps (if WordPress adapter composed)

# 3. Set up Doppler
doppler login        # one-time auth — opens browser
doppler setup        # select project + 'dev' config

# 4. Start local environment
doppler run -- lando start

# 5. Verify
lando info           # shows local URLs
```

### Daily Workflow

```bash
# Start
doppler run -- lando start

# Stop
lando stop

# WP-CLI (WordPress projects only)
lando wp {command}

# Run tests
npm run test           # JS unit
composer test          # PHP unit (if WordPress/Laravel)
npm run test:e2e       # Playwright (requires STAGING_URL)

# Check formatting
npm run format:check
npm run lint:js
```

### Making a Commit

```bash
# Create a branch (never commit directly to main or develop)
git checkout -b feature/AO-42-hero-block

# Stage and commit — Husky runs automatically:
#   ✅ Secretlint
#   ✅ ESLint / PHPCS
#   ✅ Prettier
#   ✅ commitlint (conventional commit format)
git add .
git commit -m "feat(theme): add hero block with scroll animation"

# Push and open a PR against develop
git push -u origin feature/AO-42-hero-block
gh pr create --base develop --title "feat(theme): add hero block" --body "..."
```

**Commit format:**

```
{type}({scope}): {description}

Types:  feat fix refactor test docs chore perf style ci
Scopes: theme plugin api infra ci deps docs auth db
```

---

## Project Stack

This project's stack is defined in `.project-stack`:

```json
{
  "version": 1,
  "adapters": ["nextjs", "wordpress-bedrock"],
  "primary": "nextjs"
}
```

AI agents read this file to understand which stack rules apply. Never modify it without engineer approval.

---

## Documentation Reference

| File                                 | Audience     | What It Covers                       |
| ------------------------------------ | ------------ | ------------------------------------ |
| `docs/BOOTSTRAP-SEQUENCE.md`         | Both         | Full project setup order             |
| `docs/BRANCH-PROTECTION-SETUP.md`    | Both         | Branch rules and GitHub setup        |
| `docs/TESTING-STANDARDS.md`          | Both         | Coverage targets, test types         |
| `docs/DOPPLER-SETUP-GUIDE.md`        | Both         | Secrets workflow                     |
| `docs/AI-AGENT-TOKEN-SETUP.md`       | Project lead | GitHub token creation for agents     |
| `docs/ACTIONS-QUOTA-MONITORING.md`   | Both         | CI budget management                 |
| `docs/INCIDENT-RESPONSE-TEMPLATE.md` | Both         | Incident runbook                     |
| `docs/HANDOFF-CHECKLIST.md`          | Project lead | Project delivery checklist           |
| `docs/E2E-TEST-TEMPLATE.md`          | Both         | Playwright test pattern              |
| `docs/SNAPSHOT-MANAGEMENT.md`        | Both         | Visual regression strategy           |
| `docs/UPGRADE-TRIGGERS.md`           | Project lead | Free-tier upgrade decision guide     |
| `docs/ASSET-OPTIMIZATION.md`         | Both         | Performance patterns                 |
| `docs/ENVIRONMENTS.md`               | Both         | Environment URLs and credentials map |
| `docs/decisions/`                    | Both         | Architecture Decision Records        |

---

## Quick Reference Card

```
New project (project lead):
  git clone template → bootstrap.sh --compose → push → doppler setup

Join existing project (team member):
  git clone → bootstrap.sh → doppler setup → lando start

Daily:
  doppler run -- lando start    start
  lando stop                    stop
  lando wp {cmd}                WP-CLI (WordPress only)
  npm run test                  unit tests

Commit format:
  feat(theme): description
  fix(plugin): description
  chore(deps): description

Retrofit existing project:
  bash scripts/bootstrap.sh --retrofit /path/to/existing-project

Add an adapter to an existing project:
  bin/ardentops stack add shopify-liquid
```
