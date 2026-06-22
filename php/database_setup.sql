-- Nepali E-Market Database Setup

-- Create products table
CREATE TABLE IF NOT EXISTS `products` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `brand` VARCHAR(100) NOT NULL,
    `category` VARCHAR(50) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `specs` TEXT,
    `availability` TINYINT DEFAULT 1,
    `image_url` VARCHAR(255),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create contact_messages table
CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `message` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample products data
INSERT INTO `products` (`name`, `brand`, `category`, `price`, `specs`, `availability`, `image_url`) VALUES
('Samsung Galaxy S21', 'Samsung', 'phone', 95000, 'Snapdragon 888, 8GB RAM, 256GB Storage, 6.2" Display', 1, 'img/products/galaxys21.jpg'),
('Dell XPS 13', 'Dell', 'laptop', 165000, 'Intel i7, 8GB RAM, 512GB SSD, 13" Display', 1, 'img/products/dellxps13.jpg'),
('iPad Pro 11', 'Apple', 'tablet', 120000, 'A12Z Bionic, 128GB Storage, 11" Liquid Retina', 1, 'img/products/ipad11pro.jpg'),
('iPhone 13', 'Apple', 'phone', 135000, 'A15 Bionic, 128GB Storage, 6.1" Super Retina', 1, 'img/products/iphone13.jpg'),
('HP Omen 16', 'HP', 'laptop', 185000, 'Intel i9, 16GB RAM, 1TB SSD, RTX 3080', 1, 'img/products/omen16.jpg'),
('Samsung S25 Ultra', 'Samsung', 'phone', 155000, 'Snapdragon 8 Gen 3, 12GB RAM, 256GB Storage, 6.8" Display', 1, 'img/products/s25ultra.jpg'),
('Wireless Headphones', 'Premium', 'accessories', 35000, 'Noise Cancelling, 30hr Battery, Bluetooth 5.0', 1, 'img/products/headphone.jpg'),
('Nothing Phone 3a', 'Nothing', 'phone', 72000, 'Snapdragon 7 Gen 3, 8GB RAM, 256GB Storage, 120Hz Display', 1, 'img/products/nothing-phone3a.jpg'),
('MacBook Pro 14', 'Apple', 'laptop', 220000, 'M1 Pro, 16GB RAM, 512GB SSD, 14" Retina', 1, 'img/products/macbookpro14.jpg'),
('Google Pixel 9 Pro', 'Google', 'phone', 128000, 'Tensor G4 Chip, 16GB RAM, 256GB Storage, 6.3" Display', 1, 'img/products/pixel9pro.jpg');
