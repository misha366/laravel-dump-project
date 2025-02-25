# Laravel Dump Project

Dump Laravel project with implemented CRUD and ui, on which you can test different technologies

### How to strat locally?
1. Clone the repository `> git clone https://github.com/misha366/laravel-dump-project`

2. Create & fill `env/mysql.env`, `nginx.conf` & `src/.env` files 
<details>
  <summary>Important part of nginx.conf for vite dev server</summary>     
    server {
      ...

        # FOR VITE SERVER
        location /_vite/ {
            proxy_pass http://php:5173;
            proxy_set_header Host $host;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header Upgrade $http_upgrade;
            proxy_set_header Connection "Upgrade";
        }
      ...
    }
</details>

3. Build containers `> docker compose build`

4. Up containers `> docker compose up nginx -d`

5. Install composer dependencies `> docker compose run --rm composer install --optimize-autoloader`

6. Make migrations `> docker compose run --rm artisan migrate`

7. Run seeders `> docker compose run --rm artisan db:seed`

8. Open new console & run vite dev server `> docker compose exec php sh -c "npm run dev"`

9. Open `http://127.0.0.1:8000/` & enjoy the application

### Routes

#### **Main Page**
- `GET /` → **mainpage**  

#### **About**
- `GET /about` → **about**  

#### **Authentication**
- `GET /auth/login` → **AuthController@login**  
- `GET /auth/register` → **AuthController@register**  
- `GET /auth/profile` → **AuthController@profile**  
- `GET /auth/forgot-password` → **AuthController@forgotPassword**  
- `GET /auth/reset-password` → **AuthController@resetPassword**  
- `GET /auth/confirm-password` → **AuthController@confirmPassword**  
- `GET /auth/verify-email` → **AuthController@verifyEmail**  
- `GET /auth/two-factor-challenge` → **AuthController@twoFactorChallenge**  

#### **Posts**
- `GET /posts` → **PostController@index**  
- `POST /posts` → **PostController@store**  
- `GET /posts/create` → **PostController@create**  
- `GET /posts/{post}` → **PostController@show**  
- `PUT|PATCH /posts/{post}` → **PostController@update**  
- `DELETE /posts/{post}` → **PostController@destroy**  
- `GET /posts/{post}/edit` → **PostController@edit**  

### Technologies

#### **Frontend**
- [Vite](https://vitejs.dev/) `^5.0.0` – Fast build tool for modern web projects  
- [Bootstrap 5](https://getbootstrap.com/) `^5.3.3` – Responsive UI framework  
- [Bootstrap Icons](https://icons.getbootstrap.com/) `^1.11.3` – Icon set for Bootstrap  
- [Popper.js](https://popper.js.org/) `^2.11.8` – Tooltip and popover positioning  
- [tsparticles](https://github.com/matteobruni/tsparticles) `^3.8.1` – Particle animation library  
- [Axios](https://axios-http.com/) `^1.6.4` – Promise-based HTTP client  

#### **Backend**
- [PHP](https://www.php.net/) `^8.1` – Server-side scripting language  
- [Laravel](https://laravel.com/) `^10.10` – PHP framework for web applications
- [Guzzle](https://docs.guzzlephp.org/) `^7.2` – PHP HTTP client  
- [Laravel Tinker](https://laravel.com/docs/tinker) `^2.8` – REPL for Laravel applications  

##### **Development dependencies**
- [PHPUnit](https://phpunit.de/) `^10.1` – Unit testing framework  
- [FakerPHP](https://fakerphp.dev/) `^1.9.1` – Fake data generator for testing  
- [Mockery](https://github.com/mockery/mockery) `^1.4.4` – Mock object framework  
- [Laravel Pint](https://github.com/laravel/pint) `^1.0` – Code style fixer  
- [Spatie Laravel Ignition](https://spatie.be/docs/laravel-ignition) `^2.0` – Improved error handling  
- [Laravel Sail](https://laravel.com/docs/sail) `^1.18` – Docker environment for Laravel  

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
