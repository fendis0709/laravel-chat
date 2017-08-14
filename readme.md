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

## **Installation Guide**

### Step 1 - Configure Web Application
- Clone this repository to your htdoc directory. Run `git clone https://github.com/fendiseptiawan0709/laravel-chat.git`.
- Once you've clone this repository, you will get ***laravel-chat*** folder on your htdoc directory.
- Change your directory to application folder or ***laravel-chat***
- If you are using Linux OS, you have to change ownership and permission of ***storage/*** and ***bootstrap/*** directory. You only need to run this following command<br/> 
    - `sudo chown www-data -R bootstrap/ storage/`
    - `sudo chmod 775 -R bootstrap/ storage/`
- To get updated vendor package, you need to run `composer update`. This will take several minutes depending on your internet connection. <br>
Make sure you've installed [*composer package*](https://getcomposer.org/download)
- Create ***.env*** file from ***.env.example*** to root directory of your application. <br>
If you are using Linux OS, you can run `cp .env.example .env`
- Check artisan command by running `php artisan`. <br>
If you get list of artisan command, then you ready to go
- Run `php artisan key:generate` to generate your application key.
- Open `.env` file, and edit database configuration correspond to your machine. <br>
    - `DB_DATABASE`=*\<your database name, create first if you don\'t have\>*
    - `DB_USERNAME`=*\<your mysql username, by default `root`\>*
    - `DB_PASSWORD`=*\<your mysql password, by default is empty\>*
- Create table into your new database by running `php artisan migrate`.<br>
Make sure you've been create new database on your machine and set database name to `DB_DATABASE` on `.env` file
    > This application have been create authentication scaffolding, so you don't have to run `php artisan make:auth`.
- To get updated Node JS package, run `npm update` <br>
This process take several minutes depending on your internet connection.<br>
Make sure you've installed [NPM](https://www.npmjs.com/get-npm) and [Node JS](https://nodejs.org/en/download)
- And finally, visit **localhost/laravel-chat/public** on your web browser
- Optional, you can run web application on your php server. Run `php artisan serve`. Visit **localhost:8000** on your web browser

### Step 2 - Configure Web Socket
You have been configure basic application. Now, you need to configure web socket for enable realtime feature on your application. <br>
You can select one of two method below. **If you beginner, I'd recommend you to use Pusher**<br>

#### 1. Pusher
**This method require internet connection**. So you need to connect on internet while running this application.<br>
Folow this step :
- [Login into pusher](https://dashboard.pusher.com/accounts/sign_in). If you don't have Pusher Account, you can [register here](https://dashboard.pusher.com/accounts/sign_up). It's FREE.
- Create new application
    - Give a name of your application
    - Select a cluster (Closest cluster to your location is better)
- After you create application, click **App Keys** tab.
- Now copy your credential information to : 
    - ***.env*** file.
        - `BROADCAST_DRIVER=pusher`
        - `PUSHER_APP_ID`=*\<pusher app id\>*
        - `PUSHER_APP_KEY`=*\<pusher app key\>*
        - `PUSHER_APP_SECRET`=*\<pusher app secret\>*
        - `PUSHER_APP_CLUSTER`=*\<pusher app cluster\>*
        - `PUSHER_APP_ENCRYPTION=true`
    - ***resources/assets/js/bootstrap.js*** file.
        - `pusherKey` = *\<pusher app key\>*
        - `pusherCluster` = *\<pusher app cluster\>*
- Don't forget to comment / remark the Laravel Echo Server Configuration code
- Now, you need to create webpack of your new configuration. Run `npm run dev`
- Finally. Test your application. Visit `http://192.168.7.238/laravel-chat/public` on your web browser.


#### 2. Socket IO
This method doesn't need internet connection. But **you need to run Laravel Echo Server**, close or stop process will shut down realtime feature.
Follow this step : 
- Open ***.env*** file, edit some value on :
    - `BROADCAST_DRIVER=redis`
    - `CACHE_DRIVER=redis`
    - `SESSION_DRIVER=redis`
- Record your IP address, cause we will need this to set as Server IP.
- Open ***laravel-echo-server.json*** file
- Edit `authHost` value corespond to your IP Address / Server IP. <br>
e.g `authHost : "http://192.168.7.238/laravel-chat/public"`<br>
Don't forget to save the file.
- Now open the ***resources/assets/js/bootstrap.js*** file. Set the value of some variables.
    - `socketPort` = *\<laravel echo server port, get it from `port` variable on laravel-echo-server.json \>*<br>
    e.g. : `socketPort = '6001'`;
    - `serverIP` = *\<your Server IP Address\>*<br>
    e.g. : `serverIp = '192.168.7.238'`
- Don't forget to comment / remark the Pusher Configuration code
- Now, you need to create webpack of your new configuration. Run `npm run dev`
- Start Laravel Echo Server service, run `laravel-echo-server start`
- Finally. Test your application, visit `http://<Server IP Address>/laravel-chat/public`.<br>
e.g. : `http://192.168.7.238/laravel-chat/public`

You can also change the IP address to `localhost`, so you can access using `localhost` (`http://localhost/laravel-chat/public`).<br>
**But I'm not recommend this way...**<br>
Why? Because if you set to `localhost` **you can only access it from your PC. You can't access it from other PC from the same network.** Your configuration will authenticate to `localhost` which is your PC, not the server.



## **Note**

> If you edit ***resources/assets/js/bootstrap.js***, you have to run `npm run dev` after you save the file. <br>
If you want to easier way, you can set NPM to automatically watch the change on bootstrap.js after you save the file by running `npm run watch --dev`

## Contact

If you have any trouble while installing or using this application, feel free to get in touch with me on :
- Email : [Fendi Septiawan](mailto:fendi.septiawan0709@gmail.com)
