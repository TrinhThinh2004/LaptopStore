INSERT INTO Users (username, password, email, full_name, phone_number, address, role)
VALUES 
('admin', 'admin', 'admin@example.com', 'Admin User', '1234567890', '123 Admin St', 1),
('user1', 'user1', 'user1@example.com', 'John Doe', '0987654321', '456 John Ave', 0),
('user2', 'user2', 'user2@example.com', 'John Doe', '0987654321', '456 John Ave', 0);



INSERT INTO Categories (category_name, description)
VALUES
    ('AI', 'Chuyên dụng cho AI'),
    ('Gaming', 'Chiến game bao đỉnh'),
    ('Học tập - Văn phòng', 'Học sinh - Sinh viên - Dân văn phòng'),
    ('Đồ họa - Kỹ thuật', 'Đồ họa'),
    ('Kỹ thuật', 'Kỹ thuật'),
    ('Mỏng nhẹ', 'Siuu nhẹ'),
    ('Cao cấp', 'Đồ đại gia');



INSERT INTO Laptop_Categories (laptop_id, category_id)
VALUES 
(1, 5), -- Dell Inspiron 15 -> Budget
(2, 4), -- HP Pavilion x360 -> Convertible
(3, 3), -- MacBook Pro -> Ultrabook
(4, 3), -- Asus ZenBook 14 -> Ultrabook
(5, 2); -- Lenovo ThinkPad X1 Carbon -> Business


INSERT INTO Orders (user_id, total_price, status)
VALUES 
(2, 1299.99, 2), -- User1 completed order
(3, 849.99, 1); -- User2 pending order

INSERT INTO Order_Items (order_id, laptop_id, quantity, price)
VALUES 
(1, 3, 1, 1299.99), -- MacBook Pro for User1
(2, 4, 1, 849.99); -- Asus ZenBook 14 for User1


INSERT INTO Shopping_Cart (user_id)
VALUES 
(2), -- John Doe's cart
(3); -- Jane Doe's cart


