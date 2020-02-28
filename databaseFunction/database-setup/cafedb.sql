CREATE DATABASE cafedb;

USE cafedb;

CREATE TABLE user (user_id INT AUTO_INCREMENT PRIMARY KEY, user_name VARCHAR(100) UNIQUE NOT NULL, email VARCHAR(50) UNIQUE NOT NULL, user_password VARCHAR(200) NOT NULL, room VARCHAR(20) NOT NULL, ext INT NOT NULL, user_type VARCHAR(10) NOT NULL, profile_pic VARCHAR(200));

CREATE TABLE orders (order_id INT AUTO_INCREMENT PRIMARY KEY, order_status VARCHAR(20) NOT NULL, order_date DATETIME NOT NULL, room VARCHAR(20) NOT NULL, amount FLOAT NOT NULL, notes VARCHAR(300), user_id INT NOT NULL, FOREIGN KEY (user_id) REFERENCES user(user_id)) ON DELETE CASCADE;

CREATE TABLE category (category_id INT AUTO_INCREMENT PRIMARY KEY, category_name VARCHAR(50) UNIQUE NOT NULL);

CREATE TABLE product (product_id INT AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR(50) UNIQUE NOT NULL, product_img VARCHAR(200), price FLOAT NOT NULL, available VARCHAR(20) NOT NULL, category_id INT NOT NULL, FOREIGN KEY (category_id) REFERENCES category(category_id)) ON DELETE CASCADE;

CREATE TABLE order_product (order_id INT, product_id INT, quantity INT NOT NULL, FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE, FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE, PRIMARY KEY (order_id, product_id));

INSERT INTO user (user_name, email, user_password, room, ext, user_type) VALUES ("Mohamed Mostafa", "mohamedmostafa@gmail.com", "mo1234", "123", "4567", "admin");
INSERT INTO user (user_name, email, user_password, room, ext, user_type) VALUES ("Mohamed Adham", "mohamedadham@gmail.com", "mo2345", "456", "4560", "user");
INSERT INTO user (user_name, email, user_password, room, ext, user_type) VALUES ("Mahmoud ElBasha", "mahmoudelbasha@gmail.com", "ma3456", "789", "4967", "user");
INSERT INTO user (user_name, email, user_password, room, ext, user_type) VALUES ("Reham Hussein", "rehamhussein@gmail.com", "rh4567", "101", "9567", "user");

INSERT INTO category (category_name) VALUES ("Hot Drinks");

INSERT INTO product (product_name, product_img, available, price, category_id) VALUES ( "Espresso", "../imag/Espresso.png", "available", 5.5, 1);
INSERT INTO product (product_name, product_img, available, price, category_id) VALUES ( "Double Espresso", "../imag/Double Espresso.png", "available", 5.5, 1);
INSERT INTO product (product_name, product_img, available, price, category_id) VALUES ( "Cappuccino", "../imag/Cappuccino.png", "unavailable", 5.5, 1);
INSERT INTO product (product_name, product_img, available, price, category_id) VALUES ( "Mocha", "../imag/Mocha.png", "available", 5.5, 1);


INSERT INTO orders (order_status, order_date, room, amount, notes, user_id) VALUES ("processing", "2020-02-21 10:12:00", "456", 11, "Espresso 1 tps of Sugar", 2);

INSERT INTO order_product (order_id, product_id, quantity) VALUES (1, 1, 1);
INSERT INTO order_product (order_id, product_id, quantity) VALUES (1, 3, 1);

INSERT INTO orders (order_status, order_date, room, amount, notes, user_id) VALUES ("processing", "2020-02-21 13:12:00", "789", 11, "Mocha extra sugar", 3);

INSERT INTO order_product (order_id, product_id, quantity) VALUES (2, 1, 1);
INSERT INTO order_product (order_id, product_id, quantity) VALUES (2, 4, 1);

INSERT INTO orders (order_status, order_date, room, amount, notes, user_id) VALUES ("done", "2020-02-21 15:12:00", "101", 5.5, "Mocha extra sugar", 4);

INSERT INTO order_product (order_id, product_id, quantity) VALUES (3, 4, 1);