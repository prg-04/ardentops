# AGENT RULES — ArdentOps

## Identity

You are an AI coding assistant working on **ArdentOps**, a **WordPress — Classic (Shared Hosting / cPanel)** project.
Your behavior is governed by the rules in this file — read them before making any changes.

## Universal Rules

These rules apply regardless of stack. They cannot be overridden.

### Hard Permissions

- You MAY read any file in this repository.
- You MAY create branches named `feature/*` or `fix/*`.
- You MAY open Pull Requests targeting `develop` only.
- You MUST NOT push directly to `main` or `develop`.
- You MUST NOT modify `.github/workflows/`, `CODEOWNERS`, `package.json`,
  or similar core config files without explicit engineer instruction.
- You MUST NOT read, log, output, or reference any value from `.env` files.
- You MUST NOT install dependencies without explicit engineer approval.

### Critical Security Rules

- **Secrets never touch the repo.** All secrets are managed via Doppler.
- Validate all user input before processing (Zod for JS/TS, Pydantic for Python, etc.).
- Never output environment variable values, API keys, tokens, or credentials.
- Never expose database connection strings or internal service URLs to clients.
- CSRF protection must be enabled on all state-changing endpoints.

### Before You Start

1. Read `CLAUDE.md` — the project navigation guide.
2. Read `AGENT-RULES.md` (this file) — the behavioral contract.
3. Read `.project-stack` — confirms which adapters are active.
4. Read `README.md` — project setup and conventions.
5. List `docs/decisions/` — read any ADR relevant to your task.
6. Read the specific file you intend to modify before changing it.


────────────────────────────────────────────────────────────

## Stack: WordPress — Classic (Shared Hosting / cPanel)

# Agent Operating Rules — WordPress Classic (ArdentOps)

## Identity

You are an AI coding assistant in an ArdentOps WordPress Classic project.
This project uses the traditional WordPress file layout (no Bedrock).

## Hard Permissions

- You MAY read any file in this repository.
- You MAY create branches named `feature/*` or `fix/*`.
- You MAY open Pull Requests targeting `develop` only.
- You MUST NOT push directly to `main` or `develop`.
- You MUST NOT modify `.github/workflows/`, `CODEOWNERS`, `composer.json`,
  or `package.json` without explicit engineer instruction.
- You MUST NOT read, log, output, or reference any value from `.env` files.
- You MUST NOT install packages without explicit engineer approval.
- You MUST NOT write raw SQL with user-supplied input.
  Always use `$wpdb->prepare()` or the provided ORM layer.

## Code Standards

- PHP must comply with WordPress Coding Standards (WPCS).
  Validate: `./vendor/bin/phpcs --standard=WordPress --extensions=php wp-content/`
- All HTML output must be escaped: `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()`.
- All forms and AJAX handlers must implement WordPress nonce verification.

## Architecture Boundaries

- WordPress core: `/wp/` — NEVER modify files here.
- Theme code: `/wp-content/themes/{project-theme}/`
- Plugin code: `/wp-content/plugins/{project-core}/` — not in the theme.
- Shared PHP utilities: `/src/` — never duplicate helpers between plugin and theme.

## Testing

- Every new PHP function requires a PHPUnit test in `/tests/unit/php/`.
- Every new critical user path requires a Playwright test in `/tests/e2e/flows/`.
- Run before committing: `composer test`

---

## Framework Documentation

Consult these docs for framework operational knowledge:

- `docs/BOOTSTRAP-SEQUENCE.md` — how projects are structured and set up
- `docs/BRANCH-PROTECTION-SETUP.md` — branch strategy and protection rules
- `docs/TESTING-STANDARDS.md` — coverage targets and test types
- `docs/DOPPLER-SETUP-GUIDE.md` — secrets management workflow
- `_adapters/wordpress-classic/docs/BACKUP-POLICY.md` — backup schedule and restore
- `_adapters/wordpress-classic/docs/PERFORMANCE-CHECKS.md` — monthly performance checklist
- `docs/decisions/` — Architecture Decision Records (why things are done)

---

## Security

- All database queries with user input MUST use `$wpdb->prepare()`.
  Raw `$wpdb->query()` or `$wpdb->get_results()` with user-supplied values
  is a SQL injection vulnerability — no exceptions.
- All output to HTML must be escaped using the correct function for context:
  `esc_html()` for text, `esc_attr()` for attribute values,
  `esc_url()` for URLs, `wp_kses_post()` for rich HTML.
  Unescaped `echo` of dynamic content is an XSS vulnerability.
- All form submissions and AJAX handlers must verify a WordPress nonce
  before processing any input.
- Never store sensitive data in WordPress options (`update_option()`) without
  encryption. Use Doppler and read secrets from environment variables.
- File uploads in custom code must validate MIME type server-side using
  `wp_check_filetype_and_ext()` — never trust `$_FILES['type']`.
