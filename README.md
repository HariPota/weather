# WEATHER CONSOLE TASK
### A simple console application for fetching the current weather for a given city
#### Requirements:
* PHP >= 8.0
* Composer

#### Docker guide

* Setup docker for linux
    * cd .docker
    * cp docker-compose.yml.linux.dist docker-compose.yml
    * cp .env.linux.dist .env
    
* Setup docker for macos
    * install docker-sync if you don't have one <br/> 
     ` brew install unison`<br/>
      `brew install eugenmayer/dockersync/unox`    
    * cd .docker
    * cp docker-compose.yml.macos.dist docker-compose.yml
    * cp .env.macos.dist .env
* Run for linux from .docker directory
    * make up
    * make composer install
* Run for macos from .docker directory
    * docker-sync start
    * make up  (after this step we need to wait until docker-sync finished coping files)
    * make composer install
    

#### Application setup
```cp .env .env.local```

set up your API key in the .env.local file 

#### How to use 
with docker: ```docker exec -ti weather_php bin/console london``` <br>
without docker: ```php bin/console london```

#### PHPUNIT 
with docker: ```docker exec -ti weather_php phpunit tests``` <br>
without docker: ```phpunit tests```
