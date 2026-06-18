# Handoff Checklist — Project Completion

## Credentials Transfer

- [ ] All passwords rotated to client-controlled values
- [ ] Agency/project team SSH keys removed from production server
- [ ] Doppler project ownership transferred to client (or secrets exported)
- [ ] GitHub repository access revoked for temporary contributors
- [ ] All third-party API tokens created during development rotated

## Documentation Delivered

- [ ] README with environment setup instructions
- [ ] `docs/ENVIRONMENTS.md` with all URLs and service accounts
- [ ] Backup restore procedure (if applicable)
- [ ] Incident response contact for hosting provider
- [ ] All ADRs finalized and reviewed

## Knowledge Transfer

- [ ] Walkthrough of admin panel / key features (recorded)
- [ ] ADRs reviewed with client technical lead
- [ ] Known issues / technical debt documented in project tracker

## Infrastructure

- [ ] .deployignore committed and verified (no framework files on production)
- [ ] Deploy workflow tested end-to-end (VPS or Vercel/Cloudflare)
- [ ] Backup schedule confirmed operational
- [ ] Monitoring alerts configured with correct contacts

## AI Agent Notes

- During handoff, agents should NOT modify credentials, hosting configs, or access controls
- Agents CAN help generate documentation (ADRs, README sections, ENVIRONMENTS updates)
- Never include real secrets, passwords, or tokens in handoff documentation
