# Laravel Dump Project

Dump Laravel project with implemented CRUD and ui, on which you can test different technologies

### How to strat?
1. Clone the repository `> git clone https://github.com/misha366/laravel-dump-project`

2. Create & fill `env/mysql.env` & `src/.env` files 

3. Build containers `> docker-compose build`

4. Open mysql container bash (`> docker-compose exec mysql sh`)

    \-> open mysql util (`> mysql -uusername -ppassword`)
    
    \-> create a database for the project (`mysql> CREATE DATABASE your_database;`)

5. Make migrations `> docker-compose run --rm artisan migrate`

6. Run seeders `> docker-compose run --rm artisan db:seed`

7. Run nginx `> docker-compose up nginx -d` & enjoy the project

<details>
  <summary>Problems connecting to the MySQL container from the php container.</summary>
  
    
    Open the MySQL client in the MySQL container and run:
    
    CREATE USER 'root'@'%' IDENTIFIED BY 'password';
    GRANT ALL PRIVILEGES ON *.* TO 'root'@'%';
    
    Check connection in php container: > mariadb -h mysql -uroot -ppassword --skip-ssl

</details>

### Technologies
Frontend:
"dependencies": {
    "@popperjs/core": "^2.11.8",
    "@tsparticles/all": "^3.8.1",
    "bootstrap": "^5.3.3",
    "bootstrap-icons": "^1.11.3"
}

### Models & Seeders
```php
Post {
  bigint(20) pk unsigned id;
  string(225) title;
  text content;
  string(225) NULL image;
  tinyint(1) default(0) is_published;
  bigint(20) fk unsigned category_id;
  timstamp NULL deleted_at;
  timestamp NULL created_at;
  timestamp NULL updated_at;
}

> docker-compose run --rm artisan db:seed --class=PostSeeder
```

```php
Category {
  bigint(20) pk unsigned id;
  string(225) title;
  timestamp NULL created_at;
  timestamp NULL updated_at;
}

> docker-compose run --rm artisan db:seed --class=CategorySeeder
```

```php
Tag {
  bigint(20) pk unsigned id;
  string(225) title;
  timestamp NULL created_at;
  timestamp NULL updated_at;
}

> docker-compose run --rm artisan db:seed --class=TagSeeder
```


<i><small>If you have any problems with the launch or you see a controversial point in the code, you can always open an issue or write to me at misha.moskalenko.jv@gmail.com</small><i>
