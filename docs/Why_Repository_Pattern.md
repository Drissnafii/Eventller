# Repository Design Pattern: Why and How to Use It

The Repository Design Pattern is a software design pattern that acts as a middle layer between your business logic and data access logic. It centralizes database operations, making your code cleaner, more maintainable, and easier to test.

## 🧩 What is the Repository Pattern?

The Repository Pattern is like a librarian for your application:
- **You (Controller)**: Ask the librarian for a book (data).
- **Librarian (Repository)**: Knows where the books are stored and how to fetch them.
- **Bookshelf (Database)**: The actual storage system.

You don’t care how the librarian retrieves the book—you just get the book. Similarly, your application doesn’t need to know how data is fetched from the database.

## ❌ Bad Example: Without Repository Pattern

### Problem: Mixing Database Logic in Controllers

In this example, database logic is directly embedded in the controller. This leads to tight coupling, duplicated code, and hard-to-maintain systems.

```php
// File: app/controllers/UserController.php
class UserController {
    private $db;

    public function __construct() {
        $this->db = new PDO("pgsql:host=localhost;dbname=myapp", "user", "password");
    }

    // Fetch a user by ID
    public function showProfile($userId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch();

        // Display user data
        echo "User: {$user['name']}, Email: {$user['email']}";
    }

    // Create a new user
    public function createUser($name, $email) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->execute([':name' => $name, ':email' => $email]);
    }
}
```

### Issues with This Approach:
- **Tight Coupling**: Controllers are tightly coupled to the database.
- **Duplicated Code**: If another controller needs to fetch users, the same SQL query is duplicated.
- **Hard to Test**: You can’t test the controller without a real database.
- **Security Risks**: SQL queries scattered everywhere increase the risk of SQL injection.

## ✅ Good Example: With Repository Pattern

### Solution: Centralize Database Logic in a Repository

The Repository Pattern separates database logic from business logic, making your code cleaner, testable, and reusable.

#### Step 1: Create the Model

```php
// File: app/models/User.php
class User {
    private $id;
    private $name;
    private $email;

    public function __construct($id, $name, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
}
```

#### Step 2: Create the Repository

```php
// File: app/repositories/UserRepository.php
require_once __DIR__ . '/../core/Database.php';

class UserRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Fetch a user by ID
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch();

        return new User($data['id'], $data['name'], $data['email']);
    }

    // Save a user
    public function save(User $user) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->execute([
            ':name' => $user->getName(),
            ':email' => $user->getEmail()
        ]);
    }
}
```

#### Step 3: Use the Repository in a Controller

```php
// File: app/controllers/UserController.php
require_once __DIR__ . '/../repositories/UserRepository.php';

class UserController {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    // Fetch a user by ID
    public function showProfile($userId) {
        $user = $this->userRepository->findById($userId);
        echo "User: {$user->getName()}, Email: {$user->getEmail()}";
    }

    // Create a new user
    public function createUser($name, $email) {
        $user = new User(null, $name, $email);
        $this->userRepository->save($user);
    }
}
```

## 🌟 Benefits of the Repository Pattern

- **Separation of Concerns**:
  - Models handle business logic.
  - Repositories handle database logic.
  - Controllers handle HTTP logic.

- **Testability**:
  - Mock repositories to test controllers without a real database.

- **Reusability**:
  - Use the same repository across multiple controllers.

- **Security**:
  - Centralized SQL queries make it easier to prevent SQL injection.

- **Maintainability**:
  - Changes to database logic are confined to the repository.

## 🔄 Workflow Analogy

- **You (Controller)**: "Hey Repository, get me user #123!"
- **Repository**: Runs `SELECT * FROM users WHERE id = 123` and returns a User object.
- **You**: Display the user’s data in a view.

No need to worry about how the data is fetched—just focus on what to do with it!

## 🚀 When to Use the Repository Pattern

- Your application has complex database queries.
- You want to decouple your business logic from data access logic.
- You need to support multiple data sources (e.g., PostgreSQL, MySQL, APIs).
- You want to write unit tests for your application.

## 📲 Project-Specific Example: Viewing an Event Profile

1. **User Clicks "View Event" in `event_list.php`**

```php
<!-- event_list.php -->
<a href="index.php?action=view_event&id=<?php echo $event->id; ?>">👁️ View</a>
```

2. **`index.php` Routes to `EventController`**

```php
// index.php
$action = $_GET['action'] ?? 'home';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'view_event':
        $eventController->showEvent($id);
        break;
}
```

3. **`EventRepository` Fetches Data**

```php
// EventController.php
public function showEvent($eventId) {
    $event = $this->eventRepository->findById($eventId);
    include 'views/event_profile.php';
}
```

4. **Display Event Details in `event_profile.php`**

```php
<!-- event_profile.php -->
<h1><?php echo $event->getTitle(); ?></h1>
<p>Date: <?php echo $event->getDate(); ?></p>
```

5. **Browser Shows**:

```
Event: Tech Conference 2024
Date: 2024-06-15
Location: Paris
```

## 🛠 Key Use Cases in Our Project

- **Organizer Dashboard**:
  - `OrganizerController` uses `EventRepository` to fetch events created by the logged-in user.

- **Admin Panel**:
  - `AdminController` uses `UserRepository` and `EventRepository` to manage users and events.

- **Reservation System**:
  - `ReservationRepository` checks seat availability before confirming a booking.

- **AJAX Loading**:
  - `AjaxController` calls `EventRepository` to load events dynamically without page reloads.

## 🚀 Final Recap: Why Repositories Matter in Our Project

The Repository Pattern ensures our event platform remains:
- **Scalable**: Easily add new features (e.g., sponsored events) without rewriting data logic.
- **Secure**: Centralized SQL queries reduce injection risks (critical for payment processing).
- **Testable**: Mock repositories to test reservation workflows or admin actions.
- **Maintainable**: Change database logic in one place (e.g., switch to MySQL without touching controllers).