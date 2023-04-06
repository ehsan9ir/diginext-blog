# Diginext Blog, Back-end Interview
**The project is Laravel back-end service for a simple blog for diginext interview task**

## Project setup with [Laravel Sail](https://laravel.com/docs/8.x/sail) for local dev environment :

1. Docker is installed in your system. If it is not installed according to the document, install Docker

2. Clone the repo and navigate to the directory
```shell
git clone https://github.com/ehsan9ir/diginext-blog.git
cd diginext-blog
```

3. Copy the sample .env file
```shell
cp .env.example .env
```

4. Enter the following command in the terminal to run project
    ```sh
   composer install
   ./vendor/bin/sail -f docker-compose-dev-sail.yml up -d
    ```

5. Database tasks
    1. To launch the project database, enter the following command in the terminal.
       ```
       ./vendor/bin/sail artisan migrate --force --seed
        ```
    2. phpmyadmin display link address :
       ```
       http://localhost:8081/
        ```
    3. Login information to the database :
       ```
        Server   :  db 
        Username :  next_admin
        Password :  admin123456
        ```
----
<span style="color:red">
The process of downloading Docker images due to sanctions and internet speed may be very slow or you may encounter various errors.
<br>
Use good stable vpn or the DNS iranian services
</span>

[Begzar](https://begzar.ir/)
or
[Shecan](https://shecan.ir/)
----

### Note
At the end of 2020, [Taylor Otwell](https://github.com/taylorotwell) released a package by the name of [Laravel Sail](https://laravel.com/docs/8.x/sail) that helps you get right into development without having to do any configuring of Docker.

### Build command for development environment

```shell
./vendor/bin/sail -f docker-compose-dev-sail.yml build
```

----
If the docker ports are busy, you can change the system ports in the .env file
For example, the :
```.dotenv
APP_PORT=81
```
finally, you must up again docker-compose-dev-sail.yml

---
