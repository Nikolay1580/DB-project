    -- Table for Students
CREATE TABLE Students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    student_u INT UNIQUE,  -- unique identifier
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE  -- UNIQUE constraint for email
);

-- Table for Preferences
CREATE TABLE Preferences (
    preference_id INT AUTO_INCREMENT PRIMARY KEY,
    preference_u INT UNIQUE,  -- unique identifier
    is_clean BOOLEAN NOT NULL,
    is_loud BOOLEAN,  -- if the place is loud or not
    distance INT,
    social_life BOOLEAN  -- Boolean for social life preference
);

-- Table for Prefers (Mapping Preferences to Students)
CREATE TABLE Prefers (
    preference_id INT,
    student_id INT,
    FOREIGN KEY (preference_id) REFERENCES Preferences(preference_id),
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    PRIMARY KEY (preference_id, student_id)  -- Composite Primary Key
);

-- Table for Colleges
CREATE TABLE Colleges (
    college_id INT AUTO_INCREMENT PRIMARY KEY,
    college_u INT UNIQUE,  -- unique identifier
    name VARCHAR(255) NOT NULL,
    servery VARCHAR(255) NOT NULL  -- Servery information
);

-- Table for Blocks
CREATE TABLE Blocks (
    block_id INT AUTO_INCREMENT PRIMARY KEY,
    block_u INT UNIQUE,  -- unique identifier
    college_id INT,  -- Foreign key to Colleges table
    activity_level INT,  -- Integer representing how active the block is
    likelihood FLOAT,  -- Likelihood of various activities
    letter VARCHAR(1) NOT NULL,  -- Represents a label or identifier for the block
    is_clean BOOLEAN NOT NULL,  -- Boolean to indicate if the block is clean
    distance INT,  -- Represents distance information
    FOREIGN KEY (college_id) REFERENCES Colleges(college_id)
);

-- Table for Manager (is a Student)
CREATE TABLE Manager (
    manager_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,  -- Manager is also a student (foreign key from Students)
    manager_u INT UNIQUE,  -- unique identifier
    is_strict BOOLEAN NOT NULL,
    is_helpful BOOLEAN NOT NULL,
    FOREIGN KEY (student_id) REFERENCES Students(student_id)
);

-- Table for Blockmate (is a Student)
CREATE TABLE Blockmate (
    blockmate_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,  -- Blockmate is also a student (foreign key from Students)
    blockmate_u INT UNIQUE,  -- unique identifier
    block_id INT,  -- Blockmate lives in a block (foreign key from Blocks)
    friendliness_level INT,  -- Custom field for friendliness level
    noise_level INT,  -- Custom field for noise level
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    FOREIGN KEY (block_id) REFERENCES Blocks(block_id)
);

-- Relationship Table Lives_in (Maps Students to Blocks)
CREATE TABLE Lives_in (
    student_id INT,
    block_id INT,
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    FOREIGN KEY (block_id) REFERENCES Blocks(block_id),
    PRIMARY KEY (student_id, block_id)  -- Composite Primary Key to prevent duplicates
);

-- Relationship Table Works_for (Maps Manager to Colleges)
CREATE TABLE Works_for (
    manager_id INT,
    college_id INT,
    FOREIGN KEY (manager_id) REFERENCES Manager(manager_id),
    FOREIGN KEY (college_id) REFERENCES Colleges(college_id),
    PRIMARY KEY (manager_id, college_id)  -- Composite Primary Key
);

-- Table is_a_blockmate (Mapping Blockmates to Blocks)
CREATE TABLE is_a_blockmate (
    blockmate_id INT,
    block_id INT,
    FOREIGN KEY (blockmate_id) REFERENCES Blockmate(blockmate_id),
    FOREIGN KEY (block_id) REFERENCES Blocks(block_id),
    PRIMARY KEY (blockmate_id, block_id)  -- Composite Primary Key to avoid duplicates
);

-- Table is_a_manager (Mapping Managers to Students)
CREATE TABLE is_a_manager (
    manager_id INT,
    student_id INT,
    FOREIGN KEY (manager_id) REFERENCES Manager(manager_id),
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    PRIMARY KEY (manager_id, student_id)  -- Composite Primary Key
);

-- Table is_a_college (Mapping Students to Colleges)
CREATE TABLE is_a_college (
    student_id INT,
    college_id INT,
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    FOREIGN KEY (college_id) REFERENCES Colleges(college_id),
    PRIMARY KEY (student_id, college_id)  -- Composite Primary Key
);
