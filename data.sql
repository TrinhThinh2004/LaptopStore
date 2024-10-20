INSERT INTO Users (username, password, email, full_name, phone_number, address, role)
VALUES 
('admin', 'admin', 'admin@example.com', 'Admin User', '1234567890', '123 Admin St', 1),
('user1', 'user1', 'user1@example.com', 'John Doe', '0987654321', '456 John Ave', 0),
('user2', 'user2', 'user2@example.com', 'John Doe', '0987654321', '456 John Ave', 0);


INSERT INTO Laptops (brand, model, processor, ram, storage, price, description)
VALUES 
('Dell', 'Inspiron 15', 'Intel Core i5', 8, 512, 799.99, 'A powerful laptop for everyday use.'),
('HP', 'Pavilion x360', 'Intel Core i7', 16, 1024, 999.99, 'A convertible laptop with high performance.'),
('Apple', 'MacBook Pro', 'Apple M1', 16, 256, 1299.99, 'The latest MacBook with M1 chip.'),
('Asus', 'ZenBook 14', 'Intel Core i7', 8, 512, 849.99, 'A sleek and light ultrabook for professionals.'),
('Lenovo', 'ThinkPad X1 Carbon', 'Intel Core i5', 16, 1024, 1199.99, 'A business laptop with robust security features.');


INSERT INTO Categories (category_name, description)
VALUES 
('Gaming', 'Laptops designed for gaming with high-end specs'),
('Business', 'Laptops for business professionals'),
('Ultrabook', 'Thin, lightweight laptops for portability'),
('Convertible', 'Laptops that can be converted into tablets'),
('Budget', 'Affordable laptops for basic use');


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

INSERT INTO Reviews (laptop_id, user_id, rating, comment)
VALUES 
(1, 2, 4, 'Good laptop for basic tasks, but could be faster.'),
(3, 3, 5, 'The M1 chip is a game changer, extremely fast and responsive.'),
(4, 2, 4, 'Lightweight and great design, but battery life could be better.'),
(5, 3, 5, 'Perfect for business use, very reliable and secure.');

INSERT INTO Shopping_Cart (user_id)
VALUES 
(2), -- John Doe's cart
(3); -- Jane Doe's cart

INSERT INTO Shopping_Cart_Items (cart_id, laptop_id, quantity, price)
VALUES 
(1, 1, 1, 799.99), -- Dell Inspiron 15 for John Doe
(2, 2, 1, 999.99); -- HP Pavilion x360 for Jane Doe



