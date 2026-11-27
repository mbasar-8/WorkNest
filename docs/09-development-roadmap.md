# Development Roadmap

## Purpose

This roadmap defines the implementation order for WorkNest Version 1. Following this sequence helps build the application incrementally while maintaining a stable and testable codebase.

---

# Phase 1 — Foundation ✅

Completed:

- Project planning
- Documentation
- Git & GitHub setup
- WSL Ubuntu setup
- Docker environment
- FrankenPHP
- PostgreSQL
- Laravel installation
- React (Vite) installation
- Tailwind CSS setup
- Development environment verification

---

# Phase 2 — Backend Foundation

## Authentication

- User registration
- Email verification
- Login
- Logout
- Forgot password
- Reset password
- Authentication middleware
- Sanctum configuration

### Deliverable

A fully functional authentication system.

---

# Phase 3 — Workspace Module

Implement:

- Create workspace
- Update workspace
- Delete workspace
- Workspace switching
- Workspace slug generation

### Deliverable

Workspace management.

---

# Phase 4 — Member Management

Implement:

- Member invitations
- Accept invitation
- Remove member
- Change role
- Workspace member listing

### Deliverable

Complete member management.

---

# Phase 5 — Project Module

Implement:

- CRUD projects
- Archive project
- Restore project

### Deliverable

Project management.

---

# Phase 6 — Board Module

Implement:

- Create board
- Update board
- Archive board
- Restore board

### Deliverable

Board management.

---

# Phase 7 — List Module

Implement:

- Create list
- Update list
- Delete list
- Reorder lists

### Deliverable

List management.

---

# Phase 8 — Task Module

Implement:

- Create task
- Edit task
- Delete task
- Move task
- Assign task
- Due date
- Priority
- Completion status

### Deliverable

Complete task management.

---

# Phase 9 — Comments

Implement:

- Create comment
- Edit own comment
- Delete own comment

### Deliverable

Task discussions.

---

# Phase 10 — Activity Logs

Implement:

- Record important events
- Display activity history

### Deliverable

Workspace activity tracking.

---

# Phase 11 — Dashboard

Implement:

- Workspace summary
- Recent projects
- Assigned tasks
- Upcoming due dates
- Recent activity

### Deliverable

Dashboard.

---

# Phase 12 — Search

Implement search for:

- Projects
- Boards
- Tasks
- Members

### Deliverable

Global search.

---

# Phase 13 — Testing

Perform:

- Manual testing
- API testing
- Validation testing
- Authorization testing
- Edge case testing

### Deliverable

Stable Version 1.

---

# Phase 14 — Production Preparation

Prepare:

- Environment variables
- Production configuration
- Database migration
- Seeders
- Logging
- Error handling

---

# Phase 15 — Deployment

Deploy:

- Backend
- Frontend
- Database

Verify:

- Authentication
- API
- Database
- Production environment

---

# Git Workflow

Each completed feature should follow this workflow:

1. Implement
2. Test
3. Commit
4. Push

Use meaningful commit messages, for example:

```text
feat: implement workspace management

feat: add project CRUD

fix: validate workspace invitation

refactor: extract task service
```

---

# Version Milestones

## v0.1

- Documentation
- Development environment

---

## v0.2

- Authentication

---

## v0.3

- Workspace & Members

---

## v0.4

- Projects & Boards

---

## v0.5

- Lists & Tasks

---

## v0.6

- Comments & Activity Logs

---

## v0.7

- Dashboard & Search

---

## v1.0

- Production-ready Version 1
- Deployment
- Final testing
- Portfolio release
