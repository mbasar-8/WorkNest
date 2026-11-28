# API Specification

## Purpose

This document defines the REST API endpoints for WorkNest Version 1. It serves as the backend API contract between the Laravel backend and the React frontend.

---

# API Standards

## Base URL

```text
/api
```

All endpoints described in this document are relative to the base URL above.

---

## Authentication

Authentication uses Laravel Sanctum with token-based authentication.

Email verification and password reset are implemented using One-Time Password (OTP) delivered via email.

Protected endpoints require a valid authenticated user.

---

## Response Format

All API responses shall use JSON.

### Success Response

```json
{
    "success": true,
    "message": "Operation completed successfully.",
    "data": {}
}
```

### Validation Error

```json
{
    "success": false,
    "message": "Validation failed.",
    "errors": {}
}
```

### Unauthorized Response

```json
{
    "success": false,
    "message": "Unauthorized."
}
```

### Server Error

```json
{
    "success": false,
    "message": "Internal server error."
}
```

---

# Authentication Endpoints

| Method | Endpoint | Description |
|---------|----------|-------------|
| POST | /auth/register | Register a new user |
| POST | /auth/email/verify | Verify email using OTP |
| POST | /auth/email/resend | Resend email verification OTP |
| POST | /auth/login | Authenticate user |
| POST | /auth/logout | Logout the authenticated user |
| GET | /auth/user | Get the authenticated user |
| POST | /auth/forgot-password | Request a password reset OTP |
| POST | /auth/reset-password | Reset password using OTP |

---

# Profile

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /profile | Retrieve the authenticated user's profile |
| PUT | /profile | Update the authenticated user's profile |

---

# Workspaces

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /workspaces | List all accessible workspaces |
| POST | /workspaces | Create a workspace |
| GET | /workspaces/{workspace} | Retrieve a workspace |
| PUT | /workspaces/{workspace} | Update a workspace |
| DELETE | /workspaces/{workspace} | Delete a workspace |

---

# Workspace Members

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /workspaces/{workspace}/members | List workspace members |
| POST | /workspaces/{workspace}/members/invite | Invite a member |
| PATCH | /workspaces/{workspace}/members/{member}/role | Change member role |
| DELETE | /workspaces/{workspace}/members/{member} | Remove a member |

---

# Invitations

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /invitations | List pending invitations |
| POST | /invitations/{token}/accept | Accept an invitation |
| DELETE | /invitations/{token}/decline | Decline an invitation |

---

# Projects

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /projects | List projects |
| POST | /projects | Create a project |
| GET | /projects/{project} | Retrieve a project |
| PUT | /projects/{project} | Update a project |
| DELETE | /projects/{project} | Archive/Delete a project |

---

# Boards

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /boards | List boards |
| POST | /boards | Create a board |
| GET | /boards/{board} | Retrieve a board |
| PUT | /boards/{board} | Update a board |
| DELETE | /boards/{board} | Archive/Delete a board |

---

# Lists

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /lists | List all lists |
| POST | /lists | Create a list |
| PUT | /lists/{list} | Update a list |
| DELETE | /lists/{list} | Delete a list |


# Tasks

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /tasks | List tasks |
| POST | /tasks | Create a task |
| GET | /tasks/{task} | Retrieve a task |
| PUT | /tasks/{task} | Update a task |
| DELETE | /tasks/{task} | Delete a task |
| PATCH | /tasks/{task}/assign | Assign a task to a user |
| PATCH | /tasks/{task}/complete | Mark a task as completed |
| PATCH | /tasks/{task}/move | Move a task to another list or position |

---

# Comments

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /tasks/{task}/comments | List comments for a task |
| POST | /tasks/{task}/comments | Create a comment |
| PUT | /comments/{comment} | Update a comment |
| DELETE | /comments/{comment} | Delete a comment |

---

# Activity Logs

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /activity-logs | Retrieve workspace activity logs |

---

# Dashboard

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /dashboard | Retrieve dashboard summary |

---

# Search

| Method | Endpoint | Description |
|---------|----------|-------------|
| GET | /search | Perform a global search |

Supported query parameters:

- keyword
- workspace
- project
- type

---

# HTTP Status Codes

| Code | Meaning |
|------|---------|
| 200 | OK |
| 201 | Created |
| 204 | No Content |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 409 | Conflict |
| 422 | Validation Error |
| 500 | Internal Server Error |

---

# Authorization

Unless otherwise specified:

- Public endpoints are accessible without authentication.
- Protected endpoints require a valid Sanctum authentication token.
- Email verification is required before accessing protected application features.
- Authorization is enforced through Laravel Policies and middleware.
- Workspace resources are accessible only to authorized workspace members based on their assigned role.

---

# API Design Principles

The WorkNest API follows these principles:

- RESTful endpoint design
- Resource-oriented architecture
- Consistent JSON response structure
- Stateless communication
- Token-based authentication with Laravel Sanctum
- Request validation using Form Requests
- Authorization using Policies
- Proper HTTP status codes
- Consistent error handling

---

# Versioning

Version 1 APIs are available under the current API structure:

```text
/api
```

Future releases may introduce explicit endpoint versioning such as:

```text
/api/v2
```

to preserve backward compatibility while allowing new functionality to evolve independently.

---

# Notes

- All timestamps use UTC and ISO 8601 format.
- All request and response bodies use JSON.
- API documentation reflects the functionality planned for **WorkNest Version 1**.
- Future versions may introduce additional endpoints for notifications, file attachments, calendar, AI features, billing, and public APIs without breaking the Version 1 contract.
