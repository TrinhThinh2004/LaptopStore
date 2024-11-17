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
  stock_quantity INT NOT NULL DEFAULT 0, -- Số lượng laptop có sẵn
  description TEXT, -- Mô tả thêm về laptop
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  deleted TINYINT DEFAULT 0 -- Cờ đánh dấu xóa (0 = chưa xóa, 1 = đã xóa)
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


INSERT INTO Laptops (brand, model, processor, ram_capacity, ram_type, ram_speed, storage, storage_type, gpu, screen_size, screen_resolution, screen_refresh_rate, price, stock_quantity, description) VALUES
('Acer', 'acer_aspire_3_a315_44p_r9w8_r7', 'AMD Ryzen 7 - 5700U', 8, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'AMD Radeon Graphics', '15.6 inches', 'Full HD (1920 x 1080)', '60Hz', 10690000, 200, 'Laptop Acer Aspire 3 A315 44P R9W8 R7 5700U/8GB/512GB/Win11 (NX.KSJSV.002)'),
('Acer', 'acer_gaming_aspire_5_a515_58gm_53pz_i5', 'Intel Core i5 Raptor Lake - 13420H', 8, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 2050 (4GB)', '15.6 inches', 'Full HD (1920 x 1080)', '144Hz', 15490000, 250, 'Laptop Acer Gaming Aspire 5 A515 58GM 53PZ i5 13420H/8GB/512GB/4GB RTX2050/Win11 (NX.KQ4SV.008)'),
('Acer', 'acer_gaming_nitro_an515_58_773y_i7', 'Intel Core i7 Alder Lake - 12700H', 16, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 3050Ti (4GB)', '15.6 inches', 'Full HD (1920 x 1080)', '144Hz', 22990000, 300, 'Laptop Acer Gaming Nitro AN515 58 773Y i7 12700H/16GB/512GB/4GB RTX3050Ti/144Hz/Win11 (NH.QFKSV.001.16G)'),
('Acer', 'acer_predator_helios_neo_phn16_71_53m7_i5', 'Intel Core i5 Raptor Lake - 13500HX', 16, 'DDR4', '4800 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 4060 (8GB)', '16 inches', 'Full HD (1920 x 1080)', '165Hz', 25990000, 350, 'Laptop Acer Predator Helios Neo PHN16 71 53M7 i5 13500HX/16GB/512GB/8GB RTX4060/165Hz/Win11 (NH.QLUSV.005)'),
('Acer', 'acer_swift_go_14_41_r251_r5', 'AMD Ryzen 5 - 7430U', 16, 'DDR4', '4800 MHz', 1024, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '14 inches', 'Full HD (1920 x 1080)', '60Hz', 16490000, 400, 'Laptop Acer Swift Go 14 41 R251 R5 7430U/16GB/1TB/Win11 (NX.KG3SV.005)'),
('Acer', 'acer_swift_lite_14_al_sfl14_51m_56hs_ultra_5', 'Intel Core Ultra 5 Meteor Lake - 125U', 16, 'DDR5', '5600 MHz', 512, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '14 inches', '1920 x 1200', '60Hz', 18190000, 500, 'Laptop Acer Swift Lite 14 AI SFL14 51M 56HS Ultra 5 125U/16GB/512GB/Win11 (NX.J1HSV.002)'),


('Asus', 'asus_gaming_tuf_a15_fa507nur_r7', 'AMD Ryzen 7 - 7435HS', 16, 'DDR4', '4800 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 4050 (6GB)', '15.6 inches', 'Full HD (1920 x 1080)', '144Hz', 25590000, 200, 'Laptop Asus Gaming TUF A15 FA507NUR R7 7435HS/16GB/512GB/6GB RTX4050/144Hz/Win11 (LP057W)'),
('Asus', 'asus_gaming_vivobook_k3605zf_i5', 'Intel Core i5 Alder Lake - 12500H', 16, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 2050 (4GB)', '15.6 inches', 'WUXGA', '144Hz', 17490000, 250, 'Laptop Asus Gaming Vivobook K3605ZF i5 12500H/16GB/512GB/4GB RTX2050/Win11 (RP745W)'),
('Asus', 'asus_tuf_gaming_a15_fa506nf_r5', 'AMD Ryzen 5 - 7535HS', 16, 'DDR4', '4800 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 2050 (4GB)', '15.6 inches', 'Full HD (1920 x 1080)', '144Hz', 16990000, 300, 'Laptop Asus TUF Gaming A15 FA506NF R5 7535HS/16GB/512GB/4GB RTX2050/144Hz/Win11 (HN012W)'),
('Asus', 'asus_vivobook_go_15_e1504fa_r5', 'AMD Ryzen 5 - 7520U', 16, 'DDR4', '5500 MHz', 512, 'SSD NVMe PCIe', 'AMD Radeon 660M', '15.6 inches', 'Full HD (1920 x 1080)', '60Hz', 12590000, 400, 'Laptop Asus Vivobook Go 15 E1504FA R5 7520U/16GB/512GB/Win11 (NJ776W)'),
('Asus', 'asus_vivobook_s_16_oled_s5606ma_ultra_5', 'Intel Core Ultra 5 125H', 16, 'DDR5', '7467 MHz', 512, 'SSD NVMe PCIe', 'Intel Arc Graphics', '16 inches', '3200 x 2000', '120Hz', 24990000, 450, 'Laptop Asus Vivobook S 16 OLED S5606MA Ultra 5 125H/16GB/512GB/120Hz/Win11 (MX050W)'),
('Asus', 'asus_zenbook_14_oled_ux3405ma_ultra_5', 'Intel Core Ultra 5 Meteor Lake - 125H', 16, 'DDR5', '5200 MHz', 512, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '14 inches', '2.8K (2880 x 1800) - OLED 16:10', '120Hz', 26190000, 500, 'Laptop Asus Zenbook 14 OLED UX3405MA Ultra 5 125H/16GB/512GB/Win11'),


('Dell', 'dell_g15_5530_i9', 'Intel Core i9 Raptor Lake - 13900HX', 16, 'DDR5', '4800 MHz', 1024, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 4060 (8GB)', '15.6 inches', 'Full HD (1920 x 1080)', '165Hz', 40990000, 200, 'Laptop Dell G15 5530 i9 13900HX/16GB/1TB/8GB RTX4060/165Hz/OfficeHS/Win11 (i9HX161W11GR4060)'),
('Dell', 'dell_inspiron_15_3520_i5', 'Intel Core i5 Alder Lake - 1235U', 16, 'DDR4', '2666 MHz', 512, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '15.6 inches', 'Full HD (1920 x 1080)', '120Hz', 16490000, 250, 'Laptop Dell Inspiron 15 3520 i5 1235U/16GB/512GB/120Hz/OfficeHS/Win11 (N5I5052W1)'),
('Dell', 'dell_inspiron_15_3530_i7', 'Intel Core i7 Raptor Lake - 1355U', 16, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce MX550 (2GB)', '15.6 inches', 'Full HD (1920 x 1080)', '120Hz', 23990000, 300, 'Laptop Dell Inspiron 15 3530 i7 1355U/16GB/512GB/2GB MX550/OfficeHS/Win11 (N3530I716W1)'),
('Dell', 'dell_precision_15_3581_i7', 'Intel Core i7 Raptor Lake - 13800H', 32, 'DDR5', '5200 MHz', 1024, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX A500 (4GB)', '15.6 inches', 'Full HD (1920 x 1080)', '60Hz', 57290000, 350, 'Laptop Dell Precision 15 3581 i7 13800H/32GB/1TB/4GB RTXA500/Win11 Pro (71024677)'),
('Dell', 'dell_xps_13_9340_ultra_5', 'Intel Core Ultra 5 Meteor Lake - 125H', 16, 'DDR5', '7467 MHz', 2048, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '13.4 inches', 'QHD+ (2560 x 1600)', '120Hz', 52990000, 400, 'Laptop Dell XPS 13 9340 Ultra 5 125H/16GB/2TB/Touch/OfficeHS/Win11 (XPSU5934W1)'),
('Dell', 'dell_xps_13_9340_ultra_7', 'Intel Core Ultra 7 Meteor Lake - 155H', 16, 'DDR5', '7467 MHz', 1024, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '13.4 inches', '2560 x 1600', '60Hz', 55990000, 500, 'Laptop Dell XPS 13 9340 Ultra 7 155H/16GB/1TB/Touch/OfficeHS/Win11 (HXRGT)'),


('HP', 'hp_15_fd0234tu_i5', 'Intel Core i5 Raptor Lake - 1334U', 16, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '15.6 inches', 'Full HD (1920 x 1080)', '60Hz', 16290000, 250, 'Laptop HP 15 fd0234TU i5 1334U/16GB/512GB/Win11 (9Q969PA)'),
('HP', 'hp_15_fd1063tu_ultra_5', 'Intel Core Ultra 5 Meteor Lake - 125H', 16, 'DDR5', '5600 MHz', 512, 'SSD NVMe PCIe', 'Intel Graphics', '15.6 inches', 'Full HD (1920 x 1080)', '60Hz', 19090000, 300, 'Laptop HP 15 fd1063TU Ultra 5 125H/16GB/512GB/Win11 (9Z2Y1PA)'),
('HP', 'hp_245_g10_r5', 'AMD Ryzen 5 - 7530U', 8, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'AMD Radeon 660M', '15.6 inches', 'Full HD (1920 x 1080)', '60Hz', 12190000, 350, 'Laptop HP 245 G10 R5 7530U/8GB/512GB/Win11 (A20TDPT)'),
('HP', 'hp_gaming_victus_15_fa1139tx_i5', 'Intel Core i5 Alder Lake - 12450H', 16, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 2050 (4GB)', '15.6 inches', 'Full HD (1920 x 1080)', '144Hz', 19490000, 200, 'Laptop HP Gaming VICTUS 15 fa1139TX i5 12450H/16GB/512GB/4GB RTX2050/144Hz/Win11 (8Y6W3PA)'),
('HP', 'hp_omen_16_xf0070ax_r9', 'AMD Ryzen 9 - 7940HS', 32, 'DDR5', '5600 MHz', 1024, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 4070 (8GB)', '16.1 inches', 'QHD', '240Hz', 57890000, 200, 'Laptop HP OMEN 16 xf0070AX R9 7940HS/32GB/1TB/8GB RTX4070/240Hz/Win11 (8W945PA)'),
('HP', 'hp_pavilion_15_eg2062tx_i5', 'Intel Core i5 Alder Lake - 1235U', 8, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce MX550 (2GB)', '15.6 inches', 'Full HD (1920 x 1080)', '60Hz', 15790000, 500, 'Laptop HP Pavilion 15 eg2062TX i5 1235U/8GB/512GB/2GB MX550/Win11 (7C0W7PA)'),


('Lenovo', 'lenovo_gaming_legion_pro_5_16irx9_i9', 'Intel Core i9 Raptor Lake - 14900HX', 32, 'DDR5', '5600 MHz', 1024, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 4060 (8GB)', '16 inches', 'WQXGA (2560 x 1600)', '240Hz', 46990000, 200, 'Laptop Lenovo Gaming Legion Pro 5 16IRX9 i9 14900HX/32GB/1TB/8GB RTX4060/240Hz/Win11 (83DF0047VN)'),
('Lenovo', 'lenovo_gaming_legion_slim_5_16ahp9_r7', 'AMD Ryzen 7 - 8845HS', 32, 'DDR5', '5600 MHz', 1024, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 4060 (8GB)', '16 inches', 'WQXGA (2560 x 1600)', '165Hz', 42990000, 250, 'Laptop Lenovo Gaming Legion Slim 5 16AHP9 R7 8845HS/32GB/1TB/8GB RTX4060/165Hz/Win11 (83DH003BVN)'),
('Lenovo', 'lenovo_gaming_loq_15iax9_i5', 'Intel Core i5 Alder Lake - 12450HX', 16, 'DDR4', '4800 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 3050 (6GB)', '15.6 inches', 'Full HD (1920 x 1080)', '144Hz', 21690000, 300, 'Laptop Lenovo Gaming LOQ 15IAX9 i5 12450HX/16GB/512GB/6GB RTX3050/144Hz/Win11 (83GS000JVN)'),
('Lenovo', 'lenovo_ideapad_slim_3_15iah8_i5', 'Intel Core i5 Alder Lake - 12450H', 16, 'DDR4', '4800 MHz', 512, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '15.6 inches', 'Full HD (1920 x 1080)', '60Hz', 14290000, 400, 'Laptop Lenovo Ideapad Slim 3 15IAH8 i5 12450H/16GB/512GB/Win11 (83ER000EVN)'),
('Lenovo', 'lenovo_thinkpad_e14_gen_6_ultra_7', 'Intel Core Ultra 7 Meteor Lake - 155U', 16, 'DDR5', '5600 MHz', 512, 'SSD NVMe PCIe', 'Intel Graphics', '14 inches', 'WUXGA', '60Hz', 27990000, 200, 'Laptop Lenovo ThinkPad E14 Gen 6 Ultra 7 155U/16GB/512GB/Win11 (21M7004UVN)'),
('Lenovo', 'lenovo_yoga_slim_7_14imh9_ultra_7', 'Intel Core Ultra 7 Meteor Lake - 155H', 32, 'DDR5', '7467 MHz', 1024, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '14 inches', 'WUXGA, OLED', '60Hz', 30990000, 500, 'Laptop Lenovo Yoga Slim 7 14IMH9 Ultra 7 155H/32GB/1TB/OfficeHS/Win11 (83CV001VVN)'),


('MSI', 'msi_gaming_gf63_thin_12ve_i5', 'Intel Core i5 Alder Lake - 12450H', 16, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 4050 (6GB)', '15.6 inches', 'Full HD (1920 x 1080)', '144Hz', 18990000, 300, 'Laptop MSI Gaming GF63 Thin 12VE i5 12450H/16GB/512GB/6GB RTX4050/144Hz/Win11 (460VN)'),
('MSI', 'msi_gaming_katana_15_b13udxk_i7', 'Intel Core i7 Raptor Lake - 13620H', 16, 'DDR4', '5200 MHz', 1024, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 3050 (6GB)', '15.6 inches', 'Full HD (1920 x 1080)', '144Hz', 23990000, 250, 'Laptop MSI Gaming Katana 15 B13UDXK i7 13620H/16GB/1TB/6GB RTX3050/144Hz/Win11 (2077VN)'),
('MSI', 'msi_gaming_stealth_14_ai_studio_a1vfg_ultra_7', 'Intel Core Ultra 7 Meteor Lake - 155H', 32, 'DDR5', '5600 MHz', 1024, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 4060 (8GB)', '14 inches', '2.8K (2880 x 1800) - OLED', '120Hz', 48990000, 200, 'Laptop MSI Gaming Stealth 14 AI Studio A1VFG Ultra 7 155H/32GB/1TB/8GB RTX4060/120Hz/Win11 (085VN)'),
('MSI', 'msi_gaming_sword_16_hx_b14vfkg_i7', 'Intel Core i7 Raptor Lake - 14700HX', 16, 'DDR5', '5600 MHz', 1024, 'SSD NVMe PCIe', 'NVIDIA GeForce RTX 4060 (8GB)', '16.1 inches', 'Full HD (1920 x 1080)', '240Hz', 36990000, 400, 'Laptop MSI Gaming Sword 16 HX B14VFKG i7 14700HX/16GB/1TB/8GB RTX4060/240Hz/Win11 (045VN)'),
('MSI', 'msi_modern_15_b12mo_i5', 'Intel Core i5 Alder Lake - 1235U', 16, 'DDR4', '3200 MHz', 512, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '15.6 inches', 'Full HD (1920 x 1080)', '60Hz', 12490000, 500, 'Laptop MSI Modern 15 B12MO i5 1235U/16GB/512GB/Win11 (628VN)'),
('MSI', 'msi_prestige_13_ai_evo_a1mg_ultra_7', 'Intel Core Ultra 7 Meteor Lake - 155H', 32, 'DDR5', '6400 MHz', 1024, 'SSD NVMe PCIe', 'Intel Iris Xe Graphics', '13.4 inches', '2.8K (2880 x 1800) - OLED 16:10', '120Hz', 30990000, 300, 'Laptop MSI Prestige 13 AI Evo A1MG Ultra 7 155H/32GB/1TB/Win11 (062VN)'),


('Apple', 'apple_macbook_air_13_inch_m2', 'Apple M2', 8, 'Unified Memory', 'Hang khong cong bo', 256, 'SSD', 'Apple M2', '13.6 inches', '2560 x 1664', '60Hz', 24490000, 300, 'Laptop Apple MacBook Air 13 inch M2 8GB/256GB (MLXY3SA/A)'),
('Apple', 'apple_macbook_air_15_inch_m3', 'Apple M3', 16, 'Unified Memory', 'Hang khong cong bo', 512, 'SSD', 'Apple M3', '15.3 inches', 'Liquid Retina', 'Hang khong cong bo', 41990000, 250, 'Laptop Apple MacBook Air 15 inch M3 16GB/512GB (MXD23SA/A)'),
('Apple', 'apple_macbook_pro_14_inch_m3', 'Apple M3', 8, 'Unified Memory', 'Hang khong cong bo', 512, 'SSD', 'Apple M3', '14.2 inches', 'Liquid Retina XDR display (3024 x 1964)', '120 Hz', 38190000, 400, 'Laptop Apple MacBook Pro 14 inch M3 8GB/512GB (MR7J3SA/A)'),
('Apple', 'macbook_pro_14_inch_m2_pro_2023_12-core', 'Apple M2 Pro', 16, 'Unified Memory', 'Hang khong cong bo', 1024, 'SSD', 'Apple M2 Pro', '14.2 inches', 'Liquid Retina XDR display (3024 x 1964)', '120 Hz', 59690000, 200, 'Laptop MacBook Pro 14 inch M2 Pro 2023 12-core CPU/16GB/1TB/19-core GPU (MPHJ3SA/A)'),
('Apple', 'apple_macbook_air_13_inch_m1', 'Apple M1', 8, 'Unified Memory', 'Hang khong cong bo', 256, 'SSD', 'Apple M1', '13.3 inches', '2560 x 1600', '60Hz', 18590000, 500, 'Laptop Apple MacBook Air 13 inch M1 8GB/256GB (MGN63SA/A)'),
('Apple', 'apple_macbook_air_13_inch_m3', 'Apple M3', 8, 'Unified Memory', 'Hang khong cong bo', 512, 'SSD', 'Apple M3', '13.6 inches', '2560 x 1664', '60Hz', 31590000, 400, 'Laptop Apple MacBook Air 13 inch M3 8GB/512GB (MRXW3SA/A)');


INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`, `phone_number`, `address`, `role`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'admin', 'admin', 'admin@laptop4u.com', 'Admin', '0911118888', '123, Tô Ký, Quận 12, TP.HCM', 1, '2024-11-15 21:19:09', '2024-11-15 21:19:09', 0),
(2, 'user1', 'user1', 'user@hotmail.com', 'John Doeaa12345678', '1234567890', '456 John Ave', 0, '2024-11-15 21:19:09', '2024-11-15 21:19:09', 0),
(3, 'teo', 'teo123', 'teo@example.com', 'Tèo', '0987654321', 'Quận 1, TPHCM', 0, '2024-11-15 21:19:09', '2024-11-15 21:19:09', 0),
(4, 'test', 'test', 'test@gmail.com', 'Test', '1234566789', '456 John Ave', 0, '2024-11-17 10:17:42', '2024-11-17 10:21:24', 0),
(5, 'tu', 'tu1234', 'tu@gmail.com', 'Tú', '4569873216', 'Quận Bình Tân, TPHCM', 0, '2024-11-17 10:47:20', '2024-11-17 10:47:20', 0),
(6, 'phu', 'phu123', 'phu@gmail.com', 'Phú', '1658794622', 'Quận 3, TPHCM', 0, '2024-11-17 10:58:58', '2024-11-17 10:59:43', 0),
(7, 'bao', 'bao123', 'boa@gmail.com', 'Bảo', '1954161615', 'Quận 4, TPHCM', 0, '2024-11-17 11:01:24', '2024-11-17 11:02:09', 0),
(8, 'phong', 'phong123', 'phong@gmail.com', 'Phong', '1818145148', 'Quận 4, TPHCM', 0, '2024-11-17 11:03:36', '2024-11-17 11:04:24', 0),
(9, 'tuan', 'tuan123', 'tuan@gmail.com', 'Tuấn', '1658794622', 'Quận 5, TPHCM', 0, '2024-11-17 11:04:58', '2024-11-17 11:05:19', 0),
(10, 'minh', 'minh123', 'minh@gmail.com', 'Minh', '4849441261', 'Quận 6, TPHCM', 0, '2024-11-17 11:07:07', '2024-11-17 11:07:44', 0),
(11, 'thinh', 'thinh123', 'thinh@gmail.com', 'Thịnh', '1646465156', 'Quận 7, TPHCM', 0, '2024-11-17 11:08:16', '2024-11-17 11:08:59', 0),
(12, 'tien', 'tien123', 'tien@gmail.com', 'Tiến', '4545454612', 'Quận 8, TPHCM', 0, '2024-11-17 11:09:52', '2024-11-17 11:10:17', 0),
(13, 'phuc', 'phuc123', 'phuc@gmail.com', 'Phúc', '5465461132', 'Quận 8, TPHCM', 0, '2024-11-17 11:10:50', '2024-11-17 11:11:17', 0),
(14, 'phat', 'phat123', 'phat@gmail.com', 'Phát', '4654564166', 'Quận 9, TPHCM', 0, '2024-11-17 11:15:51', '2024-11-17 11:17:08', 0),
(15, 'luan', 'luan123', 'luan@gmail.com', 'Luân', '2161546516', 'Quận 10, TPHCM', 0, '2024-11-17 11:20:08', '2024-11-17 11:20:38', 0),
(16, 'huy', 'huy123', 'huy@gmail.com', 'Huy', '4894654611', 'Quận 11, TPHCM', 0, '2024-11-17 11:22:15', '2024-11-17 11:25:10', 0),
(17, 'thang', 'thang123', 'thang@gmail.com', 'Thắng', '5644646515', 'Quận 12, TPHCM', 0, '2024-11-17 11:28:04', '2024-11-17 11:28:38', 0),
(18, 'hieu', 'hieu123', 'hieu@gmail.com', 'Hiếu', '5646546123', 'Quận 12, TPHCM', 0, '2024-11-17 11:30:49', '2024-11-17 11:34:55', 0),
(19, 'thanh', 'thanh123', 'thanh@gmail.com', 'Thành', '4594644646', 'Quận Bình Thạnh, TPHCM', 0, '2024-11-17 11:38:42', '2024-11-17 11:42:39', 0),
(20, 'nhung', 'nhung123', 'nhung@gmail.com', 'Nhung', '5646123156', 'Quận Gò Vấp, TPHCM', 0, '2024-11-17 11:43:14', '2024-11-17 11:43:47', 0);


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


INSERT INTO LAPTOP_IMAGES (LAPTOP_ID, IMAGE_URL)
VALUES

('1','assets/images/acer/acer_aspire_3_a315_44p_r9w8_r7/chinh.jpg'),
('1','assets/images/acer/acer_aspire_3_a315_44p_r9w8_r7/1.jpg'),
('1','assets/images/acer/acer_aspire_3_a315_44p_r9w8_r7/2.jpg'),
('1','assets/images/acer/acer_aspire_3_a315_44p_r9w8_r7/3.jpg'),
('1','assets/images/acer/acer_aspire_3_a315_44p_r9w8_r7/4.jpg'),
('2','assets/images/acer/acer_gaming_aspire_5_a515_58gm_53pz_i5/chinh.jpg'),
('2','assets/images/acer/acer_gaming_aspire_5_a515_58gm_53pz_i5/1.jpg'),
('2','assets/images/acer/acer_gaming_aspire_5_a515_58gm_53pz_i5/2.jpg'),
('2','assets/images/acer/acer_gaming_aspire_5_a515_58gm_53pz_i5/3.jpg'),
('2','assets/images/acer/acer_gaming_aspire_5_a515_58gm_53pz_i5/4.jpg'),
('3','assets/images/acer/acer_gaming_nitro_an515_58_773y_i7/chinh.jpg'),
('3','assets/images/acer/acer_gaming_nitro_an515_58_773y_i7/1.jpg'),
('3','assets/images/acer/acer_gaming_nitro_an515_58_773y_i7/2.jpg'),
('3','assets/images/acer/acer_gaming_nitro_an515_58_773y_i7/3.jpg'),
('3','assets/images/acer/acer_gaming_nitro_an515_58_773y_i7/4.jpg'),
('4','assets/images/acer/acer_predator_helios_neo_phn16_71_53m7_i5/chinh.jpg'),
('4','assets/images/acer/acer_predator_helios_neo_phn16_71_53m7_i5/1.jpg'),
('4','assets/images/acer/acer_predator_helios_neo_phn16_71_53m7_i5/2.jpg'),
('4','assets/images/acer/acer_predator_helios_neo_phn16_71_53m7_i5/3.jpg'),
('4','assets/images/acer/acer_predator_helios_neo_phn16_71_53m7_i5/4.jpg'),
('5','assets/images/acer/acer_swift_go_14_41_r251_r5/chinh.jpg'),
('5','assets/images/acer/acer_swift_go_14_41_r251_r5/1.jpg'),
('5','assets/images/acer/acer_swift_go_14_41_r251_r5/2.jpg'),
('5','assets/images/acer/acer_swift_go_14_41_r251_r5/3.jpg'),
('5','assets/images/acer/acer_swift_go_14_41_r251_r5/4.jpg'),
('6','assets/images/acer/acer_swift_lite_14_al_sfl14_51m_56hs_ultra_5/chinh.jpg'),
('6','assets/images/acer/acer_swift_lite_14_al_sfl14_51m_56hs_ultra_5/1.jpg'),
('6','assets/images/acer/acer_swift_lite_14_al_sfl14_51m_56hs_ultra_5/2.jpg'),
('6','assets/images/acer/acer_swift_lite_14_al_sfl14_51m_56hs_ultra_5/3.jpg'),
('6','assets/images/acer/acer_swift_lite_14_al_sfl14_51m_56hs_ultra_5/4.jpg'),
('7','assets/images/asus/asus_gaming_tuf_a15_fa507nur_r7/chinh.jpg'),
('7','assets/images/asus/asus_gaming_tuf_a15_fa507nur_r7/1.jpg'),
('7','assets/images/asus/asus_gaming_tuf_a15_fa507nur_r7/2.jpg'),
('7','assets/images/asus/asus_gaming_tuf_a15_fa507nur_r7/3.jpg'),
('7','assets/images/asus/asus_gaming_tuf_a15_fa507nur_r7/4.jpg'),
('8','assets/images/asus/asus_gaming_vivobook_k3605zf_i5/chinh.jpg'),
('8','assets/images/asus/asus_gaming_vivobook_k3605zf_i5/1.jpg'),
('8','assets/images/asus/asus_gaming_vivobook_k3605zf_i5/2.jpg'),
('8','assets/images/asus/asus_gaming_vivobook_k3605zf_i5/3.jpg'),
('8','assets/images/asus/asus_gaming_vivobook_k3605zf_i5/4.jpg'),
('9','assets/images/asus/asus_tuf_gaming_a15_fa506nf_r5/chinh.jpg'),
('9','assets/images/asus/asus_tuf_gaming_a15_fa506nf_r5/1.jpg'),
('9','assets/images/asus/asus_tuf_gaming_a15_fa506nf_r5/2.jpg'),
('9','assets/images/asus/asus_tuf_gaming_a15_fa506nf_r5/3.jpg'),
('9','assets/images/asus/asus_tuf_gaming_a15_fa506nf_r5/4.jpg'),
('10','assets/images/asus/asus_vivobook_go_15_e1504fa_r5/chinh.jpg'),
('10','assets/images/asus/asus_vivobook_go_15_e1504fa_r5/1.jpg'),
('10','assets/images/asus/asus_vivobook_go_15_e1504fa_r5/2.jpg'),
('10','assets/images/asus/asus_vivobook_go_15_e1504fa_r5/3.jpg'),
('10','assets/images/asus/asus_vivobook_go_15_e1504fa_r5/4.jpg'),
('11','assets/images/asus/asus_vivobook_s_16_oled_s5606ma_ultra_5/chinh.jpg'),
('11','assets/images/asus/asus_vivobook_s_16_oled_s5606ma_ultra_5/1.jpg'),
('11','assets/images/asus/asus_vivobook_s_16_oled_s5606ma_ultra_5/2.jpg'),
('11','assets/images/asus/asus_vivobook_s_16_oled_s5606ma_ultra_5/3.jpg'),
('11','assets/images/asus/asus_vivobook_s_16_oled_s5606ma_ultra_5/4.jpg'),
('12','assets/images/asus/asus_zenbook_14_oled_ux3405ma_ultra_5/chinh.jpg'),
('12','assets/images/asus/asus_zenbook_14_oled_ux3405ma_ultra_5/1.jpg'),
('12','assets/images/asus/asus_zenbook_14_oled_ux3405ma_ultra_5/2.jpg'),
('12','assets/images/asus/asus_zenbook_14_oled_ux3405ma_ultra_5/3.jpg'),
('12','assets/images/asus/asus_zenbook_14_oled_ux3405ma_ultra_5/4.jpg'),
('13','assets/images/dell/dell_g15_5530_i9/chinh.jpg'),
('13','assets/images/dell/dell_g15_5530_i9/1.jpg'),
('13','assets/images/dell/dell_g15_5530_i9/2.jpg'),
('13','assets/images/dell/dell_g15_5530_i9/3.jpg'),
('13','assets/images/dell/dell_g15_5530_i9/4.jpg'),
('14','assets/images/dell/dell_inspiron_15_3520_i5/chinh.jpg'),
('14','assets/images/dell/dell_inspiron_15_3520_i5/1.jpg'),
('14','assets/images/dell/dell_inspiron_15_3520_i5/2.jpg'),
('14','assets/images/dell/dell_inspiron_15_3520_i5/3.jpg'),
('14','assets/images/dell/dell_inspiron_15_3520_i5/4.jpg'),
('15','assets/images/dell/dell_inspiron_15_3530_i7/chinh.jpg'),
('15','assets/images/dell/dell_inspiron_15_3530_i7/1.jpg'),
('15','assets/images/dell/dell_inspiron_15_3530_i7/2.jpg'),
('15','assets/images/dell/dell_inspiron_15_3530_i7/3.jpg'),
('15','assets/images/dell/dell_inspiron_15_3530_i7/4.jpg'),
('16','assets/images/dell/dell_precision_15_3581_i7/chinh.jpg'),
('16','assets/images/dell/dell_precision_15_3581_i7/1.jpg'),
('16','assets/images/dell/dell_precision_15_3581_i7/2.jpg'),
('16','assets/images/dell/dell_precision_15_3581_i7/3.jpg'),
('16','assets/images/dell/dell_precision_15_3581_i7/4.jpg'),
('17','assets/images/dell/dell_xps_13_9340_ultra_5/chinh.jpg'),
('17','assets/images/dell/dell_xps_13_9340_ultra_5/1.jpg'),
('17','assets/images/dell/dell_xps_13_9340_ultra_5/2.jpg'),
('17','assets/images/dell/dell_xps_13_9340_ultra_5/3.jpg'),
('17','assets/images/dell/dell_xps_13_9340_ultra_5/4.jpg'),
('18','assets/images/dell/dell_xps_13_9340_ultra_7/chinh.jpg'),
('18','assets/images/dell/dell_xps_13_9340_ultra_7/1.jpg'),
('18','assets/images/dell/dell_xps_13_9340_ultra_7/2.jpg'),
('18','assets/images/dell/dell_xps_13_9340_ultra_7/3.jpg'),
('18','assets/images/dell/dell_xps_13_9340_ultra_7/4.jpg'),
('19','assets/images/hp/hp_15_fd0234tu_i5/chinh.jpg'),
('19','assets/images/hp/hp_15_fd0234tu_i5/1.jpg'),
('19','assets/images/hp/hp_15_fd0234tu_i5/2.jpg'),
('19','assets/images/hp/hp_15_fd0234tu_i5/3.jpg'),
('19','assets/images/hp/hp_15_fd0234tu_i5/4.jpg'),
('20','assets/images/hp/hp_15_fd1063tu_ultra_5/chinh.jpg'),
('20','assets/images/hp/hp_15_fd1063tu_ultra_5/1.jpg'),
('20','assets/images/hp/hp_15_fd1063tu_ultra_5/2.jpg'),
('20','assets/images/hp/hp_15_fd1063tu_ultra_5/3.jpg'),
('20','assets/images/hp/hp_15_fd1063tu_ultra_5/4.jpg'),
('21','assets/images/hp/hp_245_g10_r5/chinh.jpg'),
('21','assets/images/hp/hp_245_g10_r5/1.jpg'),
('21','assets/images/hp/hp_245_g10_r5/2.jpg'),
('21','assets/images/hp/hp_245_g10_r5/3.jpg'),
('21','assets/images/hp/hp_245_g10_r5/4.jpg'),
('22','assets/images/hp/hp_gaming_victus_15_fa1139tx_i5/chinh.jpg'),
('22','assets/images/hp/hp_gaming_victus_15_fa1139tx_i5/1.jpg'),
('22','assets/images/hp/hp_gaming_victus_15_fa1139tx_i5/2.jpg'),
('22','assets/images/hp/hp_gaming_victus_15_fa1139tx_i5/3.jpg'),
('22','assets/images/hp/hp_gaming_victus_15_fa1139tx_i5/4.jpg'),
('23','assets/images/hp/hp_omen_16_xf0070ax_r9/chinh.jpg'),
('23','assets/images/hp/hp_omen_16_xf0070ax_r9/1.jpg'),
('23','assets/images/hp/hp_omen_16_xf0070ax_r9/2.jpg'),
('23','assets/images/hp/hp_omen_16_xf0070ax_r9/3.jpg'),
('23','assets/images/hp/hp_omen_16_xf0070ax_r9/4.jpg'),
('24','assets/images/hp/hp_pavilion_15_eg2062tx_i5/chinh.jpg'),
('24','assets/images/hp/hp_pavilion_15_eg2062tx_i5/1.jpg'),
('24','assets/images/hp/hp_pavilion_15_eg2062tx_i5/2.jpg'),
('24','assets/images/hp/hp_pavilion_15_eg2062tx_i5/3.jpg'),
('24','assets/images/hp/hp_pavilion_15_eg2062tx_i5/4.jpg'),
('25','assets/images/lenovo/lenovo_gaming_legion_pro_5_16irx9_i9/chinh.jpg'),
('25','assets/images/lenovo/lenovo_gaming_legion_pro_5_16irx9_i9/1.jpg'),
('25','assets/images/lenovo/lenovo_gaming_legion_pro_5_16irx9_i9/2.jpg'),
('25','assets/images/lenovo/lenovo_gaming_legion_pro_5_16irx9_i9/3.jpg'),
('25','assets/images/lenovo/lenovo_gaming_legion_pro_5_16irx9_i9/4.jpg'),
('26','assets/images/lenovo/lenovo_gaming_legion_slim_5_16ahp9_r7/chinh.jpg'),
('26','assets/images/lenovo/lenovo_gaming_legion_slim_5_16ahp9_r7/1.jpg'),
('26','assets/images/lenovo/lenovo_gaming_legion_slim_5_16ahp9_r7/2.jpg'),
('26','assets/images/lenovo/lenovo_gaming_legion_slim_5_16ahp9_r7/3.jpg'),
('26','assets/images/lenovo/lenovo_gaming_legion_slim_5_16ahp9_r7/4.jpg'),
('27','assets/images/lenovo/lenovo_gaming_loq_15iax9_i5/chinh.jpg'),
('27','assets/images/lenovo/lenovo_gaming_loq_15iax9_i5/1.jpg'),
('27','assets/images/lenovo/lenovo_gaming_loq_15iax9_i5/2.jpg'),
('27','assets/images/lenovo/lenovo_gaming_loq_15iax9_i5/3.jpg'),
('27','assets/images/lenovo/lenovo_gaming_loq_15iax9_i5/4.jpg'),
('28','assets/images/lenovo/lenovo_ideapad_slim_3_15iah8_i5/chinh.jpg'),
('28','assets/images/lenovo/lenovo_ideapad_slim_3_15iah8_i5/1.jpg'),
('28','assets/images/lenovo/lenovo_ideapad_slim_3_15iah8_i5/2.jpg'),
('28','assets/images/lenovo/lenovo_ideapad_slim_3_15iah8_i5/3.jpg'),
('28','assets/images/lenovo/lenovo_ideapad_slim_3_15iah8_i5/4.jpg'),
('29','assets/images/lenovo/lenovo_thinkpad_e14_gen_6_ultra_7/chinh.jpg'),
('29','assets/images/lenovo/lenovo_thinkpad_e14_gen_6_ultra_7/1.jpg'),
('29','assets/images/lenovo/lenovo_thinkpad_e14_gen_6_ultra_7/2.jpg'),
('29','assets/images/lenovo/lenovo_thinkpad_e14_gen_6_ultra_7/3.jpg'),
('29','assets/images/lenovo/lenovo_thinkpad_e14_gen_6_ultra_7/4.jpg'),
('30','assets/images/lenovo/lenovo_yoga_slim_7_14imh9_ultra_7/chinh.jpg'),
('30','assets/images/lenovo/lenovo_yoga_slim_7_14imh9_ultra_7/1.jpg'),
('30','assets/images/lenovo/lenovo_yoga_slim_7_14imh9_ultra_7/2.jpg'),
('30','assets/images/lenovo/lenovo_yoga_slim_7_14imh9_ultra_7/3.jpg'),
('30','assets/images/lenovo/lenovo_yoga_slim_7_14imh9_ultra_7/4.jpg'),
('31','assets/images/msi/msi_gaming_gf63_thin_12ve_i5/chinh.jpg'),
('31','assets/images/msi/msi_gaming_gf63_thin_12ve_i5/1.jpg'),
('31','assets/images/msi/msi_gaming_gf63_thin_12ve_i5/2.jpg'),
('31','assets/images/msi/msi_gaming_gf63_thin_12ve_i5/3.jpg'),
('31','assets/images/msi/msi_gaming_gf63_thin_12ve_i5/4.jpg'),
('32','assets/images/msi/msi_gaming_katana_15_b13udxk_i7/chinh.jpg'),
('32','assets/images/msi/msi_gaming_katana_15_b13udxk_i7/1.jpg'),
('32','assets/images/msi/msi_gaming_katana_15_b13udxk_i7/2.jpg'),
('32','assets/images/msi/msi_gaming_katana_15_b13udxk_i7/3.jpg'),
('32','assets/images/msi/msi_gaming_katana_15_b13udxk_i7/4.jpg'),
('33','assets/images/msi/msi_gaming_stealth_14_ai_studio_a1vfg_ultra_7/chinh.jpg'),
('33','assets/images/msi/msi_gaming_stealth_14_ai_studio_a1vfg_ultra_7/1.jpg'),
('33','assets/images/msi/msi_gaming_stealth_14_ai_studio_a1vfg_ultra_7/2.jpg'),
('33','assets/images/msi/msi_gaming_stealth_14_ai_studio_a1vfg_ultra_7/3.jpg'),
('33','assets/images/msi/msi_gaming_stealth_14_ai_studio_a1vfg_ultra_7/4.jpg'),
('34','assets/images/msi/msi_gaming_sword_16_hx_b14vfkg_i7/chinh.jpg'),
('34','assets/images/msi/msi_gaming_sword_16_hx_b14vfkg_i7/1.jpg'),
('34','assets/images/msi/msi_gaming_sword_16_hx_b14vfkg_i7/2.jpg'),
('34','assets/images/msi/msi_gaming_sword_16_hx_b14vfkg_i7/3.jpg'),
('34','assets/images/msi/msi_gaming_sword_16_hx_b14vfkg_i7/4.jpg'),
('35','assets/images/msi/msi_modern_15_b12mo_i5/chinh.jpg'),
('35','assets/images/msi/msi_modern_15_b12mo_i5/1.jpg'),
('35','assets/images/msi/msi_modern_15_b12mo_i5/2.jpg'),
('35','assets/images/msi/msi_modern_15_b12mo_i5/3.jpg'),
('35','assets/images/msi/msi_modern_15_b12mo_i5/4.jpg'),
('36','assets/images/msi/msi_prestige_13_ai_evo_a1mg_ultra_7/chinh.jpg'),
('36','assets/images/msi/msi_prestige_13_ai_evo_a1mg_ultra_7/1.jpg'),
('36','assets/images/msi/msi_prestige_13_ai_evo_a1mg_ultra_7/2.jpg'),
('36','assets/images/msi/msi_prestige_13_ai_evo_a1mg_ultra_7/3.jpg'),
('36','assets/images/msi/msi_prestige_13_ai_evo_a1mg_ultra_7/4.jpg'),
('37','assets/images/apple/apple_macbook_air_13_inch_m2/chinh.jpg'),
('37','assets/images/apple/apple_macbook_air_13_inch_m2/1.jpg'),
('37','assets/images/apple/apple_macbook_air_13_inch_m2/2.jpg'),
('37','assets/images/apple/apple_macbook_air_13_inch_m2/3.jpg'),
('37','assets/images/apple/apple_macbook_air_13_inch_m2/4.jpg'),
('38','assets/images/apple/apple_macbook_air_15_inch_m3/chinh.jpg'),
('38','assets/images/apple/apple_macbook_air_15_inch_m3/1.jpg'),
('38','assets/images/apple/apple_macbook_air_15_inch_m3/2.jpg'),
('38','assets/images/apple/apple_macbook_air_15_inch_m3/3.jpg'),
('38','assets/images/apple/apple_macbook_air_15_inch_m3/4.jpg'),
('39','assets/images/apple/apple_macbook_pro_14_inch_m3/chinh.jpg'),
('39','assets/images/apple/apple_macbook_pro_14_inch_m3/1.jpg'),
('39','assets/images/apple/apple_macbook_pro_14_inch_m3/2.jpg'),
('39','assets/images/apple/apple_macbook_pro_14_inch_m3/3.jpg'),
('39','assets/images/apple/apple_macbook_pro_14_inch_m3/4.jpg'),
('40','assets/images/apple/macbook_pro_14_inch_m2_pro_2023_12-core/chinh.jpg'),
('40','assets/images/apple/macbook_pro_14_inch_m2_pro_2023_12-core/1.jpg'),
('40','assets/images/apple/macbook_pro_14_inch_m2_pro_2023_12-core/2.jpg'),
('40','assets/images/apple/macbook_pro_14_inch_m2_pro_2023_12-core/3.jpg'),
('40','assets/images/apple/macbook_pro_14_inch_m2_pro_2023_12-core/4.jpg'),
('41','assets/images/apple/apple_macbook_air_13_inch_m1/chinh.jpg'),
('41','assets/images/apple/apple_macbook_air_13_inch_m1/1.jpg'),
('41','assets/images/apple/apple_macbook_air_13_inch_m1/2.jpg'),
('41','assets/images/apple/apple_macbook_air_13_inch_m1/3.jpg'),
('41','assets/images/apple/apple_macbook_air_13_inch_m1/4.jpg'),
('42','assets/images/apple/apple_macbook_air_13_inch_m3/chinh.jpg'),
('42','assets/images/apple/apple_macbook_air_13_inch_m3/1.jpg'),
('42','assets/images/apple/apple_macbook_air_13_inch_m3/2.jpg'),
('42','assets/images/apple/apple_macbook_air_13_inch_m3/3.jpg'),
('42','assets/images/apple/apple_macbook_air_13_inch_m3/4.jpg');

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `order_date`, `status`, `payment_method`, `email`, `full_name`, `phone_number`, `address`) VALUES
(1, 2, 31590000.00, '2024-11-17 12:52:59', 3, 1, 'user@hotmail.com', 'John Doeaa12345678', '1234567890', '456 John Ave'),
(2, 3, 24490000.00, '2024-10-17 12:53:13', 3, 1, 'teo@example.com', 'Tèo', '0987654321', 'Quận 1, TPHCM'),
(3, 4, 12490000.00, '2024-09-17 12:53:29', 3, 1, 'test@gmail.com', 'Test', '1234566789', '456 John Ave'),
(4, 5, 18990000.00, '2024-08-17 12:53:46', 3, 1, 'tu@gmail.com', 'Tú', '4569873216', 'Quận Bình Tân, TPHCM'),
(5, 6, 30990000.00, '2024-07-17 12:54:07', 3, 1, 'phu@gmail.com', 'Phú', '1658794622', 'Quận 3, TPHCM'),
(6, 7, 24990000.00, '2024-06-17 12:54:26', 3, 1, 'boa@gmail.com', 'Bảo', '1954161615', 'Quận 4, TPHCM'),
(7, 8, 41990000.00, '2024-05-17 12:54:42', 3, 1, 'phong@gmail.com', 'Phong', '1818145148', 'Quận 4, TPHCM'),
(8, 9, 14290000.00, '2024-04-17 12:54:54', 3, 1, 'tuan@gmail.com', 'Tuấn', '1658794622', 'Quận 5, TPHCM'),
(9, 10, 14290000.00, '2024-03-17 12:55:11', 3, 1, 'minh@gmail.com', 'Minh', '4849441261', 'Quận 6, TPHCM'),
(10, 11, 48990000.00, '2024-02-17 12:55:28', 3, 1, 'thinh@gmail.com', 'Thịnh', '1646465156', 'Quận 7, TPHCM'),
(11, 12, 52990000.00, '2024-01-17 12:55:43', 3, 1, 'tien@gmail.com', 'Tiến', '4545454612', 'Quận 8, TPHCM'),
(12, 13, 40990000.00, '2023-12-17 12:56:03', 3, 1, 'phuc@gmail.com', 'Phúc', '5465461132', 'Quận 8, TPHCM'),
(13, 14, 12490000.00, '2023-11-17 12:56:18', 3, 1, 'phat@gmail.com', 'Phát', '4654564166', 'Quận 9, TPHCM'),
(14, 15, 119380000.00, '2023-10-17 12:56:35', 3, 1, 'luan@gmail.com', 'Luân', '2161546516', 'Quận 10, TPHCM'),
(15, 15, 119380000.00, '2023-09-17 12:56:35', 3, 1, 'luan@gmail.com', '', '2161546516', 'Quận 10, TPHCM'),
(16, 16, 27990000.00, '2023-08-17 12:56:53', 3, 1, 'huy@gmail.com', 'Huy', '4894654611', 'Quận 11, TPHCM'),
(17, 17, 16990000.00, '2023-07-17 12:57:17', 3, 1, 'thang@gmail.com', 'Thắng', '5644646515', 'Quận 12, TPHCM'),
(18, 18, 38190000.00, '2023-06-17 12:57:31', 3, 1, 'hieu@gmail.com', 'Hiếu', '5646546123', 'Quận 12, TPHCM'),
(19, 19, 42990000.00, '2023-05-17 12:57:47', 3, 1, 'thanh@gmail.com', 'Thành', '4594644646', 'Quận Bình Thạnh, TPHCM'),
(20, 20, 25990000.00, '2023-04-17 12:58:00', 3, 1, 'nhung@gmail.com', 'Nhung', '5646123156', 'Quận Gò Vấp, TPHCM');

INSERT INTO `order_items` (`order_item_id`, `order_id`, `laptop_id`, `quantity`) VALUES
(2, 1, 42, 1),
(3, 2, 37, 1),
(4, 3, 35, 1),
(5, 4, 31, 1),
(6, 5, 30, 1),
(7, 6, 11, 1),
(8, 7, 38, 1),
(9, 8, 28, 1),
(10, 9, 28, 1),
(11, 10, 33, 1),
(12, 11, 17, 1),
(13, 12, 13, 1),
(14, 13, 35, 1),
(15, 15, 40, 2),
(16, 16, 29, 1),
(17, 17, 9, 1),
(18, 18, 39, 1),
(19, 19, 26, 1),
(20, 20, 4, 1);
