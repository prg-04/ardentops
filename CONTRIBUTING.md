# Contributing — ArdentOps Projects

This document applies to all contributors: human engineers and AI coding agents.

---

## Branch Naming

| Pattern                      | Purpose                      | Example                    |
| ---------------------------- | ---------------------------- | -------------------------- |
| `feature/{ticket-id}-{slug}` | New features                 | `feature/AO-42-hero-block` |
| `fix/{ticket-id}-{slug}`     | Bug fixes                    | `fix/AO-51-nav-collapse`   |
| `hotfix/{slug}`              | Emergency production patches | `hotfix/broken-checkout`   |
| `release/{version}`          | Release preparation          | `release/1.4.0`            |
| `chore/{slug}`               | Dependencies, tooling        | `chore/update-acf`         |

All branches target `develop`. Only senior engineers and release managers create `release/*` or `hotfix/*` branches.

**AI agents:** create `feature/*` and `fix/*` branches only. Open PRs against `develop` only.

---

## Commit Message Format

This project uses [Conventional Commits](https://www.conventionalcommits.org/).

```
{type}({scope}): {short description}

[optional body]

[optional footer: BREAKING CHANGE or issue reference]
```

### Types

| Type       | When to use                          |
| ---------- | ------------------------------------ |
| `feat`     | New feature or behaviour             |
| `fix`      | Bug fix                              |
| `refactor` | Code change with no behaviour change |
| `test`     | Adding or updating tests             |
| `docs`     | Documentation changes                |
| `chore`    | Dependencies, tooling, config        |
| `perf`     | Performance improvement              |
| `style`    | Formatting only (no logic change)    |
| `ci`       | GitHub Actions or CI changes         |

### Scopes

| Scope    | Applies to                    |
| -------- | ----------------------------- |
| `theme`  | WordPress theme               |
| `plugin` | WordPress plugin              |
| `api`    | API routes or integrations    |
| `infra`  | Docker, Lando, hosting config |
| `ci`     | GitHub Actions workflows      |
| `deps`   | Dependency updates            |
| `docs`   | Documentation                 |
| `auth`   | Authentication                |
| `db`     | Database migrations           |

### Examples

```
feat(theme): add sticky navigation with scroll state
fix(plugin): escape output in contact form shortcode
chore(deps): update ACF to 6.3.1
ci: add path filtering to reduce Actions quota usage
docs(api): update openapi.yaml with webhook endpoint
test(plugin): add PHPUnit coverage for form handler
```

### Rules enforced by commitlint

- Subject under 100 characters
- No period at end of subject
- Scope is required (warning if missing)
- Body lines under 200 characters

---

## Pull Request Checklist

Before opening a PR, confirm all of these:

**Code**

- [ ] Pre-commit hooks pass locally (`git commit` completes without errors)
- [ ] No secrets, credentials, or API keys in any changed file
- [ ] All new PHP output is escaped (`esc_html()`, `esc_attr()`, `esc_url()`)
- [ ] All new forms and AJAX handlers include nonce verification
- [ ] No `$wpdb->query()` with user input (use `$wpdb->prepare()`)
- [ ] No `any` types in TypeScript without justification comment

**Tests**

- [ ] New PHP functions have a PHPUnit test in `tests/unit/php/`
- [ ] New JS functions have a Vitest test in `tests/unit/`
- [ ] New critical user paths have a Playwright test in `tests/e2e/flows/`
- [ ] Coverage thresholds still met: `npm run test:coverage` / `composer test`

**Documentation**

- [ ] ADR written if this PR makes a significant architectural decision
- [ ] `docs/ENVIRONMENTS.md` updated if URLs or services changed
- [ ] `README.md` updated if setup steps changed

**PR Description**

- [ ] Linked to the relevant ticket/issue
- [ ] Describes what changed and why (not just what)
- [ ] Screenshots included for any visual changes

---

## Code Review Standards

Reviewers check for:

1. **Correctness** — Does it do what it claims? Are edge cases handled?
2. **Security** — Escaped output? Nonce checks? No hardcoded credentials?
3. **Standards** — WPCS compliant? ESLint clean? Consistent with existing patterns?
4. **Tests** — Coverage added? Assertions meaningful (not just `assertTrue(true)`)?
5. **DRY** — Is this logic duplicated from elsewhere? Should it be extracted?

Reviewers should be specific. "This looks fine" is not an approval. Link to the relevant section of standards or this document when requesting changes.

---

## AI Agent Pull Requests

AI-authored PRs follow the same checklist. Additional reviewer checks:

- [ ] No hallucinated API endpoints (verify against `docs/openapi.yaml`)
- [ ] No new packages added without explicit engineer instruction
- [ ] `.github/workflows/`, `.lando.yml`, `CODEOWNERS`, `composer.json`, `package.json` were not modified
- [ ] Logic is readable and explicit — not obfuscated
