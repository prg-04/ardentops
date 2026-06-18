# @ardentops/cli

> Project scaffolding CLI for the **Unified Agency Engineering Framework (UAEF)**.
> Bootstraps new projects and retrofits existing repos with machine-enforced quality
> gates, stack-specific CI, AI agent behavioral contracts, and Doppler secrets management.

---

## What this is

`@ardentops/cli` is a **project compiler and engineering standards installer**.
One command composes a clean project tree from stack-specific templates and applies
a three-tier enforcement stack:

- **Tier 1 — Universal (always on):** Branch protection, Secretlint, Husky, commitlint,
  Doppler environment distribution, AI agent token policy, ADR structure.
- **Tier 2 — Stack adapter:** Stack-specific source scaffolding (WordPress theme files,
  Next.js pages, etc.), Lando config, stack CI jobs, deploy workflows, `.env.example`,
  and AI agent rules scoped to the detected stack.
- **Tier 3 — Generic fallback:** When the stack is unrecognised, Tier 1 still applies
  and an `ADAPTER-NEEDED.md` is created to guide the next step.

Unlike traditional template clones that ship every adapter's artifacts to every project,
the ArdentOps project compiler (`scripts/generate.js`) reads only the requested adapter's
template files — producing ~40 focused files instead of ~145 framework internals.

---

## Install

```bash
npm install -g @ardentops/cli
```

Or run without installing:

```bash
npx @ardentops/cli new-project
```

Or via the curl installer:

```bash
curl -sfL https://ardentops.dev/install.sh | bash -s -- --from-npm
```

---

## Quick start

### New project (creates GitHub repo + bootstraps)

```bash
ardentops new-project
# or skip prompts:
ardentops new-project --name my-app --type nextjs
```

### Retrofit an existing project

```bash
ardentops bootstrap --retrofit /path/to/existing-project
```

### Detect what stack a project is using

```bash
ardentops detect-stack
ardentops detect-stack --retrofit /path/to/project --yes
```

---

## Commands

| Command              | Description                                                                                 |
| -------------------- | ------------------------------------------------------------------------------------------- |
| `new-project`        | Compose a new project from stack adapter templates + UAEF guardrails and create GitHub repo |
| `bootstrap`          | Apply UAEF guardrails to an existing project                                                |
| `detect-stack`       | Detect project stack by scanning adapter signatures                                         |
| `protect`            | Apply GitHub branch protection rules                                                        |
| `stack init`         | Interactive multi-select to create `.project-stack`                                         |
| `stack add <id>`     | Add an adapter to the composition                                                           |
| `stack remove <id>`  | Remove an adapter from the composition                                                      |
| `stack list`         | Show current adapter composition                                                            |
| `stack migrate`      | Convert old `.project-type` to `.project-stack`                                             |
| `service add <name>` | Add a composable service (backend, BaaS, CMS)                                               |
| `service list`       | List available composable services                                                          |
| `list-adapters`      | List all 13 stack adapters with descriptions                                                |
| `self-update`        | Pull latest framework version and re-link CLI                                               |

Run `ardentops <command> --help` for flags.

---

## Stack adapters

17 adapters across four CI categories:

**PHP:** `wordpress-classic` · `wordpress-bedrock` · `wordpress-fse` · `laravel`

**JavaScript (Frontend):** `nextjs` · `nuxtjs` · `sveltekit` · `angular` · `static` · `shopify-liquid` · `shopify-hydrogen`

**JavaScript (Backend):** `nestjs` · `node-api`

**Python:** `python-fastapi`

**Monorepo/Orchestration:** `turborepo` · `aws-lambda`

**Other:** `generic` (Tier 3 fallback — Tier 1 enforcement only)

---

## Prerequisites

| Tool              | Version | Purpose                           |
| ----------------- | ------- | --------------------------------- |
| Node.js           | ≥ 20    | CLI runtime                       |
| Docker Desktop    | Latest  | Lando container host              |
| Lando             | Latest  | Local dev environment             |
| GitHub CLI (`gh`) | Latest  | Repo creation + branch protection |
| Doppler CLI       | Latest  | Secrets distribution              |

---

## Architecture decisions

The framework's design rationale lives in `docs/decisions/`:

- **ADR-001** — UAEF core toolchain adoption
- **ADR-002** — Three-tier adapter architecture
- **ADR-003** — Composable adapter system (`.project-stack`)

---

## License

MIT
