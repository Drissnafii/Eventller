CREATE TABLE tickets (
    id SERIAL PRIMARY KEY,
    eventId INT,
    price DECIMAL(10,2) NOT NULL,
    origanisatorId INT,
    places INT,
    FOREIGN KEY (eventId) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (origanisatorId) REFERENCES users(id) ON DELETE CASCADE
);