<p align="center"><a href="https://github.com/hariupretiNep/examity" target="_blank"><img src="./public/assets/logo.png" width="200" alt="Examity Logo"></a></p>

## About Examity

Examity is a web application which is capable to handle online examination system. It is build on the top of Laravel framework with React Js on Tailwind CSS.

- Questionnaire generate on a single click.
- Invitation sent to student, once questionnaire generated
- Access test through mailed link.
- Seeder for generating admin, student and questionnaire with answers.

## Project Setup
- Clone the project from Master branch. [Master](https://github.com/hariupretiNep/examity)
- Copy .env.example to .env
- Install PHP version ^8.1.11
- Install node version v16.16.0
- Run following command on project directory to install required dependencies
```php
composer install
npm install

//migration and seeder
php artisan migrate:fresh --seed

//Listen for jobs
php artisan queue:listen
```

```Once you done with above steps, now it's time to run project locally```

```php
php artisan serve
npm run build
```
Open the running host and port on your browser. Following is the default credentails of seeded admin.
```php
Email: admin@examity.com
Password: password
```