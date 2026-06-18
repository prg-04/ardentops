# AI Agent Token Setup Guide

This document defines how to create GitHub tokens for AI coding agents (Continue.dev, Claude, Cursor, Copilot Workspace) operating in ArdentOps repositories.

**Rule:** AI agents open Pull Requests. AI agents never merge Pull Requests.

---

## Creating a Fine-Grained Token for an AI Agent

1. Go to: `https://github.com/settings/personal-access-tokens/new`
2. Set **Token name**: `ai-agent-{project-slug}` (e.g. `ai-agent-typetopia-wp`)
3. Set **Expiration**: 90 days (calendar-reminder to rotate)
4. Set **Resource owner**: `ArdentOps`
5. Set **Repository access**: Only select repositories → choose the specific project repo

### Repository Permissions

| Permission         | Access             | Reason                                  |
| ------------------ | ------------------ | --------------------------------------- |
| Contents           | **Read and write** | Read files, push to feature/\* branches |
| Pull requests      | **Read and write** | Open PRs against develop                |
| Issues             | **Read-only**      | Context gathering                       |
| Actions            | **Read-only**      | Pipeline status awareness               |
| Commit statuses    | **Read-only**      | CI status checks                        |
| Metadata           | **Read-only**      | Required by GitHub                      |
| **Secrets**        | **None**           | ABSOLUTE PROHIBITION                    |
| **Administration** | **None**           | ABSOLUTE PROHIBITION                    |
| **Deployments**    | **None**           | Agents never deploy                     |
| **Environments**   | **None**           | No environment access                   |
| **Workflows**      | **None**           | Cannot modify CI pipeline               |

6. Click **Generate token**
7. Store the token in **Doppler** under the `dev` config for the project:
   - Key: `AI_AGENT_GITHUB_TOKEN`
   - Never put this in `.env`, Notion, or Slack

---

## Configure the Agent

### Continue.dev

Add to your VS Code `settings.json` or `config.json`:

```json
{
  "models": [
    {
      "title": "Claude (ArdentOps)",
      "provider": "anthropic",
      "model": "claude-sonnet-4-20250514",
      "apiKey": "YOUR_ANTHROPIC_API_KEY"
    }
  ],
  "contextProviders": [
    {
      "name": "file",
      "params": {}
    },
    {
      "name": "codebase",
      "params": {}
    }
  ],
  "rules": ".continue/rules.md"
}
```

The `rules` field points to `.continue/rules.md` — the behavioral contract created during bootstrap.

### AI Agent Documentation Reference

Agents should also consult the `docs/` directory for framework operational knowledge:

| Doc                                  | What It Covers                                                  |
| ------------------------------------ | --------------------------------------------------------------- |
| `docs/BOOTSTRAP-SEQUENCE.md`         | How projects are set up — read before making structural changes |
| `docs/BRANCH-PROTECTION-SETUP.md`    | Branch strategy — which branches exist, who can push where      |
| `docs/TESTING-STANDARDS.md`          | Coverage targets, test types, agent testing rules               |
| `docs/DOPPLER-SETUP-GUIDE.md`        | Secrets management — critical for environment variable work     |
| `docs/ACTIONS-QUOTA-MONITORING.md`   | CI budget constraints — why you shouldn't add new jobs          |
| `docs/E2E-TEST-TEMPLATE.md`          | Required E2E test pattern                                       |
| `docs/INCIDENT-RESPONSE-TEMPLATE.md` | Incident protocol — important during live incidents             |
| `docs/decisions/`                    | Architecture Decision Records — explains _why_ things are done  |

---

## Token Rotation Policy

- Tokens expire after 90 days
- Set a calendar reminder 1 week before expiry
- Rotate by creating a new token with identical permissions
- Update the value in Doppler — no code changes required
- Revoke the old token immediately after rotation

---

## If an Agent Token Is Compromised

1. **Immediately revoke** the token: `https://github.com/settings/personal-access-tokens`
2. Audit recent commits and PRs from that agent for the past 7 days
3. Check `https://github.com/orgs/ArdentOps/audit-log` for unexpected API activity
4. Issue a new token and update Doppler
5. Document the incident in `docs/incidents/`
