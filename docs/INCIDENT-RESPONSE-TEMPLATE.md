# Incident Response Runbook Template

## Severity Classification

| Severity                      | Definition                                        | Response SLA                              |
| ----------------------------- | ------------------------------------------------- | ----------------------------------------- |
| P0 — Site Down                | Production returns 5xx or no response             | 15 min to acknowledge, 1 hour to resolve  |
| P1 — Critical Function Broken | Checkout/form/auth broken, site loads             | 1 hour to acknowledge, 4 hours to resolve |
| P2 — Degraded Performance     | Latency > 2x normal, non-critical features broken | Next business day                         |
| P3 — Cosmetic / Minor         | UI issues, non-breaking errors                    | Scheduled sprint                          |

---

## P0 Response Steps

```markdown
## P0 Incident — {Project Name}

**Step 1 — Acknowledge (< 15 min)**

- Post in team channel: "P0 acknowledged for {project}. Owner: {name}"
- Notify client via agreed channel

**Step 2 — Triage (< 30 min)**

- [ ] Check uptime monitor for which endpoints are failing
- [ ] Check error rate dashboard (Grafana, Sentry, etc.)
- [ ] Check hosting provider status page
- [ ] Check last deployment time — was this deploy-induced?
- [ ] Check application health endpoints

**Step 3 — Contain**

- [ ] If deploy-induced: rollback immediately
- [ ] If plugin-induced (WordPress): deactivate via WP-CLI
- [ ] If infrastructure: escalate to hosting provider

**Step 4 — Resolve & Verify**

- [ ] Confirm recovery via monitoring
- [ ] Manual check of all critical paths
- [ ] Error rate returns below baseline

**Step 5 — Post-Mortem (within 48 hours)**

- [ ] Root cause documented in docs/incidents/{date}-{slug}.md
- [ ] Prevention measure identified and ticketed
```

---

## AI Agent Rules

- If an incident is active, stop all non-incident work
- Do NOT deploy changes during an active P0/P1 unless explicitly asked
- Do NOT modify monitoring, alerting, or rollback infrastructure without engineer approval
