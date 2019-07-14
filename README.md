# pidash

### Introduction
pidash is just a simple Symfony 4 application that lets you view all of your Raspberry PI data from anywhere (obviously you need an internet connection). It also includes a standby screen page to open on your Raspberry PI while not using it.

### Usage
```sh
$ git clone https://github.com/lucakermas/pidash.git
$ cd pidash
$ composer install
$ npm install
$ npm run build
$ ./bin/console server:run
```
The Symfony webserver should be up & running on `127.0.0.1:8000`.

### Todos
 - random greetings
 - PI-Overview (page to open on PI as "standby" screen)
 - multiple widgets to select from
 - easy widget adding
 - Make items arrangable
 - API for Raspberry PI data
 - pidash-client (Python3.7 sending data to website if wanted)
 - Multiple weather APIs to choose from
