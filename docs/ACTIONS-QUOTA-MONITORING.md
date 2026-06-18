# GitHub Actions Quota Monitoring

## The Constraint

GitHub Free provides **2,000 Actions minutes/month** across all repos in an organization. A single full CI run (lint + test + e2e + lighthouse) can consume 15-25 minutes.

---

## Check Current Usage

```bash
# Organization-level
gh api /orgs/{org}/settings/billing/actions

# Repository-level
gh api /repos/{org}/{repo}/actions/usage
```

---

## Quota Conservation Strategy

### 1. Path Filtering (enforced in CI)

Jobs only trigger when relevant files change:

```yaml
on:
  pull_request:
    paths:
      - 'src/**'
      - 'package.json'
      - 'composer.json'
```

### 2. Dependency Caching (enforced in CI)

- Composer: `~/.composer/cache`
- npm: `node_modules/`
- Playwright browsers: `~/.cache/ms-playwright`
- Next.js build: `.next/cache`

### 3. Merge-Only Jobs (enforced in CI)

These jobs run only on merge to `main`/`develop` — never on every PR push:

- E2E tests (Playwright)
- Lighthouse CI
- Snyk vulnerability scan

### 4. `act` for Local Pipeline Validation

Validate workflow changes locally instead of pushing and waiting:

```bash
brew install act
act pull_request --job lint-and-format
act pull_request --job js-tests
```

### 5. Concurrency Group (enforced in CI)

In-progress runs on the same branch are cancelled automatically:

```yaml
concurrency:
  group: ci-${{ github.ref }}
  cancel-in-progress: true
```

---

## Quota Alert Thresholds

| Usage Level                            | Action                                                                        |
| -------------------------------------- | ----------------------------------------------------------------------------- |
| < 1,000 min by mid-month               | Normal — continue                                                             |
| > 1,500 min projected by mid-month     | Suspend non-critical jobs (scheduled scans, nightly builds) until month reset |
| > 1,800 min projected                  | Emergency — suspend all jobs except CI on production branches                 |
| Consistently > 1,500 min for 2+ months | Budget GitHub Team ($44/user/month) for increased quota                       |

---

## AI Agent Rules

- Do NOT add new CI jobs without engineer approval — every job consumes quota
- Do NOT disable path filters or concurrency groups
- If CI is failing due to quota, tell the engineer — don't disable checks
