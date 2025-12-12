# TaskLaravel

# ODO / Task Management System

## Project Overview

This project is a **Task Management System** built with **Laravel 11** for the backend and **React** for the frontend.  
It includes user authentication, task CRUD operations, task filtering and pagination, status updates, and statistical information. Users can only view and manage their own tasks.

---

## Features

-   User authentication with **Token-based auth (Sanctum)**
-   **Login page** (no registration implemented)
-   View and manage only own tasks
-   **CRUD operations** for tasks
-   **Filter tasks by status** (Pending / In Progress / Done / All)
-   **Pagination** for task lists
-   **Update task status** (pending / in_progress / done)
-   **Show statistics** (total, pending, in_progress, done)
-   Protected routes for authenticated users
-   Error handling for both API and frontend
-   Clean, well-structured backend and frontend code
-   API documentation available via **Postman Collection**

---

## Architecture

### Backend (Laravel)

-   **Routes:** `routes/api.php`
-   **Controllers:** Handle API requests, validation, and responses
-   **Service Layer:** Business logic separated into services (`TaskService`)
-   **Requests:** FormRequest classes for validation
-   **Resources / Resource Collections:** For consistent JSON responses
-   **Database:** Migrations and Seeders for tables and sample data
-   **Models:** `User` and `Task` with one-to-many relationship
-   **Authentication:** Sanctum for token-based auth
-   **Separation of Concerns:** Controllers orchestrate requests, Services handle business logic, Resources handle output

---

## Database & Models

-   **Users Table**
    -   `id`, `name`, `email`, `password`
-   **Tasks Table**
    -   `id`, `title`, `description`, `status` (`pending`, `in_progress`, `done`), `user_id`
-   **Relationship:** One User → Many Tasks
-   Seeders generate sample users and tasks

## Authentication

-   Token-based authentication using **Laravel Sanctum**
-   Users log in and receive a token
-   Frontend stores token in Cookies / LocalStorage
-   Protected routes ensure users can only view and modify their own tasks
-   Logout revokes the current access token

---

## Setup Instructions

### Backend

1. composer install
2. php artisan serve
3. php artisan migrate --seed
4. php artisan key:generate


