# Architecture

## Purpose

This document defines the overall software architecture, project structure, and development conventions for WorkNest Version 1.

---

# High-Level Architecture

WorkNest follows a client-server architecture.

```text
+----------------------+
|    React Frontend    |
|  (Vite + Tailwind)   |
+----------+-----------+
           |
           | REST API (JSON)
           |
+----------v-----------+
|   Laravel Backend    |
|   Business Logic     |
|   Authentication     |
|   Validation         |
+----------+-----------+
           |
           |
+----------v-----------+
|     PostgreSQL       |
|      Database        |
+----------------------+
```

---

# Technology Stack

## Frontend

- React
- Vite
- React Router
- Axios
- Tailwind CSS

---

## Backend

- Laravel
- PHP
- Laravel Sanctum
- REST API

---

## Database

- PostgreSQL

---

## Development

- Docker
- FrankenPHP
- WSL Ubuntu
- Git
- GitHub

---

# Project Structure

```text
WorkNest/
│
├── client/
│   ├── public/
│   ├── src/
│   │
│   ├── api/
│   ├── assets/
│   ├── components/
│   ├── contexts/
│   ├── hooks/
│   ├── layouts/
│   ├── pages/
│   ├── router/
│   ├── services/
│   ├── utils/
│   ├── App.jsx
│   └── main.jsx
│
├── server/
│
├── docker/
│
├── docs/
│
└── README.md
```

---

# Backend Architecture

Laravel will follow its standard structure with clear separation of responsibilities.

### Controllers

- Receive HTTP requests.
- Return API responses.
- Keep controllers lightweight.

---

### Form Requests

Responsible for:

- Validation
- Authorization

---

### Models

Responsible for:

- Database relationships
- Scopes
- Model behavior

---

### Policies

Responsible for:

- Authorization
- Permission checking

---

### Resources

Responsible for:

- API response transformation
- Consistent JSON structure

---

### Services

Responsible for:

- Business logic
- Reusable application workflows

---

# Frontend Architecture

The React application will follow a feature-oriented component structure.

### Pages

Represent complete screens.

Examples:

- Login
- Register
- Dashboard
- Workspace
- Project

---

### Components

Reusable UI components.

Examples:

- Button
- Modal
- Sidebar
- Navbar
- Card
- Input

---

### Layouts

Shared page layouts.

Examples:

- Auth Layout
- Dashboard Layout

---

### Contexts

Global application state.

Examples:

- Authentication
- Workspace
- Theme (future)

---

### Services

Responsible for API communication.

Examples:

- authService
- workspaceService
- projectService

---

### API

Contains:

- Axios instance
- Request interceptors
- Response interceptors

---

# API Architecture

Communication between frontend and backend uses:

- REST API
- JSON
- HTTPS (production)
- Laravel Sanctum authentication

---

# Authentication Flow

```text
User
   │
   ▼
React Login Page
   │
   ▼
Laravel API
   │
   ▼
Sanctum Authentication
   │
   ▼
Authenticated User
```

---

# Database Layer

Laravel Eloquent ORM manages:

- Relationships
- Queries
- Data integrity

Business logic should not be written directly in migrations or controllers.

---

# Development Principles

- Single Responsibility Principle (SRP)
- DRY (Don't Repeat Yourself)
- KISS (Keep It Simple)
- RESTful API Design
- Clean Code
- Modular Development

---

# Error Handling

The application should:

- Return consistent JSON error responses.
- Log unexpected exceptions.
- Display user-friendly frontend messages.

---

# Security

The architecture includes:

- Authentication
- Authorization
- Request Validation
- CSRF Protection (where applicable)
- Password Hashing
- Route Protection

---

# Scalability

The architecture is designed to support future additions including:

- Notifications
- File Storage
- Real-time Collaboration
- AI Features
- Mobile Applications
- Public API
- Billing

without requiring major architectural changes.
