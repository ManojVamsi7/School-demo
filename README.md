# School Management System

This is a PHP-based dynamic web application for managing students and classes in a school. The project allows users to add, view, edit, and delete student records and manage classes. The application also supports image uploads for students, with a user-friendly interface designed using Bootstrap and custom CSS.

## Features

- **Add Student**: Create a new student record with a name, email, address, class, and optional image.
- **View Student**: Display detailed information about a student, including their associated class and uploaded image.
- **Edit Student**: Modify existing student records with options to update all fields, including replacing the uploaded image.
- **Delete Student**: Remove student records from the database, with confirmation prompts.
- **Manage Classes**: Add, edit, and delete class records.
- **Responsive Design**: The user interface is mobile-friendly and adjusts to different screen sizes.

## Technologies Used

- **PHP**: Server-side scripting language to build the backend logic.
- **MySQL**: Database management system to store student and class data.
- **Bootstrap**: CSS framework for styling and responsive design.
- **HTML5 & CSS3**: For structuring and styling the front end.
- **JavaScript**: (Optional) For additional interactivity, if needed.
- **XAMPP**: Development environment to run Apache server and MySQL database locally.

## Installation and Setup

### Prerequisites

- **XAMPP** (or any local development environment with PHP and MySQL support)
- **Git** (optional, for version control)
- **Composer** (optional, for dependency management)

### Steps

1. **Clone the repository** to your local machine:
   ```bash
   git clone https://github.com/yourusername/school_demo.git
2. Move the project folder to your XAMPP's htdocs directory:
   ```bash
   mv school_demo /path/to/xampp/htdocs/
3. Start the XAMPP server and ensure both Apache and MySQL are running.
4. Create the database in MySQL:
-  Open phpMyAdmin (usually at http://localhost/phpmyadmin).
-  Create a new database named school_db.
-  Import the provided school_db.sql file to create the necessary tables and add sample data.
5. Update the database connection settings:
-  Open the db.php file and ensure the database credentials match your MySQL setup.
5. Access the application:
-  Open your web browser and navigate to http://localhost/school_demo.
