# Asset Optimization

## Images

- All images must be compressed before deployment
- Use modern formats (WebP, AVIF) with fallbacks
- Lazy-load below-the-fold images
- Set explicit width and height attributes to prevent CLS

## CSS & JS

- Bundle and minify for production
- Eliminate render-blocking resources
- Use code-splitting where applicable (natively supported by Next.js, Nuxt)

## Fonts

- Self-host fonts where possible
- Subset font files to needed character ranges
- Use `font-display: swap` to prevent invisible text during load

## Monitoring

- Lighthouse CI enforces Core Web Vitals thresholds in CI
- Run `npx lhci autorun` locally to check before pushing

---

## AI Agent Rules

- Never commit unminified CSS or JS to production branches
- Never use large (uncompressed) images in commits — use placeholders or compressed versions
- When adding new dependencies, check bundle impact
