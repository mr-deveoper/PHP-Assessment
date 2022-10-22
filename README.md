
# PHP Assessment

# Description

Simple Multivendor shop built with  Laravel Framework

# Exercise

- Create a restful API for merchants where we can add new merchants or update/delete existing ones
- Merchants can also add their own products with the required price and update them in the future as well
- Merchants can also create multiple stores


# Requirements

- PHP `>= 8.0.2`
- MySQL `>=5.7`
- Composer installed
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension



## Installation

Clone the project or download it directly

```bash
  git clone https://github.com/mr-deveoper/PHP-Assessment.git
```

Go to the project directory

```bash
  cd PHP-Assessment
```

Install dependencies

```bash
  composer install
```

Activate Environment File

```bash
  cp .env.example .env
  php artisan key:generate
```

Add your DB variables in env

```bash
  change DB_CONNECTION , DB_DATABASE , DB_USERNAME , DB_PASSWORD 
```

Import Data

```bash
  php artisan migrate:refresh --seed 
```
 - Note : remove --seed if you don't want to import dummy data


Start the server

```bash
  php artisan serv
```


## Running Tests

To run tests, run the following command

```bash
  php artisan test
```


## Test APIs (Postman)

1- Import the postman collection from document below by clicking on `Run on Postman`

https://documenter.getpostman.com/view/2611633/2s84Dpw3DP

2- change the `url` variable in the base folder to your local api url

3- Run the Requests

- Note : please note that the data should depend on each other using id , you will find an examples for the data and default values


## Extra Features

- Simple frontend tables to view the models
- Unit Tests to test the aplication
- Dummy Data Seeders & Factories  
- Pagination & caching for more performance  
- Throttle & xss middleware for more security 

## Screenshots for Frontend view

![App Screenshot](https://i.ibb.co/HT1nCXz/image.png)

