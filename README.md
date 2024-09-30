# SMOOL (Smart Management for Optimized Organization and Learning)

## Description

This is a comprehensive School Management System built with Laravel and Filament. It provides a robust platform for managing various aspects of a school, including classes, subjects, events, grades, and user profiles.

## Features

-   User authentication and authorization
-   Class and section management
-   Subject management
-   Event scheduling and announcements
-   Grading system
-   Custom pages
-   User profile management
-   Multi-language support (English and Amharic)
-   Attendance management
-   Timetable management
-   User-friendly interface

## Technologies Used

-   Laravel 11
-   Filament 3
-   PostgreSQL
-   Redis
-   Docker (with Laravel Sail)

## Installation

1. Clone the repository:

    ```
    git clone https://github.com/oddegen/SMOOL.git
    ```

2. Navigate to the project directory:

    ```
    cd SMOOL
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:

    ```
    cp .env.example .env
    ```

4. Install Sail:

    ```
    composer require laravel/sail --dev
    ```

5. Start Sail:

    ```
    ./vendor/bin/sail up
    ```

6. Run database migrations:

    ```
    ./vendor/bin/sail artisan migrate
    ```

## Docker Setup

This project includes a `docker-compose.yml` file for easy containerization. To use Docker:

1. Ensure Docker is installed on your system.
2. Run:
    ```
    ./vendor/bin/sail up
    ```

## Configuration

### Database

The project is configured to use PostgreSQL. Update the database configuration in your `.env` file.

### Mail

Configure your mail settings in the `.env` file. The project is set up to use SMTP by default.

## Usage

After installation, you can access the Filament admin panel at `/admin`. Create a user account and log in to start managing the school system.

## Testing

Run the test suite with:

```
php artisan test
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the MIT license.
