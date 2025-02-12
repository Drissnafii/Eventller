CREATE TABLE tickets (
    id SERIAL PRIMARY KEY,
    eventId INT,
    userId INT,
    FOREIGN KEY (eventId) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
);