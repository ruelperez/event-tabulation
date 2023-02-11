## Event Tabulation System

### Installation

1. Download and install [XAMPP](https://www.apachefriends.org/download.html).
2. Clone or download this repository [event-tabulation](https://github.com/ruelperez/event-tabulation.git)
3. Run `composer update`
4. Run `cp .env.example .env`
5. Run `php artisan key:generate`
6. Create database named `event_tabulation`
7. Run `php artisan migrate`
8. Run `php artisan serve`


### Admin Login
1. Open <http://127.0.0.1:8000/admin/login> in your web browser.
2. Register / Login your credential.

- In portion registration, do not input on `number of candidate to be rate` when portion name are `top 10`, `top 5`, `top 3`, and so on, because we can't use that portion to rate candidate.

### Judge Login
Open <http://127.0.0.1:8000/judge/login> in your web browser.
1.  Login the credential you have Registered on Admin site.

