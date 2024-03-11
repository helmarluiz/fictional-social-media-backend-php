# Headless Fictional Social Media

This project is a hands-on educational endeavor, emphasizing the use of PHP 8.1 without a framework, integrating best practices for software development. It serves as a showcase for clean code, automated testing, and continuous code quality monitoring.

## Sonar Status

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=helmarluiz_fictional-social-media-backend-php&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=helmarluiz_fictional-social-media-backend-php)

## Key Features

- **SonarQube Integration**: Utilizes SonarQube for continuous inspection of code quality to perform automatic reviews with static analysis to detect bugs, code smells, and security vulnerabilities.

- **GitHub Actions**: Employs GitHub Actions for Continuous Integration (CI) and Continuous Deployment (CD), enabling automated testing and deployment pipelines.

- **Automated Testing**: Implements unit and integration tests to ensure the reliability of the codebase, automatically run on every commit.

- **Docker Support**: Includes Docker configurations for containerization, allowing for consistent development environments and deployment.

- **Code Quality Hook**: Validate and prepare commit messages, ensure code quality and run unit tests before commit or push changes to git.

## Technologies & Libraries

- **PHP 8.1**: Utilizing the latest stable PHP version.
- **PHPUnit 9.5**: For comprehensive unit and feature testing.
- **Composer**: Dependency management tool.
- **php_codesniffer**: Ensures adherence to PSR-12 coding standards.
- **vlucas/phpdotenv**: Manages environment variables.

### Application Setup

Clone the repository and run the following commands:

    git clone https://github.com/helmarluiz/fictional-social-media-backend-php.git
    cd fictional-social-media-backend-php

Copy .env.example to .env for the following directories:

    cp .env.example .env
    cp backend/.env.example backend/.env

Build images and start Docker Containers:

    docker-compose up -d --build
    docker exec fsm-backend composer install
    docker exec fsm-backend /www/install-captainhook.sh

Wait for the containers to be up and running, then run the following command to populate the cache:

    docker exec fsm-backend php /var/www/backend/app/Commands/Cache.php

# TODO:

    - [ ] Integrate PHPUnit with the mutation testing tool InfectionPHP, to validade all tests.
    - [ ] Improve code documentation.

# Running tests

```
docker exec fsm-backend vendor/bin/phpunit
```
