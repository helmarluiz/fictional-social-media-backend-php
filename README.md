# Headless Fictional Social Media

Project implemented for studies proposes, using PHP 8.1 without framework and the following technologies:

### Libs and tools used
    - PHP 8.1 - The latest PHP stable version.
    - PHPUnit 9.5 - Testing tool, used for Unit and Feature testing in this project.
    - Composer - For installing dependencies.
    - php_codesniffer - For PSR-12 code style validation.
    - vlucas/phpdotenv - For loading .env file variables.

### Application Setup
Clone the repository and run the following commands:

    git clone https://github.com/helmarluiz/fictional-social-media-backend-php.git
    cd fictional-social-media-backend-php


Copy .env.example to .env for the following directories:

    cp .env.example .env
    cp backend/.env.example backend/.env
    cp frontend/.env.example frontend/.env

Build images and start Docker Containers:

    docker-compose up -d --build

Wait for the containers to be up and running, then run the following command to populate the cache:

    docker exec fsm-backend php /var/www/backend/app/Commands/Cache.php

# TODO:
    - [ ] Implement all PSR-3 Logger Interface methods in Log class.
    - [ ] Implement support for other RESTful methods in the Http Client and in the Routing system (Only GET and POST supported for now).
    - [ ] Integrate PHPUnit with the mutation testing tool InfectionPHP, to validade all tests.
    - [ ] Improve code documentation.
  


# PHPUnit Test Results
