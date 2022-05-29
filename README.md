[![PHP CI](https://github.com/ForeachQ/task-manager/actions/workflows/php-ci.yml/badge.svg)](https://github.com/ForeachQ/task-manager/actions/workflows/php-ci.yml)
<a href="https://codeclimate.com/github/Foreachq/php-project-lvl4/maintainability"><img src="https://api.codeclimate.com/v1/badges/6ddb408357da67cbb956/maintainability" /></a>
<a href="https://codeclimate.com/github/Foreachq/php-project-lvl4/test_coverage"><img src="https://api.codeclimate.com/v1/badges/6ddb408357da67cbb956/test_coverage" /></a>

# Task Manager

«Task Manager» — a site where you can manage your tasks.

## Demo

Project demo can be viewed [<ins>**here**</ins>](https://foreachq-task-manager.herokuapp.com/).

## Description

Application is build in the form of a site where you can add tasks, assign performers, change task statuses and labels. Registration and authentication are required to work with the system.

Project features:
- Authentication, policy management;
- Multilingual support;
- Task statuses, labels and filtering;
- PostgreSQL storage for added entities, in-memory sqlite for tests;
- PHPUnit testing;
- Docker containerization for easy to run local instances.

## Requirements

- docker-compose

## Installation

- Download package

Using git clone:

``` bash
git clone https://github.com/Foreachq/task-manager
```

Or using composer:

``` bash
composer create-project foreachq/task-manager
```

- Setup project

``` bash
make setup
```

- Run local instance

``` bash
make up   # starting on localhost:80
```

- Stop local instance

``` bash
make down
```
