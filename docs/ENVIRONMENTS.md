# Environments

> Update this file during bootstrap. Keep it current for every environment change.

## Project

| Item            | Value                 |
| --------------- | --------------------- |
| Name            | `{{PROJECT_SLUG}}`    |
| Stack           | `{{PROJECT_STACK}}`   |
| Primary adapter | `{{PRIMARY_ADAPTER}}` |

## URLs

| Environment | URL                                  | Notes                                    |
| ----------- | ------------------------------------ | ---------------------------------------- |
| Local       | `https://{{PROJECT_SLUG}}.lndo.site` | Lando — run `doppler run -- lando start` |
| Staging     | `https://staging.{{DOMAIN}}`         | Auto-deploys on merge to `develop`       |
| Production  | `https://{{DOMAIN}}`                 | Deploys on merge to `main`               |

## Doppler

| Item                | Value                           |
| ------------------- | ------------------------------- |
| Project             | `{{PROJECT_SLUG}}`              |
| Dashboard           | `https://dashboard.doppler.com` |
| Config (local)      | `dev`                           |
| Config (staging)    | `staging`                       |
| Config (production) | `production`                    |

## GitHub

| Item         | Value                                                                    |
| ------------ | ------------------------------------------------------------------------ |
| Repository   | `https://github.com/ArdentOps/{{PROJECT_SLUG}}`                          |
| Actions      | `https://github.com/ArdentOps/{{PROJECT_SLUG}}/actions`                  |
| Branch rules | `https://github.com/ArdentOps/{{PROJECT_SLUG}}/settings/branches`        |
| Repo secrets | `https://github.com/ArdentOps/{{PROJECT_SLUG}}/settings/secrets/actions` |

## Required GitHub Repository Secrets

| Secret                  | Description                                 | Where to Get It                                     |
| ----------------------- | ------------------------------------------- | --------------------------------------------------- |
| `SNYK_TOKEN`            | Snyk API token for vulnerability scanning   | https://app.snyk.io/account                         |
| `STAGING_URL`           | Full staging URL for E2E + Lighthouse       | Set after first staging deploy                      |
| `DOPPLER_CI_TOKEN`      | Doppler CI service token                    | Doppler → project → staging config → service tokens |
| `LHCI_GITHUB_APP_TOKEN` | Optional — richer Lighthouse CI PR comments | https://github.com/apps/lighthouse-ci               |

## Hosting

| Item          | Value                |
| ------------- | -------------------- |
| Provider      | {{HOSTING_PROVIDER}} |
| Control panel | {{HOSTING_URL}}      |
| Deploy method | {{DEPLOY_METHOD}}    |

## Backup

| Item                  | Value                         |
| --------------------- | ----------------------------- |
| Tool                  | {{BACKUP_TOOL}}               |
| Schedule              | {{BACKUP_SCHEDULE}}           |
| Destination           | {{BACKUP_DESTINATION}}        |
| Last verified restore | `YYYY-MM-DD` — update monthly |
