# Backup Policy — WordPress (Classic)

## Schedule

| Data                         | Frequency          | Retention      | Tool            |
| ---------------------------- | ------------------ | -------------- | --------------- |
| Database                     | Daily              | 30 days        | UpdraftPlus     |
| Uploads (wp-content/uploads) | Weekly             | 90 days        | UpdraftPlus     |
| Full filesystem              | Before each deploy | Last 3 deploys | Server snapshot |

## Destination

- Primary: Google Drive (client-owned account)
- Secondary: Server-level automated snapshot (hosting provider)

## Verification

- Test restore procedure quarterly
- Document last verified restore date in `docs/ENVIRONMENTS.md`
- AI agents: Do NOT perform backup restore — refer to a human engineer

## Restore Procedure

```bash
# Via UpdraftPlus admin UI:
# 1. Settings → UpdraftPlus → Existing backups
# 2. Select the backup to restore
# 3. Choose which components (DB / files / both)
# 4. Confirm restore
```

---

## AI Agent Rules

- Never modify backup configurations, schedules, or destinations without engineer approval
- Never attempt to restore a backup yourself — involve a human engineer
- If backup verification is due, remind the project lead
