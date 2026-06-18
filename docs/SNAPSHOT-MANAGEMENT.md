# Snapshot Management — Visual Regression Testing

## Phase 1: Git-Committed (0-50 snapshots)

Visual regression snapshots live in `/tests/snapshots/` and are committed to Git. This is the default for all projects.

**Workflow:**

```bash
# Update baselines when UI changes intentionally
npx playwright test --update-snapshots

# Review the diff before committing
git diff tests/snapshots/
```

## Phase 2: External Storage (50+ snapshots)

When snapshot count exceeds 50, **or** total snapshot size exceeds 100MB, migrate:

1. Create an S3-compatible bucket
2. Set `SNAPSHOT_BASE_URL` environment variable pointing to the bucket
3. Add a CI step to upload snapshots
4. Update `playwright.config.ts`:

```typescript
export default {
  snapshotPathTemplate: process.env.SNAPSHOT_BASE_URL
    ? `{projectDir}/tests/snapshots/{arg}{ext}`
    : undefined,
};
```

5. Remove committed snapshots from Git
6. Add `/tests/snapshots/*.png` to `.gitignore`

---

## AI Agent Rules

- Never delete or modify snapshot baselines unless the UI intentionally changed
- When adding new pages with dynamic content, consider using `expect(page).toHaveScreenshot({ mask: [page.locator('.dynamic-content')] })` instead of full-page snapshots
- Run `npx playwright test --update-snapshots` after intentional visual changes, but never commit stale snapshots
