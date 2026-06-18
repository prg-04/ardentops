import { defineConfig, devices } from '@playwright/test';

/**
 * ArdentOps Playwright Config
 * Runs E2E tests against the staging environment.
 * STAGING_URL must be set via Doppler or GitHub Secret.
 */
export default defineConfig({
  testDir: './tests/e2e',
  fullyParallel: true,
  // Fail the build on CI if test.only is accidentally committed
  forbidOnly: !!process.env.CI,
  // Retry failed tests once on CI — catches flaky network issues
  retries: process.env.CI ? 1 : 0,
  // Single worker on CI to avoid race conditions on shared staging
  workers: process.env.CI ? 1 : undefined,
  reporter: [
    ['html', { outputFolder: 'playwright-report' }],
    ['github'], // Annotates GitHub PR with test results
    ['list'],
  ],
  use: {
    baseURL: process.env.STAGING_URL || process.env.APP_URL || 'http://localhost:8080',
    screenshot: 'only-on-failure',
    video: 'retain-on-failure',
    trace: 'on-first-retry',
  },
  projects: [
    {
      name: 'Desktop Chrome',
      use: { ...devices['Desktop Chrome'] },
    },
    {
      name: 'Mobile Safari',
      use: { ...devices['iPhone 13'] },
    },
  ],
  // Output directories
  outputDir: 'test-results/',
});
