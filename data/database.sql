-- Tạo cơ sở dữ liệu với mã hóa UTF-8
CREATE DATABASE LaptopStore DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
USE LaptopStore;

-- Bảng Users
CREATE TABLE Users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  password VARCHAR(255),
  email VARCHAR(100),
  full_name VARCHAR(100),
  phone_number VARCHAR(15),
  address VARCHAR(255),
  role TINYINT DEFAULT 0, -- 0: user, 1: admin
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  deleted TINYINT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Laptops
CREATE TABLE Laptops (
  laptop_id INT AUTO_INCREMENT PRIMARY KEY,
  brand VARCHAR(50) NOT NULL, -- Hãng sản xuất laptop
  model VARCHAR(100) NOT NULL, -- Model laptop
  processor VARCHAR(100) NOT NULL, -- Tên đầy đủ của bộ xử lý (CPU) như Intel Core i5 - 12450H, AMD Ryzen 7 - 5700U
  ram_capacity INT NOT NULL, -- Dung lượng RAM (GB)
  ram_type VARCHAR(50) NOT NULL, -- Loại RAM như DDR4, DDR5, v.v.
  ram_speed VARCHAR(50) NOT NULL, -- Tốc độ RAM như 3200 MHz, 4800 MHz
  storage INT NOT NULL, -- Dung lượng ổ cứng (GB)
  storage_type VARCHAR(50) NOT NULL, -- Loại ổ cứng (SSD, HDD)
  gpu VARCHAR(100) NOT NULL, -- Loại card đồ họa (GeForce RTX™ 4060 8GB GDDR6 hoặc Onboard)
  screen_size VARCHAR(50) NOT NULL, -- Kích thước màn hình (ví dụ: 15.6")
  screen_resolution VARCHAR(50) NOT NULL, -- Độ phân giải màn hình (ví dụ: Full HD (1920 x 1080))
  screen_refresh_rate VARCHAR(50), -- Tần số quét màn hình (ví dụ: 144Hz)
  price DECIMAL(20, 2) NOT NULL, -- Giá laptop (VNĐ)
  description TEXT, -- Mô tả thêm về laptop
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  deleted TINYINT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Laptop_Images
CREATE TABLE Laptop_Images (
  image_id INT AUTO_INCREMENT PRIMARY KEY,
  laptop_id INT,
  image_url VARCHAR(255) NOT NULL,
  FOREIGN KEY (laptop_id) REFERENCES Laptops(laptop_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Categories
CREATE TABLE Categories (
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(50) NOT NULL UNIQUE,
  description TEXT,
  deleted TINYINT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Laptop_Categories
CREATE TABLE Laptop_Categories (
  laptop_id INT,
  category_id INT,
  PRIMARY KEY (laptop_id, category_id),
  FOREIGN KEY (laptop_id) REFERENCES Laptops(laptop_id) ON DELETE CASCADE,
  FOREIGN KEY (category_id) REFERENCES Categories(category_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Orders
CREATE TABLE Orders (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  total_price DECIMAL(20, 2) NOT NULL,
  order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  status TINYINT DEFAULT 1, -- 1: chờ xác nhận, 2:Đang giao, 3: completed, 4: cancelled
  payment_method TINYINT NOT NULL, -- 1: cash, 2: bank transfer (QR)
  email VARCHAR(100) NOT NULL,
  full_name VARCHAR(100),
  phone_number VARCHAR(15),
  address VARCHAR(255) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Order_Items
CREATE TABLE Order_Items (
  order_item_id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT,
  laptop_id INT,
  quantity INT NOT NULL,
  FOREIGN KEY (order_id) REFERENCES Orders(order_id) ON DELETE CASCADE,
  FOREIGN KEY (laptop_id) REFERENCES Laptops(laptop_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Bảng Cart (Giỏ hàng)
CREATE TABLE Cart (
  cart_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  laptop_id INT,
  quantity INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
  FOREIGN KEY (laptop_id) REFERENCES Laptops(laptop_id) ON DELETE CASCADE,
  UNIQUE KEY unique_user_laptop (user_id, laptop_id) -- Ràng buộc duy nhất: mỗi laptop chỉ được thêm một lần
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
