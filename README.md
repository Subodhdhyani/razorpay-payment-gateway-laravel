This Laravel project enables making payments through Razorpay, storing payment details in the database, displaying them on the UI, and facilitating easy refund initiation.

After installing this Laravel project locally, follow these steps:

1) Get Razorpay API Credentials: Obtain key ID and key secret from the Razorpay dashboard.
2) Install Dependencies: Run composer install in the project directory via the command line.
3) Configure Environment: Duplicate .env.example to .env and set the following variables:
       RAZORPAY_KEY_ID=abc...
       RAZORPAY_KEY_SECRET=adb....
       DB_CONNECTION=mysql
       DB_DATABASE=razorpay
4) Execute php artisan key:generate in the terminal.
5) Execute php artisan migrate to create required database tables.
6) Start the development server using php artisan serve.
7) If required, install the Razorpay package by running:
       composer require razorpay/razorpay:2.*

