# Doppler Secrets Workflow

This document supersedes manual `.env` file management. All environment variables are distributed through Doppler.

---

## Prerequisites

Install the Doppler CLI:

```bash
# macOS
brew install dopplerhq/cli/doppler

# Linux (Ubuntu/Debian)
sudo apt-get update && sudo apt-get install -y apt-transport-https ca-certificates curl gnupg
curl -sLf --retry 3 https://packages.doppler.com/public/cli/gpg.gpg | sudo gpg --dearmor -o /usr/share/keyrings/doppler-archive-keyring.gpg
echo "deb [signed-by=/usr/share/keyrings/doppler-archive-keyring.gpg] https://packages.doppler.com/public/cli/deb/debian any-version main" | sudo tee /etc/apt/sources.list.d/doppler.list
sudo apt-get update && sudo apt-get install doppler
```

---

## One-Time Developer Setup

```bash
doppler login
# Opens browser — authenticate with your ArdentOps Doppler account

doppler setup
# Select project → select 'dev' config
```

---

## Running the Local Stack

```bash
# Replaces: cp .env.example .env && lando start
doppler run -- lando start
```

**Verify:**

```bash
lando wp option get siteurl    # WordPress
# or check browser at local URL
```

---

## CI Integration

In CI pipelines, use `DOPPLER_TOKEN` from GitHub Secrets:

```yaml
- name: Sync environment
  run: doppler secrets download --no-file --format env >> $GITHUB_ENV
  env:
    DOPPLER_TOKEN: ${{ secrets.DOPPLER_CI_TOKEN }}
```

The `DOPPLER_CI_TOKEN` is the **one exception** to "no secrets in GitHub Secrets UI" — see `docs/BOOTSTRAP-SEQUENCE.md` step 3.

---

## Security Boundaries

- **Zero disk footprint:** Doppler streams secrets into process memory. Never write secrets to `.env` files.
- **AI agent isolation:** Agent tokens are single-project read-only. No dashboard access, no staging/production credentials.
- **Engineer tokens:** Full access within assigned project. No access to other client projects.

---

## Environment Structure

| Doppler Config | Maps To           | Used By                      |
| -------------- | ----------------- | ---------------------------- |
| `dev`          | Local development | `doppler run -- lando start` |
| `staging`      | Staging server    | CI E2E tests, Lighthouse     |
| `production`   | Production server | Deploy pipeline              |

---

## AI Agent Rules

- NEVER read `.env` files — they should not exist
- NEVER output, log, or reference secret values
- NEVER store secrets in code or commit them
- Use `process.env.VAR_NAME` (or equivalent) in code — never hardcode values
- If you need a new environment variable, ask the engineer to add it in Doppler
