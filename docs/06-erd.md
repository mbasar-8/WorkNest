# Entity Relationship Diagram (ERD)

## Purpose

This document defines the core database entities and their relationships for WorkNest Version 1.

---

# Database Overview

The WorkNest database is organized around workspaces. Every project, board, list, task, and member belongs to a workspace either directly or indirectly.

---

# Entities

## Users

Represents registered users.

### Primary Fields

- id
- name
- email
- password
- email_verified_at
- created_at
- updated_at

---

## Workspaces

Represents collaborative environments.

### Primary Fields

- id
- owner_id
- name
- slug
- description
- created_at
- updated_at

### Relationship

- One User owns many Workspaces.
- One Workspace belongs to one Owner.

---

## Workspace Members

Pivot table connecting users and workspaces.

### Primary Fields

- id
- workspace_id
- user_id
- role
- joined_at

### Relationship

- One Workspace has many Members.
- One User can belong to many Workspaces.

---

## Invitations

Stores pending workspace invitations.

### Primary Fields

- id
- workspace_id
- email
- role
- token
- expires_at
- accepted_at

---

## Projects

Projects inside a workspace.

### Primary Fields

- id
- workspace_id
- name
- description
- archived_at

### Relationship

- One Workspace has many Projects.

---

## Boards

Boards inside a project.

### Primary Fields

- id
- project_id
- name
- archived_at

### Relationship

- One Project has many Boards.

---

## Lists

Columns inside a board.

### Primary Fields

- id
- board_id
- name
- position

### Relationship

- One Board has many Lists.

---

## Tasks

Represents work items.

### Primary Fields

- id
- list_id
- assigned_to
- title
- description
- due_date
- status
- priority
- completed_at
- position

### Relationship

- One List has many Tasks.
- One User may be assigned many Tasks.
- One Task has one Assignee in Version 1.

---

## Comments

Task discussions.

### Primary Fields

- id
- task_id
- user_id
- comment

### Relationship

- One Task has many Comments.
- One User writes many Comments.

---

## Activity Logs

Stores important workspace events.

### Primary Fields

- id
- workspace_id
- user_id
- action
- description
- created_at

### Relationship

- One Workspace has many Activity Logs.
- One User can generate many Activity Logs.

---

# Relationships Summary

```
User
│
├── owns ─────────────► Workspace
│                         │
│                         ├── Workspace Members ◄──── User
│                         │
│                         ├── Invitations
│                         │
│                         ├── Projects
│                         │      │
│                         │      ├── Boards
│                         │      │      │
│                         │      │      ├── Lists
│                         │      │      │      │
│                         │      │      │      └── Tasks
│                         │      │      │              │
│                         │      │      │              └── Comments
│                         │
│                         └── Activity Logs
```

---

# Cardinality

| Relationship | Type |
|-------------|------|
| User → Workspace | One to Many |
| Workspace → Member | One to Many |
| User → Workspace Member | One to Many |
| Workspace → Project | One to Many |
| Project → Board | One to Many |
| Board → List | One to Many |
| List → Task | One to Many |
| User → Task | One to Many (Assignment) |
| Task → Comment | One to Many |
| User → Comment | One to Many |
| Workspace → Activity Log | One to Many |

---

# Foreign Keys

| Table | Foreign Key |
|--------|-------------|
| workspaces | owner_id |
| workspace_members | workspace_id |
| workspace_members | user_id |
| invitations | workspace_id |
| projects | workspace_id |
| boards | project_id |
| lists | board_id |
| tasks | list_id |
| tasks | assigned_to |
| comments | task_id |
| comments | user_id |
| activity_logs | workspace_id |
| activity_logs | user_id |

---

# Soft Deletes

Version 1 will use soft deletes where appropriate for:

- Workspaces
- Projects
- Boards
- Tasks

Other entities may use permanent deletion based on business requirements.

---

# Future Database Extensions

Future versions may introduce additional entities such as:

- File Attachments
- Notifications
- Labels
- Task Checklists
- Time Tracking
- Calendar Events
- AI Suggestions
- Billing
- Teams
- API Tokens
