# movies
This project is a schedule movie seeder that seeds the database with the movies

## Purpose
The user can select the time period between each seed, and the number of records saved each seed
The results are taken from "the movie database" [APIs](https://www.themoviedb.org/)

## Technologies
It uses:
	- Laravel 5.8
	- rest api design (passport)
	- laravel schedular

## Steps:
	- 1) user should login http://127.0.0.1:8000/api/user/login 
		- with email: user@user.com and password: 123456789
		- and get the user access token
	- 2) set the settings: http://127.0.0.1:8000/api/user/settings
		- a period: 
			- the period the server waits until it seeds the database again (in seconds and not less than a minute)
		- a number of records:
			- that will be stored in the database
	- 3) run the schedular: php artisan schedule:run
	- 4) sort movies:
		- http://127.0.0.1:8000/api/user/movies?rated=asc$popular=desc
	- 5) filtering
		- http://127.0.0.1:8000/api/user/filter?category_id=12