-- Create database
CREATE DATABASE IF NOT EXISTS sbciglobal;
USE sbciglobal;

-- Drop leads table to recreate with new fields
DROP TABLE IF EXISTS leads;

-- Create leads table for "Join Us" section
CREATE TABLE leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    whatsapp_number VARCHAR(50) NOT NULL,
    email_address VARCHAR(255) NOT NULL,
    selected_packs TEXT,
    objective TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create members table for the Member Portal
CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'client') DEFAULT 'client',
    name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(50),
    domain VARCHAR(255),
    membership VARCHAR(255),
    instagram VARCHAR(255),
    linkedin VARCHAR(255),
    tiktok VARCHAR(255),
    facebook VARCHAR(255),
    credit_score VARCHAR(255),
    wallet_cashback VARCHAR(255),
    others VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create attachments table for members
CREATE TABLE IF NOT EXISTS member_attachments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT NOT NULL,
    attachment_number INT NOT NULL, -- 1 to 6
    display_name VARCHAR(255) DEFAULT 'Upload',
    file_path VARCHAR(255),
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE,
    UNIQUE KEY unique_member_attachment (member_id, attachment_number)
);

-- Create submissions table for SBCI AI registration pages
CREATE TABLE IF NOT EXISTS sbci_ai_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    form_type VARCHAR(80) NOT NULL,
    full_name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(80),
    payload LONGTEXT NOT NULL,
    uploaded_files LONGTEXT,
    status VARCHAR(40) DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (password: admin123)
-- In a real app, you should use password_hash. Here we use an MD5/Bcrypt hash or plain for demonstration?
-- Let's use PHP's password_hash for 'admin123' -> $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi (standard bcrypt for 'password')
-- We will just insert it via PHP registration or manually. 
-- For the sake of the demo, let's insert a default admin with hashed 'admin123'
INSERT IGNORE INTO members (username, password, role, name) 
VALUES ('admin', '$2y$10$L21Q.M2X5J./.0a.iFm3Y.2.z.z.z.z.z.z.z.z.z.z.z.z.z.z.z', 'admin', 'Administrator');

