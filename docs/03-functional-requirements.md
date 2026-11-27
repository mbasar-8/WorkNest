# Functional Requirements

## Purpose

This document defines the functional requirements for WorkNest Version 1. It describes what the system must do from the user's perspective.

---

# 1. Authentication Module

The system shall allow users to:

- Register with name, email, and password.
- Verify email using a verification link or code.
- Log in using verified credentials.
- Log out securely.
- Request password reset.
- Reset password using a secure token.
- Change password after authentication.

---

# 2. User Profile Module

The system shall allow users to:

- View their profile.
- Update profile information.
- Change password.
- View joined workspaces.

---

# 3. Workspace Module

The system shall allow users to:

- Create a workspace.
- Update workspace information.
- View workspace details.
- Switch between workspaces.
- Delete a workspace (Owner only).

---

# 4. Member Management Module

The system shall allow workspace owners or authorized admins to:

- Invite members by email.
- View workspace members.
- Remove members.
- Change member roles.
- Resend pending invitations.

---

# 5. Role & Permission Module

The system shall:

- Support Owner, Admin, and Member roles.
- Restrict actions based on permissions.
- Prevent unauthorized access.

---

# 6. Project Module

The system shall allow users to:

- Create projects.
- Update project information.
- Archive projects.
- Restore archived projects.
- View project details.

---

# 7. Board Module

The system shall allow users to:

- Create boards.
- Rename boards.
- Archive boards.
- Restore boards.

---

# 8. List Module

The system shall allow users to:

- Create lists.
- Rename lists.
- Delete lists.
- Reorder lists.

---

# 9. Task Module

The system shall allow users to:

- Create tasks.
- Edit tasks.
- Delete tasks.
- Assign tasks.
- Move tasks between lists.
- Add task descriptions.
- Set due dates.
- Mark tasks as completed.
- Reopen completed tasks.

---

# 10. Comment Module

The system shall allow users to:

- Add comments.
- Edit their own comments.
- Delete their own comments.
- View task discussions.

---

# 11. Activity Log Module

The system shall:

- Record important workspace activities.
- Display activity history in chronological order.

---

# 12. Search Module

The system shall allow users to search:

- Projects
- Boards
- Lists
- Tasks
- Members

---

# 13. Dashboard Module

The dashboard shall display:

- User workspaces
- Recent projects
- Assigned tasks
- Upcoming due dates
- Recent activities

---

# 14. API Requirements

The backend shall provide:

- RESTful APIs
- JSON responses
- Standard HTTP status codes
- Validation error responses
- Authentication using Laravel Sanctum

---

# 15. General Functional Requirements

The system shall:

- Validate user input.
- Prevent unauthorized access.
- Handle exceptions gracefully.
- Support pagination where necessary.
- Log important system events.
- Maintain data integrity.
- Use soft deletes where applicable.
- Return consistent API response structures.
