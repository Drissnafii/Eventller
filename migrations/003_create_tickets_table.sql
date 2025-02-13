CREATE TABLE tickets (
    id SERIAL PRIMARY KEY,
    eventId INT,
    userId INT,
    payment_id VARCHAR(255),
    payment_status VARCHAR(50),
    payment_amount DECIMAL(10,2),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (eventId) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
);