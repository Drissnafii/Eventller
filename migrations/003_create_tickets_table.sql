CREATE TABLE Categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    avatar TEXT DEFAULT '',
    role VARCHAR(20) CHECK (role IN ('admin', 'user', 'organisator')),
    isActivated BOOLEAN NOT NULL DEFAULT FALSE
);
CREATE TABLE events (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(255) NOT NULL,
    datetime TIMESTAMP NOT NULL,
    image TEXT DEFAULT '',
    userId INT,
    category_id int , 
    places int, 
    FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (userId) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE TABLE tickets (
    id SERIAL PRIMARY KEY,
    eventId INT,
    price DECIMAL(10,2) NOT NULL,
    origanisatorId INT,
    places INT,
    FOREIGN KEY (eventId) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (origanisatorId) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE booking (
    id SERIAL PRIMARY KEY,
    ticketId INT,
    userId INT,
    payment_id VARCHAR(255) NULL,
    payment_status VARCHAR(50) NULL,
    payment_amount DECIMAL(10,2) NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (ticketId) REFERENCES tickets(id) ON DELETE CASCADE
);