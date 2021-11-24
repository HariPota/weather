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
```mkdir config/keys```

cp .env .env.local


#### Linters
    php -d memory_limit=8G vendor/bin/phpcbf --standard=Symfony -p src   --ignore=Migrations/,DataFixtures
    php -d memory_limit=8G vendor/bin/phpcs --standard=Symfony -p src   --ignore=Migrations/,DataFixtures
    php -d memory_limit=8G vendor/bin/phpmd src/ text ruleset.xml --exclude Entity,Repository,src/helpers.php,SignLegalDocument.php,Migrations,DataFixtures,src/Service/Datagrid,src/Service/Utils/QueryHelper,src/Service/DataFilter
    php -d memory_limit=8G vendor/bin/phpstan --memory-limit=8G analyse -l 6 -c phpstan.neon --no-progress src/
