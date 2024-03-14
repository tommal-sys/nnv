# Recruitment task

## Overview
The Photo Upload System is designed to allow users to upload photos with a name and description, search for photos by name, and retrieve photo data by ID. This system automatically generates three versions of each uploaded photo to accommodate different use cases: a thumbnail version, a medium-sized version, and the original size.

## Features
- **Photo Upload:** Users can upload photos along with a name and description.
- **Photo Search:** Enables searching for photos by their name.
- **Retrieve Photo Data:** Allows fetching photo details using the photo's ID.

## System Rules
Every uploaded photo is processed to create:
1. A thumbnail version with dimensions of 100px by 100px.
2. A medium version with a maximum width of 300px, preserving the aspect ratio.
3. The original version, maintaining its original size.


## Setup and Installation

To set up the Photo Upload System, follow these steps:

1. Navigate to the server directory:
    ```bash
    cd Task.Server
    ```

2. Install dependencies using Composer:
    ```bash
    composer install
    ```

3. Copy the example environment file `.env.example` to create your own `.env` file. This is an example:
    ```bash
    cp .env.example .env
    ```

4. Generate an application key:
    ```bash
    php artisan key:generate
    ```

5. Update the `.env` file with your database configuration.

6. Run database migrations to create necessary tables:
    ```bash
    php artisan migrate
    ```

7. Start the Laravel development server:
    ```bash
    php artisan serve
    ```

8. Your application will be accessible at the URL provided by the artisan serve command.

After completing these steps, the Photo Upload System should be up and running, ready for use.

If you encounter any issues during the installation process, please refer to the Laravel documentation or feel free to ask for assistance.
