# StriveForAPlus

## Installation with Docker

Follow these steps to install the StriveForAPlus application using Docker:

1. **Clone the repository:**
    ```bash
    git clone https://github.com/Khairulbashar010/striveforaplus.git
    cd striveForAPlus
    ```

2. **Copy the `.env.example` file to `.env`:**
    ```bash
    cp .env.example .env
    ```

3. **Build and start the Docker containers:**
    ```bash
    docker compose up
    ```

4. **Access the docker container:**
    ```bash
    docker exec -it striveforaplus bash
    ```

5. **Install dependencies:**
    ```bash
    composer install
    ```

6. **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

7. **Run the database migrations:**
    Setup the environment keys before running migrate.
    ```bash
    php artisan migrate
    ```

8. **Seed the application:**
    ```bash
    php artisan db:seed --class=DatabaseSeeder
    ```

Your application should now be running at `http://localhost:8080`.

## License

The StriveForAPlus project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
