## Laravel Todo Application

Laravel Todo web application that allows users to create and manage their to-do lists. The application have the following features:

- Users can create an account and login/log out of the application.
- Users can create multiple to-do lists, each with a name and description.
- Users can add tasks to their to-do lists, each with a name, due date, and due time.
- Users can mark tasks as complete or incomplete.
- Users can edit or delete their to-do lists and tasks.
- Users can view a dashboard that displays all their to-do lists and tasks.
- Users can view a daily planner of tasks on the dashboard that is automatically categorized by the dates of the tasks, arranged in ascending order of the due times.
- In the event of a task is overdue the task are highlighted in a suitable manner. Users can reschedule overdue tasks. Once rescheduled the highlight for being overdue will be removed.

## Technical usage  

- The application is built using Laravel 10.x.
- Used Laravel's built-in authentication system ([Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze)) for user login and registration.
- Used Laravel's Eloquent ORM for database access.
- Use Bootstrap front-end framework for the user interface.

## Usage

## 1. Clone the Git repository

Open your terminal or command prompt and navigate to the directory where you want to clone the repository. Then run the following command:

git clone https://github.com/chanakaousl/todo.git

## 2. Install dependencies

To install the required dependencies, run the following command:

composer install

## 3. Create a .env file

You can create one by duplicating the .env.example file and rename it to .env

## 4. Generate the application key

Laravel requires an application key for encryption and other security-related features. Generate the application key by running the following command:

php artisan key:generate

## 5. Database Setup

This app uses MySQL. To use something different, open up config/Database.php and change the default driver.

To use MySQL, make sure you install it, setup a database and then add your db credentials(database, username and password) to the .env

## 6. Migrations

To create all the nessesary tables and columns, run the following command:

php artisan migrate

## 7. Running The App

npm install

npm run dev

php artisan serve

## License

The Todo app is open-sourced software licensed under the [MIT license](https://opensource.org/license/mit/).
