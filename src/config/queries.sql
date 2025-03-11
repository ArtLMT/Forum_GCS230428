-- Create Users table
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Module table
CREATE TABLE Modules (
    module_id INT PRIMARY KEY AUTO_INCREMENT,
    module_name VARCHAR(100) NOT NULL UNIQUE
);

-- Create Posts table: Lưu bài đăng, gắn với người dùng và module
CREATE TABLE Posts (
    post_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    module_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id), -- Link to user_id
    FOREIGN KEY (module_id) REFERENCES Modules(module_id) -- Link to module_id
);

-- create Comments: Lưu bình luận, hỗ trợ trả lời bài đăng hoặc bình luận khác
CREATE TABLE Comments (
    comment_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    parent_comment_id INT,
    content TEXT NOT NULL,
    create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id), -- Link to user
    FOREIGN KEY (post_id) REFERENCES Posts(post_id), -- Link to Post
    FOREIGN KEY (parent_comment_id) REFERENCES Comments(comment_id) -- To reply other comment
);

-- create Votes: Lưu lượt vote cho bài đăng hoặc bình luận
CREATE TABLE Votes (
    vote_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    post_id INT,
    comment_id INT,
    vote_type ENUM('up', 'down') NOT NULL,
    create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (post_id) REFERENCES Posts(post_id),
    FOREIGN KEY (comment_id) REFERENCES Comments(comment_id),
    CHECK ((post_id IS NOT NULL AND comment_id IS NULL) OR (post_id IS NULL AND comment_id IS NOT NULL))
);

INSERT INTO Modules (module_name) VALUES ('General');

INSERT INTO Users (username, email, password) VALUES ('firstuser', 'firstuser@example.com', 'password123');

INSERT INTO Posts (user_id, module_id, title, content) VALUES (
    (SELECT user_id FROM Users WHERE username = 'firstuser'),
    (SELECT module_id FROM Modules WHERE module_name = 'General'),
    'Testing',
    'This is a test post.'
);