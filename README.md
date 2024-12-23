# File Management System

A simple file management system built using **Vue.js**, **PHP**, and **MySQL**. This system supports uploading, previewing, and deleting CSV files while dynamically updating the file list.

---

## Features

- Upload CSV files with live preview in a tabular format.
- Dynamically display uploaded files with their metadata.
- Delete files with confirmation and auto-update of the file list.
- Backend built with PHP and MySQL.
- Frontend developed using Vue.js with Bootstrap for styling.

---

## Technologies Used

### Frontend
- Vue.js
- Axios (for API requests)
- Bootstrap 5 (for UI styling)

### Backend
- PHP
- MySQL
- XAMPP (for local development)

---

## Installation

### 1. Prerequisites
- [Node.js](https://nodejs.org/) (for Vue.js development)
- [XAMPP](https://www.apachefriends.org/) (for PHP and MySQL)
- Git (optional)

---

### 2. Setup Backend

1. Start XAMPP and enable **Apache** and **MySQL**.
2. Open phpMyAdmin at `http://localhost/phpmyadmin`.
3. Create a new database named `file_management`.
4. Import the SQL to create the `files` table:
   ```sql
   CREATE TABLE files (
       id INT AUTO_INCREMENT PRIMARY KEY,
       file_name VARCHAR(255) NOT NULL,
       file_path VARCHAR(255) NOT NULL,
       description TEXT,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );
5. Place the backend PHP files (db.php, upload.php, delete.php, files.php) in the C:\xampp\htdocs\file-management-api folder.

---

### 3. Setup Frontend
1. Clone this repository:
   ```bash
   git clone https://github.com/your-username/file-management-system.git
   cd file-management-system
2. Install dependencies:
   ```bash
   npm install
3. Start the development server:
   ```bash
   npm run serve
4. Access the app at http://localhost:8080.

---

### Usage
1. Upload a File
   * Navigate to the Upload CSV File page.
   * Select a CSV file and click Upload.
   * View the live preview of the CSV file before uploading.
2. View Uploaded Files
   * Go to the Uploaded Files page to view all uploaded files and their descriptions.
3. Delete a File
   * Click the Delete button next to a file to remove it from the server and database
   * The file list updates dynamically.

---

### Project Structure
'''bash
file-management-system/
├── backend/
│   ├── db.php
│   ├── upload.php
│   ├── delete.php
│   ├── files.php
├── frontend/
│   ├── src/
│   │   ├── components/
│   │   │   ├── FileList.vue
│   │   │   ├── UploadFile.vue
│   │   ├── router/
│   │   │   ├── index.js
│   │   ├── main.js
│   ├── public/
│   ├── package.json
│   ├── README.md

---

### API Endpoints
1. Fetch Files
   * Endpoint: GET /file-management-api/files.php
   * Response: Returns a list of uploaded files.
2. Upload File
   * Endpoint: POST /file-management-api/upload.php
   * Payload: A CSV file.
3. Delete File
   * Endpoint: DELETE /file-management-api/delete.php
   * Query Parameter: id (File ID).
  
---

### Contributing
Contributions are welcome! Feel free to open issues or submit pull requests. 
