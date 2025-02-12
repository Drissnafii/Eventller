-- Insert sample categories
INSERT INTO Categories (name) VALUES 
('Music'),
('Sports'),
('Technology'),
('Business'),
('Arts & Culture');

-- Insert sample users
INSERT INTO users (name, email, password, role, isActivated) VALUES
('John Admin', 'admin@example.com', '$2a$10$somehashedpassword', 'admin', true),
('Sarah Organizer', 'sarah@example.com', '$2a$10$somehashedpassword', 'organisator', true),
('Mike User', 'mike@example.com', '$2a$10$somehashedpassword', 'user', true);

-- Insert sample events
INSERT INTO events (title, description, location, datetime, image, userId, category_id, places) VALUES
('Summer Music Festival', 'A fantastic outdoor music festival featuring local bands', 'Central Park', '2024-07-15 18:00:00', 'music_festival.jpg', 2, 1, 1000),
('Tech Conference 2024', 'Annual technology conference with industry leaders', 'Convention Center', '2024-09-20 09:00:00', 'tech_conf.jpg', 2, 3, 500),
('Art Exhibition', 'Contemporary art showcase featuring local artists', 'City Gallery', '2024-06-01 10:00:00', 'art_exhibit.jpg', 2, 5, 200),
('Business Networking', 'Monthly networking event for entrepreneurs', 'Business Hub', '2024-05-30 17:00:00', 'networking.jpg', 2, 4, 100),
('Sports Tournament', 'Annual city sports championship', 'Sports Complex', '2024-08-10 14:00:00', 'sports.jpg', 2, 2, 2000);

-- Insert sample tickets
INSERT INTO tickets (eventId, userId) VALUES
(1, 3),
(1, 2),
(2, 3),
(3, 3),
(4, 2);