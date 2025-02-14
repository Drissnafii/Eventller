CREATE TABLE tickets (
    id SERIAL PRIMARY KEY,
    eventId INT,
    origanisatorId INT,
    places INT,
    FOREIGN KEY (eventId) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (origanisatorId) REFERENCES users(id) ON DELETE CASCADE
);

INSERT into tickets (eventid , origanisatorid , places) VALUES (21 , 31 , 70);
INSERT into tickets (eventid , origanisatorid , places) VALUES (22 , 31 , 40);


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

