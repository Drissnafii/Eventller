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
('Jazz Night Special', 'Evening of smooth jazz and blues', 'Blue Note Club', '2024-06-20 20:00:00', 'jazz_night.jpg', 2, 1, 200),
('Rock Concert Revival', 'Classic rock bands reunion', 'Stadium Arena', '2024-08-25 19:00:00', 'rock_concert.jpg', 2, 1, 5000),
('Classical Symphony', 'Beethoven and Mozart masterpieces', 'Opera House', '2024-07-30 19:30:00', 'symphony.jpg', 2, 1, 800),
('Basketball Tournament', 'Interstate championship games', 'Sports Center', '2024-06-15 13:00:00', 'basketball.jpg', 2, 2, 1500),
('Soccer League Finals', 'City league championship match', 'Soccer Stadium', '2024-09-05 16:00:00', 'soccer.jpg', 2, 2, 3000),
('AI and Machine Learning Summit', 'Latest trends in AI', 'Tech Hub', '2024-10-10 09:00:00', 'ai_summit.jpg', 2, 3, 300),
('Web Development Workshop', 'Hands-on coding session', 'Innovation Center', '2024-08-05 10:00:00', 'webdev.jpg', 2, 3, 100),
('Startup Pitch Day', 'Entrepreneurs showcase ideas', 'Business Center', '2024-07-20 14:00:00', 'pitch_day.jpg', 2, 4, 150),
('Marketing Conference', 'Digital marketing strategies', 'Convention Hall', '2024-11-15 09:00:00', 'marketing.jpg', 2, 4, 400),
('Photography Exhibition', 'Urban life photography', 'Art Gallery', '2024-06-25 11:00:00', 'photo_exhibit.jpg', 2, 5, 250),
('Dance Performance', 'Contemporary dance show', 'Theater Hall', '2024-08-30 20:00:00', 'dance.jpg', 2, 5, 300),
('Electronic Music Festival', 'EDM and house music fest', 'Beach Arena', '2024-07-10 16:00:00', 'edm_fest.jpg', 2, 1, 2000),
('Tennis Open', 'Professional tennis tournament', 'Tennis Complex', '2024-09-15 10:00:00', 'tennis.jpg', 2, 2, 1000),
('Cybersecurity Conference', 'Security experts summit', 'Digital Center', '2024-10-20 09:00:00', 'cybersec.jpg', 2, 3, 250),
('Investment Workshop', 'Financial planning seminar', 'Finance Hub', '2024-08-12 15:00:00', 'investment.jpg', 2, 4, 120),
('Street Art Festival', 'Urban art and graffiti', 'Downtown Area', '2024-07-05 12:00:00', 'street_art.jpg', 2, 5, 500),
('Opera Night', 'Classic opera performance', 'Grand Theater', '2024-09-25 19:00:00', 'opera.jpg', 2, 1, 600),
('Swimming Championship', 'National swimming competition', 'Aquatic Center', '2024-08-20 09:00:00', 'swimming.jpg', 2, 2, 800),
('Game Developers Meetup', 'Gaming industry networking', 'Game Studio', '2024-11-05 14:00:00', 'gamedev.jpg', 2, 3, 150),
('Fashion Show', 'Summer collection showcase', 'Fashion Center', '2024-06-30 18:00:00', 'fashion.jpg', 2, 5, 400);

-- Insert sample tickets
INSERT INTO tickets (eventId, userId) VALUES
(1, 3),
(1, 2),
(2, 3),
(3, 3),
(4, 2);