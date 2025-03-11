# Database Files for CafeBlog

This folder contains SQL files related to the `CafeBlog` project. These files are used for setting up and managing the application's database.

## Files Included

- **cafeblog.sql**  
  This file contains the SQL dump for creating the `cafeblog` database, including tables, relationships, and sample data.

## Usage

1. **Importing the Database**  
   If you need to import the database, run the following command in your terminal:

   ```bash
   mysql -u root -p cafeblog < /path/to/cafeblog.sql

2. Exporting the Database
    To export the current state of the cafeblog database, use:

    ```bash
    mysqldump -u [username] -p cafeblog > /path/to/cafeblog.sql

3. Database Configuration
    Make sure the application/config/database.php file is configured with the correct database name (cafeblog), username, and password.