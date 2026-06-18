# Free-Tier Upgrade Triggers

When each free-tier tool should be upgraded to a paid plan.

---

## Doppler Free → Pro ($36/mo)

| Threshold                                     | Action                                                                                  |
| --------------------------------------------- | --------------------------------------------------------------------------------------- |
| Project count exceeds 3                       | Upgrade all projects to Pro, or consolidate under one project with environment prefixes |
| Team exceeds 3 members needing secrets access | Upgrade to Pro for team management                                                      |

**Alternative before upgrading:** Keep all clients in a single Doppler project with `{client}-{env}` environment naming (e.g., `client-portal-dev`, `client-portal-staging`). Split when environments exceed 15.

---

## Grafana Cloud Free → Pro

| Threshold               | Action                                       |
| ----------------------- | -------------------------------------------- |
| Team exceeds 3 seats    | Upgrade Grafana to Pro ($49/mo for 10 users) |
| Logs exceed 50 GB/month | Archive old dashboards or upgrade            |

---

## Snyk Free → Team ($26/mo/developer)

| Threshold                           | Action                                       |
| ----------------------------------- | -------------------------------------------- |
| More than 10 active repos           | Prioritize Snyk scans to critical repos only |
| 100 code scans/month exceeded       | Move Snyk to weekly scheduled scans          |
| 200 dependency tests/month exceeded | Upgrade to Team tier                         |

**Default strategy before upgrading:** Tighten Snyk scheduling — run on merge to main/develop only. Supplement with weekly scheduled scans.

---

## GitHub Free → Team ($44/mo/user)

| Threshold                                            | Action                                                                                    |
| ---------------------------------------------------- | ----------------------------------------------------------------------------------------- |
| Actions quota projected > 1,500 min by mid-month     | Suspend non-critical jobs, review path filtering (see `docs/ACTIONS-QUOTA-MONITORING.md`) |
| Actions quota consistently > 1,500 min for 2+ months | Budget GitHub Team                                                                        |
| 10+ active repos under the org                       | Evaluate GitHub Team for managed org features                                             |

---

## AI Agent Rules

- Do NOT upgrade any tool's plan without engineer approval
- If CI quota is being hit, optimize before suggesting a paid upgrade — see `docs/ACTIONS-QUOTA-MONITORING.md`
- If you hit a rate limit from Snyk/Doppler/etc., report it — don't work around it
