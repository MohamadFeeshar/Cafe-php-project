CREATE DATABASE cafedb;

USE cafedb;

CREATE TABLE user (user_id INT AUTO_INCREMENT PRIMARY KEY, user_name VARCHAR(100) UNIQUE NOT NULL, email VARCHAR(50) UNIQUE NOT NULL, user_password VARCHAR(200) NOT NULL, room VARCHAR(20) NOT NULL, ext INT NOT NULL, user_type VARCHAR(10) NOT NULL, profile_pic VARCHAR(200));

CREATE TABLE orders (order_id INT AUTO_INCREMENT PRIMARY KEY, order_status VARCHAR(20) NOT NULL, order_date DATETIME NOT NULL, room VARCHAR(20) NOT NULL, amount FLOAT NOT NULL, notes VARCHAR(300), user_id INT NOT NULL, FOREIGN KEY (user_id) REFERENCES user(user_id));

CREATE TABLE category (category_id INT AUTO_INCREMENT PRIMARY KEY, category_name VARCHAR(50) UNIQUE NOT NULL);

CREATE TABLE product (product_id INT AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR(50) UNIQUE NOT NULL, product_img VARCHAR(200), price FLOAT NOT NULL, category_id INT NOT NULL, FOREIGN KEY (category_id) REFERENCES category(category_id));

CREATE TABLE order_product (order_id INT, product_id INT, quantity INT NOT NULL, FOREIGN KEY (order_id) REFERENCES orders(order_id), FOREIGN KEY (product_id) REFERENCES product(product_id), PRIMARY KEY (order_id, product_id));