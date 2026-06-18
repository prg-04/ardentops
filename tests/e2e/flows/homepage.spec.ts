import { test, expect } from '@playwright/test';

/**
 * Homepage — Critical Path Tests
 * Delete or modify these when real critical paths are defined.
 * Every project must define its own critical paths in tests/e2e/flows/.
 */

test.describe('Homepage', () => {
  test('loads without JS console errors', async ({ page }) => {
    const consoleErrors: string[] = [];

    page.on('console', (msg) => {
      if (msg.type() === 'error') {
        consoleErrors.push(msg.text());
      }
    });

    await page.goto('/');
    await expect(page).toHaveTitle(/.+/);

    expect(consoleErrors, `Console errors found: ${consoleErrors.join(', ')}`).toHaveLength(0);
  });

  test('critical layout elements are visible', async ({ page }) => {
    await page.goto('/');

    await expect(page.locator('nav, header')).toBeVisible();
    await expect(page.locator('main')).toBeVisible();
    await expect(page.locator('footer')).toBeVisible();
  });

  test('loads within acceptable time', async ({ page }) => {
    const startTime = Date.now();
    await page.goto('/');
    const loadTime = Date.now() - startTime;

    // Warn if load exceeds 3s on staging (not a hard failure)
    if (loadTime > 3000) {
      console.warn(`Homepage load time: ${loadTime}ms — review performance`);
    }

    expect(loadTime).toBeLessThan(8000);
  });
});
