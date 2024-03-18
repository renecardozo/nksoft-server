-- Create a new user with password (2)
create user admin_reservas with password 'anaiatuya@333';


-- Grant administrative privileges on the database (3)
GRANT ALL PRIVILEGES ON DATABASE reservas_db TO new_user;


-- Create a new database (1)
CREATE DATABASE reservas_db;