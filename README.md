## The technologies

This application is built with [PHP](https://www.php.com), and [PostgreSQL](https://https://www.postgresql.org/).

## The application
The application read XML files and insert them in database table.


## Project setup
```
composer update
```
The path to main folders with XML file and subfolders must be configure in config.ini file.
The database must be configure in config.ini file.

## Use

A new table in database will be created automatically.
When is insert button is clicked the new data is inserted in database. 
If a record from file already exist the app will update the date of the record and will not insert it as new one.
After insertion the new content will be displaied.
