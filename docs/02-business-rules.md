# Business Rules

## Purpose

This document defines the business rules that govern how WorkNest behaves. These rules ensure consistency across the application and serve as the foundation for implementation.

---

# User Rules

- A user must register using a unique email address.
- Email verification is required before accessing protected features.
- A user may belong to multiple workspaces.
- A user may create multiple workspaces.
- User profile information can be updated by the owner only.

---

# Workspace Rules

- Every workspace has exactly one owner.
- The workspace owner has full control over the workspace.
- Workspace names do not need to be globally unique.
- Every workspace has a unique slug.
- Workspace logo is not included in Version 1.
- A workspace cannot exist without an owner.
- Only the owner can delete a workspace.
- Deleting a workspace permanently removes all related data.

---

# Membership Rules

- Users can join a workspace only through an invitation.
- Invitations are sent using email.
- A pending invitation can be accepted only once.
- A user cannot join the same workspace more than once.
- Members can leave a workspace.
- The owner cannot leave their own workspace unless ownership is transferred.

---

# Role Rules

## Version 1 Roles

- Owner
- Admin
- Member

Rules:

- Every workspace has exactly one owner.
- The owner has all permissions.
- Admin permissions are limited by the owner.
- Members have standard collaboration permissions.
- Role changes are performed only by the owner.

---

# Project Rules

- A project belongs to one workspace.
- A project cannot exist without a workspace.
- Projects can be archived.
- Archived projects become read-only.
- Only authorized members can access workspace projects.

---

# Board Rules

- A board belongs to one project.
- A project can contain multiple boards.
- Boards can be archived.
- Archived boards cannot be modified.

---

# List Rules

- A board contains multiple lists.
- Lists cannot exist without a board.
- Lists can be reordered.

---

# Task Rules

- Every task belongs to one list.
- A task may be assigned to one member in Version 1.
- Tasks can have a due date.
- Tasks can have a description.
- Tasks can be moved between lists.
- Completed tasks remain in the system.
- Soft delete is preferred where appropriate.

---

# Comment Rules

- Comments belong to a task.
- Only workspace members can comment.
- Comments are ordered chronologically.
- Users can edit or delete only their own comments.

---

# Activity Log Rules

The system records important activities including:

- Workspace creation
- Member invitation
- Member removal
- Project creation
- Board creation
- Task creation
- Task assignment
- Task completion
- Task updates

Activity logs are read-only.

---

# Security Rules

- Authentication is required for protected resources.
- Authorization is enforced on every protected request.
- Passwords are stored using secure hashing.
- Users may access only data belonging to their workspaces.

---

# Version 1 Limitations

The following are intentionally excluded:

- Workspace logo
- Multiple task assignees
- Real-time collaboration
- File attachments
- Calendar
- Notifications
- AI features
- Billing
- Public API
- Mobile application
