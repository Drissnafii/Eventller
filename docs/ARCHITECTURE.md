# Project Structure & Repository Design Pattern Overview

## Introduction

**Eventller** is an advanced event management platform inspired by solutions like Eventbrite. Our project is built using a PHP MVC architecture with PostgreSQL as the database and AJAX for dynamic interactions. In our codebase, we adhere to best practices by using a repository design pattern. This Wiki page explains both our overall folder structure and the repository pattern we follow, so that all team members can easily understand and maintain the project.

## Project Context

The platform is designed to:
- Allow organizers to create and manage events.
- Enable participants to book tickets online.
- Provide administrators with back-office tools for user and event management.
- Deliver real-time analytics and dynamic interactions via AJAX.

Our system follows modern PHP best practices (such as using a strict separation of concerns and version-controlled documentation) and leverages well-established design patterns to ensure scalability and testability.

## Repository Design Pattern Explained

The repository design pattern acts as a data-access layer that abstracts the logic for retrieving and persisting domain objects. Instead of writing SQL queries directly in controllers or services, repository classes provide a clean, object-oriented interface to your data. In our project:

- **Decoupling:** Business logic remains independent of the underlying data source. Should we change from PostgreSQL to another storage system or caching mechanism, only the repository implementations would need updating.
- **Testability:** By programming to interfaces (and injecting repository objects via dependency injection), we can easily swap out real repositories with mocks or in-memory versions during testing.
- **Maintainability:** All data-access logic is centralized in the repository layer. This reduces code duplication and simplifies modifications when business requirements evolve.

## Folder Structure

Our codebase is organized to support modularity and clear separation of concerns. Below is the directory layout for **Eventller**:

```plaintext
eventller/
│
├── config/               # Application configuration files (database, routes, app settings)
│   ├── database.php
│   ├── app.php
│   └── routes.php
│
├── public/               # Public-facing files; entry point and assets
│   ├── index.php
│   └── assets/
│       ├── css/
│       ├── js/
│       └── images/
│
├── src/                  # Core source code
│   ├── Core/             # Fundamental framework components (Database connection, Router, Base Controller)
│   │   ├── Database.php
│   │   ├── Router.php
│   │   └── Controller.php
│   │
│   ├── Models/           # Domain models representing entities (User, Event, Ticket, Payment)
│   │   ├── User.php
│   │   ├── Event.php
│   │   ├── Ticket.php
│   │   └── Payment.php
│   │
│   ├── Repositories/     # Repository interfaces and implementations (data access abstraction)
│   │   ├── Interfaces/
│   │   │   ├── UserRepositoryInterface.php
│   │   │   ├── EventRepositoryInterface.php
│   │   │   ├── TicketRepositoryInterface.php
│   │   │   └── PaymentRepositoryInterface.php
│   │   │
│   │   ├── UserRepository.php
│   │   ├── EventRepository.php
│   │   ├── TicketRepository.php
│   │   └── PaymentRepository.php
│   │
│   ├── Controllers/      # Controllers managing HTTP requests and responses
│   │   ├── UserController.php
│   │   ├── EventController.php
│   │   ├── TicketController.php
│   │   └── PaymentController.php
│
├── templates/            # Frontend templates (using Twig) for rendering views
│   ├── layouts/
│   │   ├── base.twig
│   │   └── admin.twig
│   └── pages/
│       ├── home.twig
│       ├── events/
│       ├── users/
│       └── tickets/
│
├── tests/                # Automated tests (Unit, Integration, Functional)
│   ├── Unit/
│   ├── Integration/
│   └── Functional/
│
├── logs/                 # Log files for error tracking and debugging
│
├── migrations/           # Database migration scripts for schema changes
│   ├── 001_create_users_table.php
│   ├── 002_create_events_table.php
│   └── 003_create_tickets_table.php
│
├── .env                  # Environment configuration file
├── .htaccess             # Web server configuration (URL rewriting, security)
├── composer.json         # PHP dependency management
└── README.md             # Project overview and quick start guide
```

*This structure supports our MVC design while isolating the repository layer from controllers. It aligns with modern PHP practices, as detailed in resources.*

## Conclusion

The combination of a well-defined folder structure and the repository design pattern makes **Eventller** a scalable, maintainable, and testable application. By abstracting data access away from business logic and organizing our code into clear, distinct layers, we ensure that our platform can evolve gracefully as new features and requirements arise.