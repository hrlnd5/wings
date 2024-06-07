# WINGS - TEST

## Requirements

- Apache
- PHP >= 8.0
- MySQL 8

## Installation

1. **Clone the Repository**  
   Clone this repository into your XAMPP `htdocs` directory.

   ```bash
   cd /path/to/XAMPP/htdocs
   git clone https://github.com/your-repo/project-name.git

   ```

2. **Configure Database**  
   Open the config.php file located in app/config/ directory and update the database configuration settings with your MySQL credentials.
3. **Import Database**  
   Open your MySQL and create database with name `penjualan` then import the `penjualan.sql`
4. **Start Apache and MySQL**  
   Open XAMPP and start the Apache and MySQL modules.
5. **Access the Application**  
   Open your web browser and navigate to http://localhost/wings/public.
