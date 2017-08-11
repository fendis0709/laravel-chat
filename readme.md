## Laravel Web Framework

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

**[Read more about Laravel Framework](https://laravel.com/docs/)**

## **About Web Chat Application**

This application is use for creating chatting web application in **realtime**.
Instead using JQuery for set interval to get data on database chat, this application using web socket technology. <br><br>
You can test by log in on two or more account which open in different browser (eg: Google Chrome and Mozilla Firefox).<br><br> 
**This application is develop using Laravel 5.5 Dev. So, you have to install PHP 7.x**

## **Prerequisites**

This application was build using : 
- [Pusher API Key](https://dashboard.pusher.com)
- [Node JS](https://nodejs.org/en/download)
- [NPM](https://www.npmjs.com/get-npm)
- [Composer](https://getcomposer.org/download) (absolutely require since you create Laravel Project)
- [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git) (if you want to clone this project)

## **Intallation Guide**

- Make sure you have installed `git` on your own machine. You can download from [here](https://git-scm.com/downloads) or you can read documentation [here](https://git-scm.com/docs/gittutorial)
- Open your ***terminal*** for Linux or ***git scm*** for windows
- Move your pointer to htdoc directory
- Clone this repository. Run `git clone https://github.com/fendiseptiawan0709/laravel-chat.git` on your htdoc directory.
- Once you've clone this repository, you will get ***laravel-chat*** folder on your htdoc directory.
- Move your pointer to application folder or ***laravel-chat***
- If you using Linux OS, you have to change onwership and permission of ***storage*** and ***bootstrap*** directory. You only need to run this following command<br/> 
    - `sudo chown www-data -R bootstrap/ storage/`
    - `sudo chmod 775 -R bootstrap/ storage/`
- Create ***.env*** file from ***.env.example*** to root director of your application. If you using Linux OS, you can run `cp .env.example .env`
- Check artisan command by running `php artisan`. If you get list of artisan command, then you ready to go
- Run `php artisan key:generate`
- Open `.env` file, and edit database configuration correspond to your machine. <br>
    - DB_DATABASE=*\<your database name\>*
    - DB_USERNAME=*\<your mysql username, by default `root`\>*
    - DB_PASSWORD=*\<your mysql password, by default is empty\>*
    - BROADCAST_DRIVER=pusher
    - PUSHER_APP_ID=*\<pusher app id\>*
    - PUSHER_APP_KEY=*\<pusher app key\>*
    - PUSHER_APP_SECRET=*\<pusher app secret\>*
    - PUSHER_APP_CLUSTER=*\<pusher app cluster\>*
    - PUSHER_APP_ENCRYPTION=true
    > You can set `PUSHER_APP_ID`, `PUSHER_APP_KEY`, `PUSHER_APP_SECRET`, `PUSHER_APP_CLUSTER` from your [Pusher Application Dashboard](dashboard.pusher.com). Make sure you have been create application from pusher.
- Create authentication scaffolding by running `php artisan make:auth`. <br>
Make sure you've been create new database on your machine and set database name to `DB_DATABASE` on `.env` file
- To get updated vendor package, you need to run `composer update`. Make sure you've installed [*composer package*](https://getcomposer.org/download)
- And finally, visit **localhost/laravel-chat/public** on your web browser
- Optional, you can run web application on your php server. Run `php artisan serve`. Visit **localhost:8000** on your web browser

## Contact

If you have any trouble while installing or using this application, feel free to get in touch with me on :
- Email : [Fendi Septiawan](mailto:fendi.septiawan0709@gmail.com)
