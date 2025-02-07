# Eventller: Advanced Event Management Platform

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Build Status](https://img.shields.io/github/actions/workflow/status/eventller-devs/eventller-event-management/main.yml)](https://github.com/eventller-devs/eventller-event-management/actions)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.1-brightgreen.svg)](https://php.net)

## Table of Contents
1. [Team Overview](#team-overview)
2. [Project Context](#project-context)
3. [Core Features](#core-features)
4. [Tech Stack](#tech-stack)
5. [Installation Guide](#installation)
6. [Database Architecture](#database-architecture)
7. [User Stories & Workflows](#user-stories)
8. [UML Diagrams](#uml-diagrams)
9. [Scrum Board](#scrum-board)
10. [Performance Optimization](#performance-optimization)
11. [Security Implementation](#security)
12. [Testing Strategy](#testing)
13. [Contributing](#contributing)
14. [License](#license)

---

## Team Overview  
**Eventller** is developed by:  
- **Driss Nafii** (Architect)  
- **Oussama Quasdaoui** (Backend Lead)  
- **Ouassama Oujaber** (DevOps)  
- **Amine Naboulssi** (Lead Developer)  
- **Yassine El Hassani** (Head of Quality)

The project is a collaborative effort of these individuals, each bringing their unique expertise to realize the vision of Eventller.

## Project Context  
Eventller is designed to be an advanced, scalable event management platform akin to Eventbrite. It leverages PHP MVC, PostgreSQL, and AJAX for smooth, dynamic user interactions. Our platform supports the full lifecycle of event management, from planning and promotion to ticketing and post-event analysis.

## Core Features  
Our platform comes packed with a comprehensive set of features to meet the diverse needs of event organizers and attendees:

- **Event Management:** Organizers can effortlessly create, edit, and manage event details.
- **Ticketing System:** Seamlessly handle ticket sales with multiple pricing tiers.
- **User Authentication:** Secure registration and login with role-based access control.
- **Dynamic Filtering:** AJAX-powered event discovery based on category, date, or location.
- **Admin Dashboard:** In-depth platform oversight with user moderation and global analytics.

## Tech Stack  
### Backend  
- **PHP 8.1**: Ensures optimal performance and modern language features.
- **PostgreSQL**: A powerful, open-source relational database ensuring data integrity.
- **PDO**: Safeguards against SQL injection via prepared statements.
- **Twig**: A flexible and fast template engine for clean view-layer code.
- **Composer**: Streamlines dependency management.

### Frontend  
- **HTML5/CSS3/ES6**: Standards-compliant, modern web technologies.
- **Bootstrap 5**: Accelerates responsive design and UI consistency.
- **Fetch API**: AJAX capabilities for dynamic content loading without full-page reloads.

### Security  
- **CSRF Protection**: Middleware to prevent Cross-Site Request Forgery attacks.
- **XSS Sanitization**: Stringent input validation to guard against Cross-Site Scripting.
- **Data Encryption**: Sensitive data is appropriately encrypted in storage and transit.

## Installation Guide  
For detailed instructions on how to set up Eventller locally, follow our comprehensive installation guide:

1. **Clone the Repository:**  
   `git clone https://github.com/eventller-devs/eventller-event-management.git`

2. **Change to the Project Directory:**  
   `cd eventller-event-management`

3. **Install Dependencies:**  
   `composer install`

4. **Set Up Environment:**  
   Move `.env.example` to `.env` and edit as needed.

5. **Database Configuration:**  
   Ensure your PostgreSQL connection details are correctly entered in `.env`. Run migrations via `php artisan migrate`.

6. **Start Local Server:**  
   `php -S localhost:8000 -t public`

7. **Odd Creations Script:** *(If applicable)*  
   Run any additional scripts noted separately.

*This section was championed by the collective efforts of our team, with guidance provided by **Ouassama Oujaber** (DevOps).*

## Database Architecture  
Eventller’s database is meticulously designed to support the platform’s functionality while maintaining peak performance. Here are the key aspects:

- **Normalized Structure:** Optimal data arrangement to reduce redundancy.
- **Indexing Strategy:** Essential columns are indexed for faster querying.
- **Referential Integrity:** Proper foreign key relationships to preserve consistency.

For a comprehensive view, refer to the [Database Schema](docs/eventller_db_schema.png).

## User Stories & Workflows  
Our platform is designed by centering user journeys—read about them in our [User Workflows](docs/user_stories.md).

## UML Diagrams  
The software design is supported by clear UML diagrams, including:

- **Class Diagram:** Depicts the system's classes, their attributes, methods, and relationships.
- **Sequence Diagram:** Illustrates interactions among classes in a specific scenario.
- **Use Case Diagram:** Highlights system functions and how users interact with them.

*View our [docs](docs/diagrams.md) for complete diagram resources.*

## Scrum Board  
Keep track of our project’s progress via our Trello board:  
\[ [https://amineyoucode.atlassian.net/jira/software/projects/EV/boards/13] \]

*Replace the above link with your actual Trello or GitHub Projects board.*

## Performance Optimization  
We prioritize performance across all layers:

- **Dynamic Content Loading:** AJAX-powered, reducing page reloads.
- **Database Indexing:** Ensures rapid query responses.
- **Caching Strategies:** Leverages server-side caching to minimize response times.
- **Gzip Compression:** Reduces payload size for faster loading.

*For more, see [Performance Optimization](docs/perf_optimization.md).*

## Security Implementation  
Eventller takes security seriously:

- **Injection Protection:** Uses PDO prepared statements to fend off SQL injection.
- **CSRF Tokens:** Vital for secure form submissions.
- **Password Hashing:** Bcrypt via PHP's `password_hash()` ensures safe password storage.
- **HTTPS Enforcement:** All traffic is encrypted via secure connections.
- **Content Security Policy (CSP):** Functions to prevent XSS attacks by defining permissible content sources.

*Check our [Security Practices](docs/security.md) for full details.*

## Testing Strategy  
Ensure the reliability and stability of Eventller through:

- **Unit Tests:** Focuses on testing individual components.
- **Integration Tests:** Assures that components work together seamlessly.
- **Functional Tests:** Simulates user actions to confirm system behavior matches requirements.
- **Code Review:** Manual scrutinizing of code changes before merging.

*Explore our [Testing Guide](docs/testing.md) for more information.*

## Contributing  
We cordially invite our team members to contribute to this project’s growth. Whether you’re suggesting new features, fixing bugs, or improving documentation—every contribution is valued.

**How to Contribute:**

1. **Fork the Repository.**
2. **Create a Feature Branch:** `git checkout -b feature/your-feature`
3. **Commit Changes:** `git commit -m 'Add some feature'`
4. **Push to Your Fork:** `git push origin feature/your-feature`
5. **Submit a Pull Request.**

*Specifically, we extend this invitation to our team members:*  
- **Driss Nafii**
- **Oussama Quasdaoui**
- **Ouassama Oujaber**
- **Amine Naboulssi**
- **Yassine El Hassani**

*Embrace the opportunity to shape Eventller’s future!*

## License  
This project is licensed under the MIT License—see the [LICENSE](LICENSE) file for details.
