# RecycleRoots

## Description

RecycleRoots is a web-based PHP Laravel application that aims to provide a simple, clear, and integrated information portal about the waste disposal facilities and processes of UK Local Authorities. Its purpose is to help boost recycling rates, reduce and reuse materials, and increase environmental education and sustainability awareness.

This prototype is part of my dissertation project at Buckinghamshire New University, which discusses the challenges and barriers of recycling in the UK and ways to increase recycling outputs to achieve the national recycling target of recycling 65% of municipal waste by 2035. RecycleRoots is a proposed solution, inspired by [Recycle Now](https://www.recyclenow.com) to help reduce confusion between different collection and recycling rules across the UK. This versions is a prototype using data from Buckinghamshire Council.

### Screenshots:
![Screenshot](https://github.com/tomas-ribeiro-pinto/RecycleRoots/blob/main/screenshots/home%20page.png)
![Screenshot](https://github.com/tomas-ribeiro-pinto/RecycleRoots/blob/main/screenshots/recycle.png)
![Screenshot](https://github.com/tomas-ribeiro-pinto/RecycleRoots/blob/main/screenshots/map.png)
![Screenshot](https://github.com/tomas-ribeiro-pinto/RecycleRoots/blob/main/screenshots/admin.png)
![Screenshot](https://github.com/tomas-ribeiro-pinto/RecycleRoots/blob/main/screenshots/bin%20rule.png)


## Getting Started

### Dependencies

* PHP Storm or any other IDE with Laravel installed: [https://laravel.com/docs/10.x/installation](https://laravel.com/docs/10.x/installation)
* Laravel 10.13.5
* MySQL 8.1
* PHP 8.1
* Server or local environment ready for deployment

### Executing program locally

* Change “.env_example” filename to “.env”
* Run, build the application's assets, and seed the app by executing the following commands:
```
php artisan serve
npm run dev
php artisan migrate --seed
```

> Please add the Mapbox API and other relevant connection details to the .env file to ensure correct functionality.


### Admin Credentials

Use these credentials to access the back office:

- Username: admin@admin.com
- Password: admin


The endpoint to register users is disabled, but you can add more through seeding/PHP Tinker.

Types of roles and permissions:
- Administrator (full permission)
- Blog Editor (only permission to edit the Blog section)


## Authors

Contributors names and contact info:

* Tomás Pinto - morato.toms@gmail.com

