# Laravel Demo
This is simple demo repository for laravel web application made with Laravel Framework 7.0 for new Laravel developer which includes demo of backend CMS with frontend with Vuejs. This repository contains demo implementation of Laravel policies, eloquent, Mailing, real time notification with laravel-echo-json with some example of feature tests.

# Setup
First of all copy .env.example to .env
```bash
cp .env.example .env
```
and change database, mail & redis configuration according to your setup

now add require packages with command (hope composer is already installed in your system)
```bash
composer install
```
Run migration with
```bash
php artisan migrate
```
Run seeder with
```bash
php artisan db:seed
```
now install to install package.json dependencies
```bash
npm install
```
Thats all for project setup

Now to bundle all dependencies with web pack into a single file
```bash
npm run dev
```
Since this project also includes demo for realtime notification with laravel-echo-server make sure redis is installed and is running in background.
Now install laravel-echo-server through npm globally.
```bash
npm i -g laravel-echo-server
```
after that in file named _laravel-echo-server.json_ which is in root of project change _authHost_ key's value and put your laravel application running host name or if you are running php artisan serve command http://127.0.0.1:8000.
Now, to run laravel-echo-server
```bash
laravel-echo-server start
```
your laravel echo server will run now.

# Testing
To run test first of all set test environment in .env
```dotenv
DB_TEST_DRIVER=mysql
DB_TEST_Database=test_db_name
```
and run

```bash
php artisan test
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
Released under the MIT License - see `LICENSE.txt` for details.


