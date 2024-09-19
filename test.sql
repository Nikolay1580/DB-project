CREATE TABLE Students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,

    --this part I added but should talk abt this later
    email VARCHAR(255) NOT NULL UNIQUE, -- Secondary key using UNIQUE for easier updates
    INDEX (email)  -- Creates an index on email as a secondary key
);


CREATE TABLE Preferences (
    preference_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT, -- Foreign Key to Students table
    is_clean BOOLEAN NOT NULL,
    is_loud BOOLEAN, --if the place is loud or not
    distance INT,
    social_life BOOLEAN,  -- Boolean for social life preference
    FOREIGN KEY (student_id) REFERENCES Students(student_id)
);


CREATE TABLE Questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    question_text VARCHAR(500) NOT NULL
);


CREATE TABLE College (
    college_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    servery VARCHAR(255) NOT NULL
);


CREATE TABLE Blocks (
    block_id INT AUTO_INCREMENT PRIMARY KEY,
    block_name VARCHAR(255) NOT NULL,
    college_id INT,  -- Foreign key to Colleges table
    activity_level INT,  -- Integer representing how active the block is
    likelihood FLOAT,  -- Changed likely_ness to likelihood for better naming
    letter VARCHAR(1) NOT NULL,  -- Represents a label or identifier for the block
    is_clean BOOLEAN NOT NULL,  -- Boolean to indicate if the block is clean
    distance INT,  -- Represents distance information
    FOREIGN KEY (college_id) REFERENCES College(college_id)
);


CREATE TABLE Results (
    result_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    block_id INT,
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    FOREIGN KEY (block_id) REFERENCES Blocks(block_id)
);


CREATE TABLE Manager (
    manager_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,  -- Manager is also a student (foreign key from Students)
    is_strict BOOLEAN NOT NULL,
    is_helpful BOOLEAN NOT NULL,
    FOREIGN KEY (student_id) REFERENCES Students(student_id)
);


CREATE TABLE Blockmate (
    blockmate_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,  -- Blockmate is also a student (foreign key from Students)
    block_id INT,  -- Blockmate lives in a block (foreign key from Blocks)
    friendliness_level INT,  -- Custom field for friendliness level
    noise_level INT,  -- Custom field for noise level
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    FOREIGN KEY (block_id) REFERENCES Blocks(block_id)
);


CREATE TABLE Kitchen (
    kitchen_id INT AUTO_INCREMENT PRIMARY KEY,
    block_id INT,  -- Kitchen belongs to a block (foreign key from Blocks)
    --check this part later
    availability BOOLEAN NOT NULL,  -- Whether the kitchen is available or not
    FOREIGN KEY (block_id) REFERENCES Blocks(block_id)
);

+
