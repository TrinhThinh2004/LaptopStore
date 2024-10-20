-- Tạo cơ sở dữ liệu với mã hóa UTF-8
CREATE DATABASE LaptopStore DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
USE LaptopStore;
drop database LaptopStore;

-- Xóa dữ liệu từ các bảng con trước
DELETE FROM Shopping_Cart_Items; -- Xóa dữ liệu trong Shopping_Cart_Items trước
DELETE FROM Order_Items;          -- Xóa dữ liệu trong Order_Items
DELETE FROM Reviews;              -- Xóa dữ liệu trong Reviews
DELETE FROM Laptop_Categories;     -- Xóa dữ liệu trong Laptop_Categories
DELETE FROM Laptop_Images;        -- Xóa dữ liệu trong Laptop_Images

-- Sau đó xóa dữ liệu từ các bảng cha
DELETE FROM Shopping_Cart;        -- Xóa dữ liệu trong Shopping_Cart
DELETE FROM Orders;               -- Xóa dữ liệu trong Orders
DELETE FROM Laptops;              -- Xóa dữ liệu trong Laptops
DELETE FROM Users;                -- Xóa dữ liệu trong Users
DELETE FROM Categories;           -- Xóa dữ liệu trong Categories


drop table users;

-- Bảng Users
CREATE TABLE Users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  full_name VARCHAR(100),
  phone_number VARCHAR(15),
  address VARCHAR(255),
  role TINYINT DEFAULT 0, -- 0: user, 1: admin
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Laptops
CREATE TABLE Laptops (
  laptop_id INT AUTO_INCREMENT PRIMARY KEY,
  brand VARCHAR(50) NOT NULL,
  model VARCHAR(100) NOT NULL,
  processor VARCHAR(100),
  ram INT,
  storage INT,
  price DECIMAL(10, 2) NOT NULL,
  description TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Laptop_Images
CREATE TABLE Laptop_Images (
  image_id INT AUTO_INCREMENT PRIMARY KEY,
  laptop_id INT,
  image_url VARCHAR(255) NOT NULL,
  is_thumbnail BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Categories
CREATE TABLE Categories (
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(50) NOT NULL UNIQUE,
  description TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Laptop_Categories
CREATE TABLE Laptop_Categories (
  laptop_id INT,
  category_id INT,
  PRIMARY KEY (laptop_id, category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Orders
CREATE TABLE Orders (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  total_price DECIMAL(10, 2) NOT NULL,
  order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  status TINYINT DEFAULT 1 -- 1: pending, 2: completed, 3: cancelled
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Order_Items
CREATE TABLE Order_Items (
  order_item_id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  laptop_id INT,
  quantity INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Reviews
CREATE TABLE Reviews (
  review_id INT AUTO_INCREMENT PRIMARY KEY,
  laptop_id INT,
  user_id INT,
  rating INT CHECK (rating >= 1 AND rating <= 5),
  comment TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Shopping_Cart
CREATE TABLE Shopping_Cart (
  cart_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Shopping_Cart_Items
CREATE TABLE Shopping_Cart_Items (
  cart_item_id INT AUTO_INCREMENT PRIMARY KEY,
  cart_id INT,
  laptop_id INT,
  quantity INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Thêm ràng buộc khóa ngoại cho các bảng

-- Ràng buộc cho bảng Laptop_Images
ALTER TABLE Laptop_Images
ADD CONSTRAINT fk_laptop_images_laptops
FOREIGN KEY (laptop_id) REFERENCES Laptops(laptop_id) ON DELETE CASCADE;

-- Ràng buộc cho bảng Orders
ALTER TABLE Orders
ADD CONSTRAINT fk_orders_users
FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE;

-- Ràng buộc cho bảng Order_Items
ALTER TABLE Order_Items
ADD CONSTRAINT fk_order_items_orders
FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE;

ALTER TABLE Order_Items
ADD CONSTRAINT fk_order_items_laptops
FOREIGN KEY (laptop_id) REFERENCES Laptops(laptop_id) ON DELETE CASCADE;

-- Ràng buộc cho bảng Laptop_Categories
ALTER TABLE Laptop_Categories
ADD CONSTRAINT fk_laptop_categories_laptops
FOREIGN KEY (laptop_id) REFERENCES Laptops(laptop_id) ON DELETE CASCADE;

ALTER TABLE Laptop_Categories
ADD CONSTRAINT fk_laptop_categories_categories
FOREIGN KEY (category_id) REFERENCES Categories(category_id) ON DELETE CASCADE;

-- Ràng buộc cho bảng Shopping_Cart_Items
ALTER TABLE Shopping_Cart_Items
ADD CONSTRAINT fk_cart_items_cart
FOREIGN KEY (cart_id) REFERENCES Shopping_Cart(cart_id) ON DELETE CASCADE;

ALTER TABLE Shopping_Cart_Items
ADD CONSTRAINT fk_cart_items_laptops
FOREIGN KEY (laptop_id) REFERENCES Laptops(laptop_id) ON DELETE CASCADE;

-- Ràng buộc cho bảng Reviews
ALTER TABLE Reviews
ADD CONSTRAINT fk_reviews_laptops
FOREIGN KEY (laptop_id) REFERENCES Laptops(laptop_id) ON DELETE CASCADE;

ALTER TABLE Reviews
ADD CONSTRAINT fk_reviews_users
FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE;

