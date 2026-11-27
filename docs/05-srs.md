# Software Requirements Specification (SRS)

## Project

**WorkNest**

Version: 1.0

---

# 1. Introduction

## 1.1 Purpose

This document defines the complete software requirements for WorkNest Version 1. It serves as the primary reference for design, development, testing, deployment, and future maintenance.

---

## 1.2 Project Overview

WorkNest is a modern SaaS project management platform that enables teams to organize work, collaborate efficiently, and manage projects through workspaces, boards, lists, and tasks.

The application follows a RESTful architecture with a Laravel backend and a React frontend.

---

## 1.3 Intended Audience

- Software Developers
- Project Maintainers
- Test Engineers
- Future Contributors
- Recruiters reviewing the project portfolio

---

# 2. Project Scope

Version 1 includes:

- User Authentication
- Email Verification
- User Profile
- Workspace Management
- Member Management
- Role Management
- Project Management
- Board Management
- List Management
- Task Management
- Task Assignment
- Comments
- Activity Logs
- Search
- Dashboard

Future releases may introduce:

- Notifications
- Calendar
- File Attachments
- AI Features
- Time Tracking
- Billing
- Public API
- Mobile Applications

---

# 3. Product Perspective

WorkNest is developed as a standalone SaaS application using a modular architecture.

Major layers include:

- React Frontend
- Laravel REST API
- PostgreSQL Database
- Docker-based Development Environment

---

# 4. User Roles

## Owner

Has full control over the workspace.

Responsibilities include:

- Workspace management
- Member management
- Role management
- Workspace deletion

---

## Admin

Can manage workspace resources according to assigned permissions.

---

## Member

Can participate in projects and perform daily collaboration activities.

---

# 5. Functional Requirements

The system shall provide:

## Authentication

- User Registration
- Email Verification
- Login
- Logout
- Password Reset

---

## Workspace

- Create Workspace
- Update Workspace
- Delete Workspace
- Switch Workspace

---

## Members

- Invite Members
- Accept Invitations
- Remove Members
- Change Roles

---

## Projects

- Create Projects
- Update Projects
- Archive Projects

---

## Boards

- Create Boards
- Update Boards
- Archive Boards

---

## Lists

- Create Lists
- Update Lists
- Delete Lists
- Reorder Lists

---

## Tasks

- Create Tasks
- Update Tasks
- Delete Tasks
- Assign Tasks
- Due Dates
- Task Completion

---

## Comments

- Add Comments
- Edit Own Comments
- Delete Own Comments

---

## Activity Logs

Record important user and workspace activities.

---

# 6. Business Rules

The application shall enforce:

- One owner per workspace.
- Unique email addresses.
- Email verification before accessing protected resources.
- Role-based authorization.
- One workspace owner at any given time.
- One task assignee in Version 1.
- Workspace deletion by owner only.
- Invitation-based workspace membership.

---

# 7. Non-Functional Requirements

The application shall emphasize:

- Performance
- Security
- Scalability
- Reliability
- Maintainability
- Responsive Design
- Modular Architecture
- Clean Code
- Docker-based Deployment

---

# 8. Technology Stack

## Backend

- Laravel
- PHP
- PostgreSQL
- REST API
- Sanctum
- FrankenPHP

## Frontend

- React
- Vite
- React Router
- Axios
- Tailwind CSS

## Development

- Docker
- Docker Compose
- Git
- GitHub
- WSL Ubuntu

---

# 9. Assumptions

- Users have internet access.
- Email delivery service is available.
- PostgreSQL is operational.
- Docker is available in the development environment.

---

# 10. Constraints

Version 1 intentionally excludes:

- File Uploads
- Real-Time Collaboration
- AI Features
- Notifications
- Calendar
- Billing
- Public API
- Mobile Applications

---

# 11. Success Criteria

Version 1 is considered complete when users can:

- Register and verify accounts.
- Create and manage workspaces.
- Invite and manage members.
- Create projects.
- Organize work using boards and lists.
- Manage tasks.
- Track project activities.
- Use the application successfully across supported devices.

---

# 12. Document References

Supporting project documentation:

- 01-project-vision.md
- 02-business-rules.md
- 03-functional-requirements.md
- 04-non-functional-requirements.md
- 06-erd.md
- 07-api-specification.md
- 08-architecture.md
- 09-development-roadmap.md
- 10-deployment.md
