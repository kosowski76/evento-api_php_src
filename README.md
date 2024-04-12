  # Evento Api Php


  * [Technologies](#technologies)  
  * [Structure](#structure)  
  * [Setup](#setup)  


 ## Technologies
  <ul>
    <li>PHP 8.2, Symfony 7</li>
    <li>Mysql, Nginx, Redis</li>
    <li>Docker, Docker Compose</li>
  </ul>

 ## Description of concepts 

   This is an example REST API code created in the 'Symfony' framework
  and using the 'Domain Driven Design' DDD pattern.
   The domain of this example is to fetch a list of currency exchange tables
  from the NBP API of the National Bank of Poland for a specified number of days
  and then display it in the Json format.

   Retrieving Currency Exchange Tables is done using the commands
  of the 'Symfony:: ... ::Command' object in the console.
  This allows you to supervise in 'Workers' using 'Supervisor'
  and call at specific times using 'cron' for updates.

  I place applications in Docker containers to Kubernates
  for better scalability of the websites, services, microserives and etc.
  I manage Docker containers using 'Makefie' and 'bash' scripts.


  # Objective:

    Preparing a demo REST API
  using the 'Domain Driven Desin' DDD design pattern technique
  and running the application on GCP Google Cloud Platform

    Confirmation of knowledge and experience
  in use tools, techniques and patterns mentioned in this publication.

  
  Below is a list of the activities performed.


 ## 01. Introduction

### 01.01. Docker Symfony implement

  01. [x] Implement and test

  'Makefile' commands are executed outside Docker containers
   and run commands inside the containers

    $ make composer ARGS='require --dev "phpunit/phpunit"'
    $ cp appservice/.env.example appservice/.env

    $ make composer ARGS=install
    $ make composer ARGS="update --ignore-platform-req=ext-http"

    $ make test
    $ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/phpunit"

 ## 02. Development environment

### 02.01. Application architecture

 ### Structure

  01. [x] Folder Structure

  02. [x] Doctine schema definitions

  schema-update:

    $ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console doctrine:database:create --if-not-exists"
    $ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console doctrine:schema:update --force"

    $ make composer ARGS="require --dev orm-fixtures"
    $ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console doctrine:fixtures:load" 

### 02.02. Entity definitions

  01. [x] User

  02. [x] Event

  03. [x] Ticket

  04. [x] Change the namespaces and install logger.
        
### 02.03. Running Doctrine

  01. [x] Schema update

    $ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console doctrine:database:drop --force"
    $ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console doctrine:database:create --if-not-exists"

    $ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="bin/console doctrine:schema:drop --full-database --force"
    $ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console doctrine:schema:update --force"

  02. [x] Create some fixtures

    $ make composer ARGS="require --dev orm-fixtures"
    $ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console doctrine:fixtures:load"

  03. [x] Hexagonal Architecture and DDD elements

 ## 03. Security with JWT

### 03.01. Implement JWT

  01. [x] Setup for JWT
 
  02. [x] Installing logger

    $ make composer ARGS="require symfony/monolog-bundle"

  03. [x] Get the token and authenticate user

 ## 04. Application and Infrastructure

### 04.01. User registration

 ## 05. Exchange rate api

### 05.01. Doctrine repository mocking

  01. [x] Event repository test

  02. [x] Event repository functional testing

    // todo:

### 05.02. Exchange rate Entities and Doctrine

 ### Setup

  01. [x] Exchange Rates and repository test

$ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="bin/console doctrine:schema:drop --full-database --force"
$ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console doctrine:schema:update --force"

$ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console doctrine:fixtures:load"

$ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console app:fetch-exchanges"
$ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console app:fetch-exchanges 3"

$ make execute-in-container DOCKER_SERVICE_NAME="application" COMMAND="php bin/console app:fetch-rates"
