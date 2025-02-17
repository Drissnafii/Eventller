CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    avatar TEXT DEFAULT '',
    role VARCHAR(20) CHECK (role IN ('admin', 'user', 'organisator')),
    isActivated BOOLEAN NOT NULL DEFAULT FALSE
);