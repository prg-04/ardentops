# E2E Test Template — Minimum Passing Bar

Every critical path E2E test must include the following three assertions.

---

## Playwright Test Template

```typescript
import { test, expect, Page } from '@playwright/test';

/**
 * Minimum passing assertions for every critical path:
 *   1. Status code 200
 *   2. No console errors or uncaught exceptions
 *   3. Visual snapshot comparison
 */
export async function assertPageHealthy(page: Page, url: string) {
  const consoleErrors: string[] = [];

  page.on('console', (msg) => {
    if (msg.type() === 'error') {
      consoleErrors.push(msg.text());
    }
  });

  page.on('pageerror', (err) => {
    consoleErrors.push(err.message);
  });

  const response = await page.goto(url, { waitUntil: 'networkidle' });

  // Assertion 1: Status code 200
  expect(response?.status()).toBe(200);

  // Assertion 2: No console errors or uncaught exceptions
  expect(consoleErrors).toHaveLength(0);

  // Assertion 3: Visual snapshot (baseline committed to /tests/snapshots/)
  await expect(page).toHaveScreenshot({ fullPage: true });
}

// Example usage:
test('Homepage loads without errors', async ({ page }) => {
  await assertPageHealthy(page, '/');
});

test('Contact form page loads without errors', async ({ page }) => {
  await assertPageHealthy(page, '/contact');
});
```

---

## Snapshot Management

- Visual snapshots are committed to Git in `/tests/snapshots/`
- When UI changes intentionally, run: `npx playwright test --update-snapshots`
- When snapshot count exceeds 50, see `docs/SNAPSHOT-MANAGEMENT.md`

---

## AI Agent Rules

- Every new page/route should have an E2E test using this template
- Never skip the console error assertion — it catches hydration issues
- Run `npx playwright test` before marking work complete
