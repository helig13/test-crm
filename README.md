<h1>Test CRM</h1>

Used stack: Laravel 10, Livewire 3, alpine.js, Mailtrap.io

<h2>Installation</h2>


Clone the Repository


    git clone https://helig13@github.com/helig13/test-crm.git
    cd test-crm

Install Dependencies



    composer install
    npm install

Set Up Environment File

Copy the .env.example file to create a .env file and configure your application settings, including database, mail, and other services.


    cp .env.example .env

Then, open .env and modify the environment settings for your development environment.
For example, change smtp to your smtp provider (mailtrap)

Generate Application Key



    php artisan key:generate

Run Migrations and Seeders 


    php artisan migrate
    php artisan db:seed  

Run the Server


    php artisan serve

