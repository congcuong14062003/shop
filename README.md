\*\* Database

CREATE TABLE users_acc (
`id_user` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`acc_name` VARCHAR(50),
`username` VARCHAR(50) ,
`avt_user` varchar(100) default "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg",
`email` VARCHAR(100) ,
`gender` varchar(10),
`dob` datetime,
`passwords` VARCHAR(255),
`address` VARCHAR(255),
`phone` VARCHAR(20),
`desc_shop` varchar(200),
`money_remain` decimal(15,0) default 50000000
);

CREATE TABLE images (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL ,
size INT NOT NULL,
type VARCHAR(50) NOT NULL,
data LONGBLOB NOT NULL
);

CREATE TABLE `product` (
`id_product` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
`id_user` int not null,
`name_product` varchar(255) NOT NULL,
`category` varchar(50) not null,
`media_link` varchar(100),
`description` text,
`price` decimal(15,2) NOT NULL,
`price_root` decimal(15,2) NOT NULL,
`total_sold` int default 0,
`remain` int
);

CREATE TABLE `media` (
`id_media` int NOT NULL auto_increment PRIMARY KEY,
`id_product` int ,
`type` varchar(50) ,
`name` varchar(255) ,
`data` LONGBLOB
);

create table product_rate(
`id_rate` int auto_increment primary key not null,
`id_product` int,
`rate` int default 5,
`id_customer` int unique,
`feedback` text ,
`time_curr` datetime
);

CREATE TABLE my_orders (
`id_orders` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`total` DECIMAL(10,2) NOT NULL,
`product_id` INT NOT NULL,
`status_orders` VARCHAR(50) NOT NULL default 'Đang vận chuyển',
`created_at` DATETIME NOT NULL
);

CREATE TABLE messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT DEFAULT 0,
    sender_id INT,
    receiver_id INT,
    message TEXT
);
INSERT INTO messages (room_id, sender_id, receiver_id, message)
VALUES (0, 1, 2, 'Hello, how are you?');
