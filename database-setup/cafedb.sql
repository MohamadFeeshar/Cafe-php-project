CREATE DATABASE cafedb;

USE cafedb;

CREATE TABLE user (user_id INT AUTO_INCREMENT PRIMARY KEY, user_name VARCHAR(100), email VARCHAR(50), user_password VARCHAR(200), room VARCHAR(20), ext INT, user_type VARCHAR(10), profile_pic VARCHAR(200));

CREATE TABLE orders (order_id INT AUTO_INCREMENT PRIMARY KEY, order_status VARCHAR(20), order_date DATETIME, room VARCHAR(20), amount FLOAT, notes VARCHAR(300), user_id INT, FOREIGN KEY (user_id) REFERENCES user(user_id));

CREATE TABLE category (category_id INT AUTO_INCREMENT PRIMARY KEY, category_name VARCHAR(50));

CREATE TABLE product (product_id INT AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR(50), product_img VARCHAR(200), price FLOAT, category_id INT, FOREIGN KEY (category_id) REFERENCES category(category_id));

CREATE TABLE order_product (order_id INT, product_id INT, quantity INT, FOREIGN KEY (order_id) REFERENCES orders(order_id), FOREIGN KEY (product_id) REFERENCES product(product_id), PRIMARY KEY (order_id, product_id));