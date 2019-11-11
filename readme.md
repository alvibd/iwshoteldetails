Donation
-----------------

Easy Installation
-----------------
**Requirements**
- Apache Server
- php >= 7
- PostgreSQL\MySQL
- composer

**Steps**
- Clone this repository: `$ git clone https://github.com/alvibd/iwshoteldetails.git` or download zip
- cd to project directory: `$ cd iwshoteldetails`
- create _.env_: `$ cp .env.example .env` for windows : `copy .env.example .env`
- set database configurations in _.env_
- set SSL_CERT to the file path of the cacert.pem in .env file
- install all the requirements: `$ composer install`
- run `$ php -S localhost:8000 -t public` enjoy start the server and enjoy
