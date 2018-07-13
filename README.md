# PetFish Co

![Demo 1](/application/public/img/system/petfishco1.png)

![Demo 2](/application/public/img/system/petfishco2.png)

## Solution

- Phalcon PHP Framework used
- Front End and Back end is using PHP
- Front End interacts with the Back end with an HTTP Client
- Backend is a RESTfull API
- MVC and Repository Pattern Used ()

## Backend

- Repository Pattern ( Entities , Repositories , Services) to improve how business logic is managed.

## Frontend

- Front end is not using templating framework so this can be migrated to any other php framework


## Unit Test

- Unit test were built using Codeception and Mockery Framework.
- Run tests with codecept run unit tests/Unit/FishTest.php

![Unit Tests](/application/public/img/system/unittests.png)

## Database

Script can be found in ./application/petfish.sql

![Database](/application/public/img/system/petshopcodb.png)

## Set it up
- Docker needs to be installed in your machine
- Pull the repository
- Go to the repository folder using the terminal
- Execute docker-compose up -d (it will take a while)
- Navigate to localhost:8080 (phpmyadmin) and run petfish.sql script using phalcondb db.
- Navigate to localhost and ENJOY

## Future Work

- Api Authentication
- Improve Error Handling
- Increase Code Coverage







