/** @type {import('@lhci/cli/src/types').LighthouseRcConfig} */
module.exports = {
  ci: {
    collect: {
      url: [process.env.STAGING_URL || 'http://localhost:8080'],
      numberOfRuns: 3, // Average 3 runs to reduce variance
      settings: {
        // Simulates mid-tier mobile on 3G — conservative, catches real issues
        preset: 'desktop',
      },
    },
    assert: {
      // Error = blocks CI. Warn = logged but does not block.
      assertions: {
        'categories:performance': ['error', { minScore: 0.8 }],
        'categories:accessibility': ['warn', { minScore: 0.9 }],
        'categories:best-practices': ['warn', { minScore: 0.9 }],
        'categories:seo': ['warn', { minScore: 0.9 }],

        // Core Web Vitals — errors block the release pipeline
        'cumulative-layout-shift': ['error', { maxNumericValue: 0.1 }],
        'largest-contentful-paint': ['error', { maxNumericValue: 2500 }],
        'first-contentful-paint': ['error', { maxNumericValue: 2000 }],
        'total-blocking-time': ['warn', { maxNumericValue: 300 }],
        interactive: ['warn', { maxNumericValue: 5000 }],

        // Resource budgets
        'uses-optimized-images': ['warn'],
        'uses-responsive-images': ['warn'],
        'render-blocking-resources': ['warn'],
      },
    },
    upload: {
      target: 'temporary-public-storage', // Free — links posted to GitHub PR
    },
  },
};
