
This application is built with Laravel and provides functionality to manage achievements and badges, along with relationships with users. The app is set up to use a RESTful API structure.


## Prerequisites

Ensure you have the following installed:
- **PHP >= 8.0**
- **Composer** (dependency manager for PHP)
- **MySQL** (or any other compatible SQL database)

---

## Installation

1. **Clone the repository**

    ```bash
    git clone https://github.com/MaryamMohamedAuf/Courses-Portal.git
    cd 34ml
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```


## Configuration

1. **Create a copy of the `.env` file**

    ```bash
    cp .env.example .env
    ```

2. **Generate an application key**

    ```bash
    php artisan key:generate
    ```

3. **Set up environment variables**

   Open the `.env` file in a text editor and configure the following settings for your local environment:

    ```dotenv
    APP_NAME=AchievementManagementApp
    APP_ENV=local
    APP_KEY=base64:generated_app_key_here
    APP_DEBUG=true
    APP_URL=http://localhost

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

## Database Setup

1. **Create the database**

   Create a new database in MySQL (or your preferred SQL database) for the application.

2. **Run migrations**

    This will create all necessary tables in the database.

    ```bash
    php artisan migrate
    ```

3. **Seed the database** 

    you can populate the database with sample data.

    ```bash
    php artisan db:seed
    ```

## Running the Application

1. **Start the development server**

    ```bash
    php artisan serve
    ```

   By default, the application will run at http://localhost:8000.



## Testing

To run tests for the application:

1. **Run feature and unit tests**

    ```bash
    php artisan test
    ```

   You can  run specific tests or test groups, depending on your configuration.

## API Endpoints

For information on using the API, refer to the documentation in the `docs` folder 
visit : http://localhost:8000/docs
or make API requests directly using tools like Postman.



