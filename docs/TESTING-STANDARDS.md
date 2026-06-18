# Testing Standards

Both developers and AI agents must adhere to these testing standards. The specific stack determines which layers apply — see `.project-stack` to know which are active.

---

## Testing Stack

| Layer             | Tool                          | Applies To                                        |
| ----------------- | ----------------------------- | ------------------------------------------------- |
| PHP Unit          | PHPUnit 10+                   | WordPress plugins/themes, Laravel                 |
| PHP Mocking       | WP_Mock                       | WP hooks, filters, shortcodes (WordPress only)    |
| PHP Integration   | PHPUnit + WordPress bootstrap | DB queries, REST API (WordPress only)             |
| JavaScript Unit   | Vitest                        | Custom JS modules, React components               |
| E2E / Browser     | Playwright                    | Critical user paths, form submissions, auth flows |
| Visual Regression | Playwright snapshots          | UI layout changes — run on staging                |
| Performance       | Lighthouse CI                 | Core Web Vitals, enforced in CI                   |

---

## Coverage Targets

| Code Type          | Minimum Coverage            | Blocking in CI                 |
| ------------------ | --------------------------- | ------------------------------ |
| Custom plugin PHP  | 70%                         | Yes — PR fails below threshold |
| Custom theme PHP   | 40%                         | No — warning only              |
| JavaScript modules | 80%                         | Yes                            |
| E2E critical paths | All defined paths must pass | Yes                            |

---

## WP_Mock vs Integration Test Boundary (WordPress)

- **Use WP_Mock** for pure hook/filter logic, shortcode rendering, and isolated function tests that don't touch the database, HTTP responses, or theme templates. These cost milliseconds.
- **Use full WordPress bootstrap (integration)** for any test that touches the database, REST API endpoints, session state, or template rendering. These cost 2-3 seconds per bootstrap.

**Rule of thumb:** If your test calls `$wpdb`, `wp_remote_get()`, or renders a template, use integration. If it only reacts to WordPress events (hooks, filters) with pure logic, use WP_Mock.

---

## Test File Structure

```
/tests/
  unit/
    php/          # PHPUnit tests (WP_Mock + isolated)
    js/           # Vitest tests
  integration/
    php/          # WordPress-bootstrapped PHPUnit tests
  e2e/
    flows/        # Playwright test files
    fixtures/     # Test data
  snapshots/      # Playwright visual baseline images (committed to Git)
```

---

## E2E Critical Paths (Minimum)

Every project must cover these paths:

- Homepage loads without console errors
- Primary form (contact/signup/checkout) submits successfully
- Login/auth flow (if applicable)
- Admin dashboard loads (if applicable)
- 404 page renders without errors

Each path must include: **status code assertion**, **console error detection**, and **visual stability check**.

See `docs/E2E-TEST-TEMPLATE.md` for the Playwright test template.

---

## AI Agent Rules

- Run the full test suite before proposing any commit: `npm run test` / `composer test`
- Do NOT skip tests because "it's just a small change"
- Do NOT add `'use client'` (Next.js) just to make testing easier
- When tests fail, fix the code — never disable or delete tests without engineer approval
- For E2E tests, run `npx playwright test` locally before asking to merge
