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
- install all the requirements: `$ composer install`
- run `$ php -S localhost:8000 -t public` enjoy start the server and enjoy

http://localhost:8000/location?location=sylhet
http://localhost:8000/hotels?checkin=15-04-2019&checkout=16-04-2019&adults=1&rooms=1&location=3&page=1&fbclid=IwAR1aCu09HDszd8iEuWI_i2NeluKFB3Gf1q-FRBM16VXVUwD0QYScDesSxI0
http://localhost:8000/hotel_info/14?checkin=15-04-2019&checkout=16-04-2019&adults=2&rooms=1&fbclid=IwAR3B7xT--R3n_RCdU6x3hvVDpnBUYOAW-0aSZAZOOAgf0GKulmI_YaGNbzM
