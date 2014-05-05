#php-boilerplate
This started as a simple php boilerplate, based on [php-mvc](https://github.com/panique/php-mvc-advanced). Now its a small framework. But I can't think of a good name!

##Features
* Bundles
* MVC
* Composer
* Twig template engine
* [H5BP](https://github.com/h5bp/html5-boilerplate) for example view
* [Grunt](http://gruntjs.com/) for automatique [sass](http://sass-lang.com/)/[coffeescript](http://coffeescript.org/) compilation and js/css compression

##Installation
For this to run, you may need to install [composer](https://getcomposer.org/download/), [npm](https://www.npmjs.org/) and [grunt-cli](http://gruntjs.com/getting-started).
```
git clone https://github.com/Mawalu/php-boilerplate.git
cd php-boilerplate
composer install
npm install #For grunt and grunt plugins
grunt build
```
Now you have to edit the config file at `src/config/config.php`. There is an example called `config.php.dist` in the same location. If you want to see the example form php-mvc, run all .sql files in the `install/` folder. Finally you can point your browser to the address / folder you installed everything. You can reach the example application at `http://localhost/songs`

##Documentation
####Basics
All the code is located in the `src/` directory. There you see all the vendor directories. The examples are located in the `acme` folder. Every vendor directory has the same structure:
```
src/
|_acme/ #vendor name
  |_songs/ #project name
    |_controller/
    |_modles/
    |_views/
```
####Adding own code
Create a new folder as described in `Basic`. If this is the first project within this vendor name, go and register it in `composer.json`. Just add a line under `"acme": "src/"`.

####Routing
At the moment routing is very simple. We define one array in `src/config/routing.php`. But there are still a few things to know about routing.

 * When searching for a route, php-boilerplate will start with the full url and shorts it until it finds a matching route.
 * If a method is specified ( e.g. `acme\awesome\start:poney` ) php-boilerplate will call it. Otherwise it will call the the second url parameter as method ( e.g. `/home/poney/123` ). If this parameter doesn't exsist, it will call a method called `index`

####Grunt
During everyday developing you just have to call `grunt` without any parameters. This will start a `watch` task, which will recompile your `scss` and `coffee` files every time you change them. At the moment there are two other options for `grunt`:

* `grunt minimized` - Also starts a `watch` task, but will also minimize css and uglify js.
* `grunt build` - This will compile and compress everything once and end. It will not watch for changes.

##License
This project is licensed under MIT.
