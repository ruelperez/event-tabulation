## Event Tabulation System

### Download and install the following tools:
- [XAMPP](https://www.apachefriends.org/download.html)
- IDE code editor such as
  [VS Code](https://code.visualstudio.com),
  [WebStorm](https://www.jetbrains.com/webstorm) or
  [Sublime Text](https://www.sublimetext.com).
- [Composer](https://getcomposer.org/download/)

### Installation

1. Clone or download this repository [event-tabulation](https://github.com/ruelperez/event-tabulation.git)
2. Create database name `event_tabulation`
3. Open the cloned project in your code editor.
4. Open terminal and execute the following commands:

#### Install Backend dependencies:
    composer install
#### Create Environment File:
    cp .env.example .env
#### Generate Application Key:
    php artisan key:generate
#### Run Migration:
    php artisan migrate
#### Serve the Application:
    php artisan serve

### Production
#### Admin Login
-   Access <http://127.0.0.1:8000/admin/login> in your web browser.
-   Register / Login your credential.

#### Judge Login
-   Access <http://127.0.0.1:8000/judge/login> in your web browser.
-   Login the credential you have Registered on Admin site.

### Technologies Used
#### Front-end
- [Laravel Livewire](https://laravel-livewire.com/)
- [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
- [Bootstrap](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
#### Back-end
- [Laravel](https://laravel.com/)
- [Laravel Livewire](https://laravel-livewire.com/)
