INSERT INTO Users (username, password, email, full_name, phone_number, address, role)
VALUES 
('admin', 'admin', 'admin@example.com', 'Admin User', '1234567890', '123 Admin St', 1),
('user1', 'user1', 'user1@example.com', 'John Doe', '0987654321', '456 John Ave', 0),
('user2', 'user2', 'user2@example.com', 'John Doe', '0987654321', '456 John Ave', 0)


INSERT INTO Categories (category_name, description)
VALUES
('AI', 'Chuyên dụng cho AI'), -- 1
('Gaming', 'Chiến game bao đỉnh'),  -- 2
('Học tập - Văn phòng', 'Học sinh - Sinh viên - Dân văn phòng'), -- 3
('Đồ họa', 'Đồ họa'), -- 4
('Kỹ thuật', 'Kỹ thuật'), -- 5
('Mỏng nhẹ', 'Siuu nhẹ'), -- 6
('Cao cấp', 'Đồ đại gia'); -- 7


INSERT INTO Laptop_Categories (laptop_id, category_id)
VALUES 
(1, 3),
(1, 6),
(2, 2),
(2, 5),
(3, 2),
(3, 4),
(4, 4),
(4, 5),
(5, 3),
(5, 6),
(6, 1),
(6, 5),
(7, 2),
(7, 5),
(8, 3),
(8, 6),
(9, 4),
(9, 5),
(10, 3),
(10, 6),
(11, 4),
(11, 7),
(12, 1),
(12, 4),
(13, 1),
(13, 2),
(14, 3),
(14, 6),
(15, 4),
(15, 5),
(16, 1),
(16, 2),
(16, 7),
(17, 2),
(17, 5),
(18, 1),
(18, 4),
(19, 3),
(20, 6),
(21, 6),
(21, 4),
(22, 4),
(22, 5),
(23, 1),
(23, 2),
(23, 5),
(24, 5),
(24, 6),
(25, 2),
(25, 4),
(26, 4),
(26, 5),
(27, 2),
(27, 4),
(28, 3),
(28, 6),
(29, 1),
(29, 4),
(29, 5),
(30, 2),
(30, 5),
(31, 2),
(31, 4),
(32, 2),
(32, 4),
(32, 5),
(33, 1),
(33, 2),
(33, 5),
(34, 2),
(34, 4),
(35, 3),
(35, 6),
(36, 2),
(36, 4),
(37, 6),
(37, 7),
(38, 1),
(38, 6),
(38, 7),
(39, 6),
(39, 7),
(40, 1),
(40, 6),
(40, 7),
(41, 6),
(41, 7),
(42, 6),
(42, 7);




