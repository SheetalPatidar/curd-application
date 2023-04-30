# curd-application
simple CRUD application using PHP and MySQL

1. Requirements:
• PHP
• MySQL database (phpMyAdmin)
• Web server (e.g. Apache)

2. Start XAMPP (Apache and mySQL)

3. Setting up the database:
• Create a new MySQL database [name: php_form]
• Create a table [name: form_info] in the database with columns for id (autoincrement), name, email, phone, and address

4. Connecting to the database:
• In the PHP file, use PDO (PHP Data Objects) to connect to the MySQL database
File name: connect_db.php
• Set the database host, database name, username, and password in the PDO
object

5. Make a php form that takes user input
• File name: index.php

6. Make an table that show all the Users who fill the form, where you can edit and
delete the form details
• For edit , I used edit.php file , where you can edit your previous details and save
changes which get updated in database as well
• For delete I used ajax script and write a query in delete.php file

7. Database Schema
simple CRUD application using PHP and MySQL

8. View [RUN THE APPLICATION}
• Main Form ( http://localhost/curd_form_php/index.php )
• Table ( http://localhost/curd_form_php/table.php )
• Edit Form( http://localhost/curd_form_php/edit.php?id=20 )

9. Folder where I put my PHP files:
• C:\xampp\htdocs\curd_form_php
