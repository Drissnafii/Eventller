-- Insert data into Categories
INSERT INTO categories (name) VALUES
('Music'),
('Sports'),
('Technology'),
('Education'),
('Art');

-- Insert data into Users
INSERT INTO users (name, email, password, avatar, role, isActivated) VALUES
('Alice Johnson', 'alice@example.com', 'hashedpassword1', '', 'admin', TRUE),
('Bob Smith', 'bob@example.com', 'hashedpassword2', '', 'user', TRUE),
('Charlie Davis', 'charlie@example.com', 'hashedpassword3', '', 'organisator', FALSE);

-- Insert data into Events
INSERT INTO events (title, description, location, datetime, image, userId, category_id, places) VALUES
('Rock Concert', 'An amazing night of rock music.', 'Stadium A', '2025-03-15 19:00:00', 'https://s.wsj.net/public/resources/images/B3-BY031_TRUCKE_IM_20181002114854.jpg', 3, 1, 100),
('Football Match', 'A thrilling game between top teams.', 'Arena B', '2025-04-10 18:00:00', 'https://a.espncdn.com/photo/2022/0926/r1067322_1296x729_16-9.jpg', 2, 2, 500),
('Tech Conference', 'A gathering of tech enthusiasts.', 'Convention Center C', '2025-05-20 09:00:00', 'https://images.tech.co/wp-content/uploads/2024/01/22094704/EPN_0539-3-1-e1705934863400-708x400.jpg', 1, 3, 200),
('Art Exhibition', 'A showcase of modern art.', 'Gallery D', '2025-06-05 15:00:00', 'https://bykerwin-com.wnwd.co.uk/wp-content/uploads/2024/10/IMG_9843-Large-crypt-landscape-wall-amy-wordpress-banner.jpeg', 3, 5, 50),
('Coding Bootcamp', 'Learn full-stack development in an immersive experience.', 'Training Hub E', '2025-07-01 10:00:00', 'https://www.jackimwoods.com/wp-content/uploads/2023/01/tech_coding_bootcamp.jpg', 1, 4, 30);

-- Insert data into Tickets
INSERT INTO tickets (eventId, price, origanisatorId, places) VALUES
(1, 20.00, 3, 100),
(2, 50.00, 2, 500),
(3, 100.00, 1, 200),
(4, 30.00, 3, 50),
(5, 150.00, 1, 30);


-- Insert data into Booking table
INSERT INTO booking (ticketId, userId, payment_id, payment_status, payment_amount, payment_date) VALUES
(1, 2, 'PAY-1234567', 'paid', 20.00, '2024-01-15 14:30:00'),
(2, 1, 'PAY-2345678', 'paid', 50.00, '2024-01-16 09:15:00'),
(3, 2, 'PAY-3456789', 'pending', 100.00, '2024-01-17 16:45:00'),
(4, 3, 'PAY-4567890', 'paid', 30.00, '2024-01-18 11:20:00'),
(5, 1, 'PAY-5678901', 'paid', 150.00, '2024-01-19 13:10:00');