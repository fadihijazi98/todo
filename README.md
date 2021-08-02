
## Todo app
**@fadihijazi98**

Simple to-do application

**steps to setup**

- First Clone: git clone https://github.com/fadihijazi98/todo.git
- execute the commands:
    - `composer install`
    - `npm install`
    - `npm run dev`
    -  `cp .\.env.example .env`
    - `php artisan key:gen`
    - create database and update (DB_DATABASE, DB_USERNAME, DB_PASSWORD) config in .env
    - `php artisan migrate`
    - `php artisan db:seed`
- Now you can serve the project - '`php artisan serve`'

**application features**:

- login/register
- landing page
- validations
- CRUD Boards
- CRUD Tasks
- you can share your boards with others

**this project use**
- tailwindcss as a css framework
- vue js as a front-end framework
- PHP Laravel as  a back-end framework
- ...

**note: i used PHP unit test by Laravel to test CRUD for boards and tasks**

