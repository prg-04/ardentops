# Branch Protection Manual Setup Guide

Use this guide if `scripts/protect-branches.sh` is unavailable (no `gh` CLI, no admin access yet).

Apply these settings to **both** `main` and `develop` branches.

---

## GitHub UI Steps

1. Go to: `https://github.com/ArdentOps/{REPO}/settings/branches`
2. Click **Add branch ruleset** (or edit existing rule)
3. Apply the settings below

---

## Settings Checklist — Apply to `main` AND `develop`

### Branch name pattern

```
main
```

(repeat for `develop`)

### Protect matching branches

| Setting                                        | Value                               |
| ---------------------------------------------- | ----------------------------------- |
| Require a pull request before merging          | ✅ Enabled                          |
| → Required approvals                           | `1` (increase to `2` when team ≥ 5) |
| → Dismiss stale pull request approvals         | ✅ Enabled                          |
| → Require review from Code Owners              | ✅ Enabled                          |
| → Require approval of the most recent push     | ✅ Enabled                          |
| Require status checks to pass before merging   | ✅ Enabled                          |
| → Require branches to be up to date            | ✅ Enabled                          |
| → Required status checks                       | `lint-and-format`                   |
| Require conversation resolution before merging | ✅ Enabled                          |
| Require linear history                         | ✅ Enabled                          |
| Do not allow bypassing the above settings      | ✅ Enabled                          |
| Allow force pushes                             | ❌ Disabled                         |
| Allow deletions                                | ❌ Disabled                         |

### Additional for `main` only

| Setting                | Value            |
| ---------------------- | ---------------- |
| Require signed commits | ✅ Enabled (GPG) |

---

## Notes

- The `lint-and-format` status check only appears as an option **after the first CI run** has completed on a PR. Until then, leave required checks empty and add it retroactively.
- CODEOWNERS (`.github/CODEOWNERS`) only works when the branch protection rule includes **"Require review from Code Owners"**.
- If GitHub Teams (`@ArdentOps/seniors`) are not yet created, CODEOWNERS falls back to no auto-assignment. Create teams first at: `https://github.com/orgs/ArdentOps/teams`

---

## GitHub Teams to Create

Before CODEOWNERS works correctly, create these teams at `https://github.com/orgs/ArdentOps/teams`:

| Team slug        | Members                            | Description                      |
| ---------------- | ---------------------------------- | -------------------------------- |
| `seniors`        | All senior engineers               | Default reviewer for all changes |
| `cto`            | CTO account                        | Infrastructure and CI reviewer   |
| `wordpress-lead` | Designated WP engineer per project | Theme and plugin reviewer        |

---

## Related Documentation

- `docs/BOOTSTRAP-SEQUENCE.md` — Full project setup sequence, including when to apply branch protection
- `docs/decisions/ADR-001-uaef-stack-adoption.md` — Why this branch strategy exists
- `docs/HANDOFF-CHECKLIST.md` — Branch protection verification during handoff
