# Entity Relationship Diagram (ERD)

## Purpose

This document defines the core database entities and their relationships for WorkNest Version 1.

---

# Database Overview

The WorkNest database is organized around workspaces. Every project, board, list, task, and member belongs to a workspace either directly or indirectly.

The application separates authentication data from user profile information to maintain a clean and scalable architecture.

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

### Relationship

- One User has one Profile.
- One User owns many Workspaces.
- One User can belong to many Workspaces.
- One User may be assigned many Tasks.
- One User can write many Comments.
- One User can generate many Activity Logs.

---

## Profiles

Stores additional user profile information.

### Primary Fields

- id
- user_id
- avatar
- phone
- bio
- timezone
- created_at
- updated_at

### Relationship

- One Profile belongs to one User.
- One User has one Profile.

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
- One Workspace has many Members.
- One Workspace has many Invitations.
- One Workspace has many Projects.
- One Workspace has many Activity Logs.

---

## Workspace Members

Pivot table connecting users and workspaces.

### Primary Fields

- id
- workspace_id
- user_id
- role
- joined_at
- created_at
- updated_at

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
- created_at
- updated_at

### Relationship

- One Workspace has many Invitations.

---

## Projects

Projects inside a workspace.

### Primary Fields

- id
- workspace_id
- name
- description
- archived_at
- created_at
- updated_at

### Relationship

- One Workspace has many Projects.
- One Project has many Boards.

---

## Boards

Boards inside a project.

### Primary Fields

- id
- project_id
- name
- archived_at
- created_at
- updated_at

### Relationship

- One Project has many Boards.
- One Board has many Lists.

---

## Lists

Columns inside a board.

### Primary Fields

- id
- board_id
- name
- position
- created_at
- updated_at

### Relationship

- One Board has many Lists.
- One List has many Tasks.

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
- created_at
- updated_at

### Relationship

- One List has many Tasks.
- One User may be assigned many Tasks.
- One Task has one Assignee in Version 1.
- One Task has many Comments.

---

## Comments

Task discussions.

### Primary Fields

- id
- task_id
- user_id
- comment
- created_at
- updated_at

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
- updated_at

### Relationship

- One Workspace has many Activity Logs.
- One User can generate many Activity Logs.

---

# Relationships Summary

```text
User
│
├── has one ───────────► Profile
│
├── owns ──────────────► Workspace
│                          │
│                          ├── Workspace Members ◄──── User
│                          │
│                          ├── Invitations
│                          │
│                          ├── Projects
│                          │      │
│                          │      ├── Boards
│                          │      │      │
│                          │      │      ├── Lists
│                          │      │      │      │
│                          │      │      │      └── Tasks
│                          │      │      │              │
│                          │      │      │              └── Comments
│                          │
│                          └── Activity Logs
```


# Cardinality

| Relationship | Type |
|-------------|------|
| User → Profile | One to One |
| User → Workspace | One to Many |
| Workspace → Member | One to Many |
| User → Workspace Member | One to Many |
| Workspace → Invitation | One to Many |
| Workspace → Project | One to Many |
| Project → Board | One to Many |
| Board → List | One to Many |
| List → Task | One to Many |
| User → Task | One to Many (Assignment) |
| Task → Comment | One to Many |
| User → Comment | One to Many |
| Workspace → Activity Log | One to Many |
| User → Activity Log | One to Many |

---

# Foreign Keys

| Table | Foreign Key |
|--------|-------------|
| profiles | user_id |
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

Version 1 uses soft deletes for entities where data recovery is beneficial.

The following tables use soft deletes:

- Workspaces
- Projects
- Boards
- Tasks

The following tables use permanent deletion:

- Profiles
- Workspace Members
- Invitations
- Lists
- Comments

Activity Logs are retained as historical records and are not intended to be deleted during normal application usage.

---

# Database Design Principles

The database design follows these principles:

- Authentication data is separated from profile data.
- Every workspace has exactly one owner.
- Users may belong to multiple workspaces.
- Authorization is workspace-based.
- Projects exist within a workspace.
- Boards belong to projects.
- Lists belong to boards.
- Tasks belong to lists.
- Each task has a single assignee in Version 1.
- Comments belong to tasks.
- Activity logs record important workspace events.
- Foreign key relationships enforce data integrity.
- Soft deletes are applied only where recovery is meaningful.

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

These additions are intentionally excluded from Version 1 but can be integrated without major architectural changes due to the modular database design.

---

# Version Notes

This ERD represents the database structure for **WorkNest Version 1**.

It is intended to remain stable throughout Version 1 development. Future versions should extend the schema without introducing breaking changes whenever possible.
