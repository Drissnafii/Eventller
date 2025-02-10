CREATE TABLE events {
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(255) NOT NULL,
    datetime DATETIME NOT NULL,
    image TEXT DEFAULT '',
    userId INT,
    eventId INT,
    category_id int , 
    places int, 
    FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (userId) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (eventId) REFERENCES events(id) ON UPDATE CASCADE ON DELETE SET NULL
}