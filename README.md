# WMS-Project-for-BS-CS-Final-year
This Project is for BS (CS) Final year students .
This Project is for BS (CS) Students of final year.
Project Name: Warehouse Management System


First Install Xamp
Then open xamp control panel and start Apache and MySQL.
Open Your pc default browser and search for the below link
http://localhost/phpmyadmin/index.php?route=/&reload=1
after that go to sql tag and type the below text
CREATE DATABASE wms_db;
USE wms_db;
click GO
after that open tag sql and type the below text one by one and click Go


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO users (username, password)
VALUES ('admin', MD5('admin123'));


CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    description TEXT,
    quantity INT NOT NULL,
    price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO inventory (item_name, description, quantity, price) VALUES
('Laptop', 'Dell Latitude', 25, 85000),
('Keyboard', 'Mechanical Keyboard', 12, 3500),
('Mouse', 'Wireless Mouse', 8, 2000),
('Monitor', '24 inch LED', 5, 30000);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES inventory(id) ON DELETE CASCADE
);


INSERT INTO orders (item_id, quantity) VALUES
(1, 2),
(3, 1),
(4, 1);


CREATE TABLE stock_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT,
    change_qty INT,
    action VARCHAR(50),
    action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES inventory(id)
);


and then move your all files to c/htdocs/wms_db
paste the files here and check the site using the beelow link maybe its change in your pc 
http://localhost/wms/index.php






if you face any problem checkout me on my email
sayyedtalhashah16336@gmail.com

and also avaible for making new projects for students not much expenvise.



Thanks Best Regards.
