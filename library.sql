CREATE TABLE admins (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE authors (
id INT AUTO_INCREMENT PRIMARY KEY,
author_name VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
id INT AUTO_INCREMENT PRIMARY KEY,
category_name VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE publishers (
id INT AUTO_INCREMENT PRIMARY KEY,
publisher_name VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE books (
id INT AUTO_INCREMENT PRIMARY KEY,
book_name VARCHAR(255) NOT NULL,
author_id INT,
category_id INT,
publisher_id INT,
isbn VARCHAR(100),
quantity INT DEFAULT 0,
description TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (author_id) REFERENCES authors(id),
FOREIGN KEY (category_id) REFERENCES categories(id),
FOREIGN KEY (publisher_id) REFERENCES publishers(id)
);

CREATE TABLE members (
id INT AUTO_INCREMENT PRIMARY KEY,
full_name VARCHAR(255) NOT NULL,
email VARCHAR(255),
phone VARCHAR(20),
address TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE issued_books (
id INT AUTO_INCREMENT PRIMARY KEY,
member_id INT NOT NULL,
book_id INT NOT NULL,
issue_date DATE NOT NULL,
due_date DATE NOT NULL,
status VARCHAR(50) DEFAULT 'Issued',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (member_id) REFERENCES members(id),
FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE returned_books (
id INT AUTO_INCREMENT PRIMARY KEY,
member_id INT NOT NULL,
book_id INT NOT NULL,
return_date DATE NOT NULL,
status VARCHAR(50) DEFAULT 'Returned',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (member_id) REFERENCES members(id),
FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE fines (
id INT AUTO_INCREMENT PRIMARY KEY,
member_id INT NOT NULL,
book_id INT NOT NULL,
fine_amount DECIMAL(10,2) DEFAULT 0.00,
payment_status VARCHAR(50) DEFAULT 'Pending',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (member_id) REFERENCES members(id),
FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE book_copies (
id INT AUTO_INCREMENT PRIMARY KEY,
book_id INT NOT NULL,
copy_number VARCHAR(100),
status VARCHAR(100) DEFAULT 'Available',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE notifications (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255),
message TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE reports (
id INT AUTO_INCREMENT PRIMARY KEY,
report_name VARCHAR(255) NOT NULL,
report_type VARCHAR(100),
report_date DATE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE activity_logs (
id INT AUTO_INCREMENT PRIMARY KEY,
admin_id INT,
action TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (admin_id) REFERENCES admins(id)
);

CREATE TABLE login_logs (
id INT AUTO_INCREMENT PRIMARY KEY,
admin_id INT,
login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (admin_id) REFERENCES admins(id)
);

CREATE TABLE library_settings (
id INT AUTO_INCREMENT PRIMARY KEY,
library_name VARCHAR(255),
theme VARCHAR(100),
logo VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reservations (
id INT AUTO_INCREMENT PRIMARY KEY,
member_id INT,
book_id INT,
reservation_date DATE,
status VARCHAR(50) DEFAULT 'Pending',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (member_id) REFERENCES members(id),
FOREIGN KEY (book_id) REFERENCES books(id)
);
CREATE TABLE payments (
id INT AUTO_INCREMENT PRIMARY KEY,
fine_id INT,
amount DECIMAL(10,2),
payment_date DATE,
payment_method VARCHAR(100),
status VARCHAR(50) DEFAULT 'Paid',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (fine_id) REFERENCES fines(id)
);

CREATE TABLE shelves (
id INT AUTO_INCREMENT PRIMARY KEY,
shelf_name VARCHAR(100) NOT NULL,
location VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE branches (
id INT AUTO_INCREMENT PRIMARY KEY,
branch_name VARCHAR(255) NOT NULL,
address TEXT,
phone VARCHAR(20),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE book_reviews (
id INT AUTO_INCREMENT PRIMARY KEY,
book_id INT,
member_id INT,
rating INT,
review TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (book_id) REFERENCES books(id),
FOREIGN KEY (member_id) REFERENCES members(id)
);

CREATE TABLE book_requests (
id INT AUTO_INCREMENT PRIMARY KEY,
member_id INT,
book_name VARCHAR(255),
author_name VARCHAR(255),
status VARCHAR(50) DEFAULT 'Pending',
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (member_id) REFERENCES members(id)
);
CREATE TABLE damaged_books (
id INT AUTO_INCREMENT PRIMARY KEY,
book_id INT,
damage_reason TEXT,
damage_date DATE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE lost_books (
id INT AUTO_INCREMENT PRIMARY KEY,
book_id INT,
member_id INT,
lost_date DATE,
fine_amount DECIMAL(10,2),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (book_id) REFERENCES books(id),
FOREIGN KEY (member_id) REFERENCES members(id)
);

CREATE TABLE contacts (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
email VARCHAR(255),
message TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE system_backup (
id INT AUTO_INCREMENT PRIMARY KEY,
backup_name VARCHAR(255),
backup_date DATE,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE book_history (
id INT AUTO_INCREMENT PRIMARY KEY,
book_id INT,
action VARCHAR(255),
action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (book_id) REFERENCES books(id)
);
INSERT INTO admins (username, password)
VALUES ('admin', 'admin123');

INSERT INTO library_settings (library_name, theme)
VALUES ('Library Management System', 'Dark');
INSERT INTO authors (author_name)
VALUES
('Premchand'),
('Chetan Bhagat'),
('J.K. Rowling');

INSERT INTO categories (category_name)
VALUES
('Programming'),
('Novel'),
('Science');

INSERT INTO publishers (publisher_name)
VALUES
('Penguin'),
('Oxford'),
('McGraw Hill');

INSERT INTO books
(book_name,author_id,category_id,publisher_id,isbn,quantity)
VALUES
('PHP Basics',1,1,1,'ISBN101',10),
('Java Programming',2,1,2,'ISBN102',15),
('Harry Potter',3,2,3,'ISBN103',8);
INSERT INTO members
(full_name,email,phone,address)
VALUES
('Nikhil Dewangan','nikhil@gmail.com','9876543210','Raipur'),
('Rahul Sharma','rahul@gmail.com','9999999999','Bilaspur');