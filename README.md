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

## Code Quality Tools

This project includes several Docker-based code quality tools accessible via Composer scripts. All tools run in isolated Docker containers and generate reports in the `src/logs/` directory.

### Available Quality Tools

#### Individual Tools

- **PHPLoc** - A tool for quickly measuring the size of a PHP project.

  ```bash
  cd src
  composer run quality:phploc
  ```

  Generates: `logs/phploc.txt`

  Generates: `logs/phpmd_results.xml`

- **PhpMetrics** - Static analysis with HTML reports
  ```bash
  cd src
  composer run quality:phpmetrics
  ```
  Generates: `logs/metrics_results/` (HTML report)

#### Run All Quality Checks

To execute all code quality tools at once:

```bash
cd src
composer run quality:all
```

### Prerequisites

1. **Docker**: All tools run in Docker containers using `adamculp/php-code-quality:latest`
2. **Logs Directory**: Create the logs directory first:
   ```bash
   mkdir -p src/logs
   ```

### Platform Notes

- **Apple Silicon Macs**: The Docker commands include `--platform linux/amd64` to avoid platform warnings
- **Intel/AMD64 systems**: The platform flag is included for consistency but not strictly necessary

### Other Quality Commands

- **Code Style Fixing**: `composer run cs:fix`
- **Code Style Linting**: `composer run cs:lint`
- **Local Static Analysis**: `composer run static-analyse` (uses local vendor)
- **Unit Tests**: `composer run tests`

All Docker-based quality tools exclude the `vendor` directory and provide detailed analysis reports for continuous code improvement.

### Application Setup

Clone the repository and run the following commands:

    git clone https://github.com/helmarluiz/fictional-social-media-backend-php.git
    cd fictional-social-media-backend-php

Copy .env.example to .env for the following directories:

    cp .env.example .env
    cp backend/.env.example backend/.env

Build images and start Docker Containers:

    docker-compose up -d --build
    docker exec php-news-backend /www/install-captainhook.sh

Wait for the containers to be up and running, then run the following command to populate the cache:

    docker exec php-news-backend php /var/www/backend/app/Commands/Cache.php

### Installing Git Hooks (CaptainHook)

After setting up the project, install the git hooks for code quality checks:

```bash
cd src
composer run install-hooks
```

This will install CaptainHook git hooks that will:

- Validate commit messages (conventional commits)
- Run PHP linting on staged files
- Execute code style fixes and checks
- Perform static analysis

The hooks will automatically run on every commit to ensure code quality.

# TODO:

    - [ ] Integrate PHPUnit with the mutation testing tool InfectionPHP, to validade all tests.
    - [ ] Improve code documentation.

# Running Tests and Code Quality

## Unit Tests

```bash
docker exec php-news-backend vendor/bin/phpunit
```

Or using composer scripts:

```bash
cd src
composer run tests
```

## Code Quality Analysis

For comprehensive code quality analysis, see the [Code Quality Tools](#code-quality-tools) section above. You can run individual tools or all quality checks at once:

```bash
cd src
composer run quality:all
```
