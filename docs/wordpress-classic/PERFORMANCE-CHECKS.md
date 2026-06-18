# WordPress Performance Checks

## Monthly Checklist

- [ ] Run Lighthouse CI on staging and compare with previous month
- [ ] Check Core Web Vitals in Google Search Console
- [ ] Review image sizes — are new uploads being optimized?
- [ ] Check plugin bloat — any unused plugins that can be removed?
- [ ] Review database size — is `wp_options` autoload excessive?
- [ ] Check CDN cache hit ratio (if Cloudflare or similar)
- [ ] Review slow queries in Query Monitor (if installed)

## Common Performance Issues

| Issue                  | Fix                                                            |
| ---------------------- | -------------------------------------------------------------- |
| Unoptimized images     | Enable compression in theme, use WebP via rewrite rules or CDN |
| Render-blocking CSS/JS | Inline critical CSS, defer non-critical JS                     |
| Database bloat         | Clean transients, revision posts, spam comments                |
| Excessive plugin count | Audit and remove unused plugins — each one adds overhead       |
| Missing CDN            | Configure Cloudflare (or equivalent) — cache static assets     |
| Slow queries           | Add DB indexes, review `wp_options` autoload size              |

## Tooling

- **Development:** Query Monitor plugin (install on staging only, never production directly)
- **CI:** Lighthouse CI enforces Core Web Vitals thresholds
- **Monitoring:** Grafana Cloud for server-level metrics (if configured)

---

## AI Agent Rules

- Never install Query Monitor or similar debugging tools on production
- When fixing performance issues, always test with Lighthouse after changes
- Don't suggest removing plugins without understanding their dependencies first