- REST API endpoints registered with `register_rest_route()` must set an
  explicit `permission_callback` — never use `__return_true` in production.

---

## Context seeding — read these before starting any task

Before writing or modifying any file, read the following in order:

1. `README.md` — project-specific setup and conventions
2. `.project-stack` — which adapters are active (may be a composition)
3. `docs/decisions/` — list the files; read any ADR whose title
   suggests it covers the area you are about to change
4. The specific file you are about to modify — read its current content.
   Do not assume you know what it contains from a prior turn.

If any of these files do not exist, note it and continue.
Do not create them unless explicitly instructed.

---

## Self-check protocol — run before every write action

Before writing to any file, answer these four questions internally.
If any answer is "no" or "unsure", resolve it before proceeding.
Do not assume. Do not guess. Do not proceed on uncertainty.

1. Does this file path already exist in the repository?
   If unsure → use a read tool to verify before writing.

2. Is every import, require(), or use statement I am about to write
   listed in package.json / composer.json / requirements.txt?
   If unsure → read the dependency file first.

3. Is the method, function, or API endpoint I am calling defined
   with the exact signature I am assuming?
   If unsure → read the file that defines it.

4. Will this change touch a file in the prohibited list?
   (.env*, *.pem, .github/workflows/_, _.lock, and any config files
   listed in Hard Permissions above)
   If yes → stop. See "When to stop and ask" below.

---

## Hallucination prevention

These rules exist because AI models generate plausible-looking code
that references things which do not exist in the actual project.
You must apply active verification, not passive recall.

- NEVER assert that a function, class, method, or API endpoint exists
  unless you have read the file that defines it during this session.
- NEVER import a package that you have not confirmed is listed in the
  project's dependency file.
- NEVER reference a database table, column, or field name unless you
  have read the schema, migration file, or model that defines it.
- NEVER reference an environment variable name unless you have read
  `.env.example` or the Doppler config to confirm it exists.
- NEVER invent configuration keys, CLI flags, or framework APIs.
  If you are uncertain whether an API exists, read the docs or
  the installed package source — do not guess.

If you are about to write something and realise you have not verified
its existence — stop, read the relevant file, then continue.

---

## When to stop and ask

Stop what you are doing and surface a question to the engineer when
any of the following conditions are true:

- The task requires modifying a file in the prohibited list
- The task requires installing a new package or dependency
- The task requires changing more than 3 files simultaneously
- The task touches CI workflows, Lando config, or Doppler configuration
- The task is architecturally ambiguous and you can see two or more
  valid approaches where the choice has downstream consequences
- A rule in this file conflicts with what the task requires —
  do not silently pick a side or work around the rule

When stopping, state exactly:

1. What you were about to do
2. Which rule or ambiguity caused you to stop
3. What you need clarified to proceed

Do not proceed by choosing the path of least resistance.
Surfacing conflicts is the correct and expected behavior.

---

## Commit message format

All commits must follow Conventional Commits.
Commitlint is enforced by Husky and will reject non-conforming messages.

Pattern:
<type>(<scope>): <description>

[optional body]

[optional footer]

Valid types:
feat A new feature
fix A bug fix
docs Documentation changes only
style Formatting, missing semicolons — no logic change
refactor Code restructuring with no feature or bug change
perf Performance improvement
test Adding or updating tests
chore Build process, tooling, dependencies
ci CI configuration changes
revert Reverting a previous commit

Rules:

- Scope is the affected module, file group, or feature area.
  Use lowercase, no spaces (e.g. auth, cart, api, db, header).
- Description is sentence case, present tense, no trailing period,
  under 72 characters.
- Body lines are wrapped at 72 characters.

Valid examples:
feat(auth): add JWT refresh token endpoint
fix(cart): correct total calculation on quantity update
docs(readme): update local dev setup instructions
refactor(services): extract user validation to shared helper
chore(deps): upgrade vitest to 2.1.0

Invalid — will be rejected by commitlint:
Fixed stuff ← no type prefix
feat: Fixed the bug ← past tense in description
feat(Auth Module): ... ← scope not lowercase
feat(auth): Add JWT... ← description starts capitalised

---

## PR description format

Every Pull Request opened by this agent must use this template.
Do not open a PR without all sections filled in.

## What this does

[1–3 sentences describing the change. Be specific about what changed,
not about why or how to verify it.]

## Why

[Link to the GitHub issue, Jira ticket, or Linear task. If none exists,
one sentence of rationale.]

## How to test

[Numbered steps a reviewer can follow to verify this change works.
Include the URL, the expected input, and the expected output.]

## Checklist

- [ ] Tests added or updated
- [ ] `npm run test` (or `composer test`) passes locally
- [ ] No new lint errors (`npm run lint:js`)
- [ ] No `.env` values hardcoded in source files
- [ ] ADR filed if this introduces an architectural decision
- [ ] `docs/` updated if this changes user-facing behavior

