# WEATHER CONSOLE TASK

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
```docker exec -ti weather_php bin/console london```

#### PHPUNIT 
```docker exec -ti weather_php phpunit tests```
