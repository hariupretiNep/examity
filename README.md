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
- Install PHP version ^8.0.2
- Install node version v16.17.0
- Run following command on project directory to install required dependencies
```php
composer install
npm install

//migration and seeder
php artisan migrate:fresh --seed
```

```Once you done with above steps, now it's time to run project locally```

```php
php artisan serve
npm run dev
    or
npm run build
```
Open the running host and port on your browser. Following is the default credentails of seeded admin.
```php
Email: admin@examity.com
Password: password
```

## Security Vulnerabilities

If you discover a security vulnerability within this appalication, please send an e-mail to Hari Upreti via [hariupreti1996@gmail.com](mailto:hariupreti1996@gmail.com). All security vulnerabilities will be promptly addressed.

