# API Specification

## Purpose

This document defines the REST API endpoints for WorkNest Version 1. It serves as the backend API contract between the Laravel server and the React frontend.

---

# API Standards

## Base URL

```text
/api
```

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

### Server Error

```json
{
  "success": false,
  "message": "Internal server error."
}
```

---

# Authentication

Authentication uses Laravel Sanctum.

---

## Authentication Endpoints

| Method | Endpoint | Description |
|---------|----------|-------------|
| POST | /register | Register a new user |
| POST | /login | Authenticate user |
| POST | /logout | Logout current user |
| GET | /user | Get authenticated user |
| POST | /forgot-password | Request password reset |
| POST | /reset-password | Reset password |
| POST | /email/verify | Verify email |
| POST | /email/resend | Resend verification email |

---

# Profile

| Method | Endpoint |
|---------|----------|
| GET | /profile |
| PUT | /profile |

---

# Workspaces

| Method | Endpoint |
|---------|----------|
| GET | /workspaces |
| POST | /workspaces |
| GET | /workspaces/{workspace} |
| PUT | /workspaces/{workspace} |
| DELETE | /workspaces/{workspace} |

---

# Workspace Members

| Method | Endpoint |
|---------|----------|
| GET | /workspaces/{workspace}/members |
| POST | /workspaces/{workspace}/members/invite |
| PATCH | /workspaces/{workspace}/members/{member}/role |
| DELETE | /workspaces/{workspace}/members/{member} |

---

# Invitations

| Method | Endpoint |
|---------|----------|
| GET | /invitations |
| POST | /invitations/{token}/accept |
| DELETE | /invitations/{token}/decline |

---

# Projects

| Method | Endpoint |
|---------|----------|
| GET | /projects |
| POST | /projects |
| GET | /projects/{project} |
| PUT | /projects/{project} |
| DELETE | /projects/{project} |

---

# Boards

| Method | Endpoint |
|---------|----------|
| GET | /boards |
| POST | /boards |
| GET | /boards/{board} |
| PUT | /boards/{board} |
| DELETE | /boards/{board} |

---

# Lists

| Method | Endpoint |
|---------|----------|
| GET | /lists |
| POST | /lists |
| PUT | /lists/{list} |
| DELETE | /lists/{list} |

---

# Tasks

| Method | Endpoint |
|---------|----------|
| GET | /tasks |
| POST | /tasks |
| GET | /tasks/{task} |
| PUT | /tasks/{task} |
| DELETE | /tasks/{task} |
| PATCH | /tasks/{task}/assign |
| PATCH | /tasks/{task}/complete |
| PATCH | /tasks/{task}/move |

---

# Comments

| Method | Endpoint |
|---------|----------|
| GET | /tasks/{task}/comments |
| POST | /tasks/{task}/comments |
| PUT | /comments/{comment} |
| DELETE | /comments/{comment} |

---

# Activity Logs

| Method | Endpoint |
|---------|----------|
| GET | /activity-logs |

---

# Dashboard

| Method | Endpoint |
|---------|----------|
| GET | /dashboard |

---

# Search

| Method | Endpoint |
|---------|----------|
| GET | /search |

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

# Versioning

Version 1 APIs will be maintained under the current API structure.

Future releases may introduce endpoint versioning such as:

```text
/api/v2
```

to preserve backward compatibility.
