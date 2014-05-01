#php-boilerplate
A selection of projects to provide a good platform for new php applications.

##Features
* Based on [php-mvc](https://github.com/panique/php-mvc-advanced)
  * As the name says: MVC
  * Twig template engine
  * Composer
* [H5BP](https://github.com/h5bp/html5-boilerplate) for example view
* [Grunt](http://gruntjs.com/) for automatique [sass](http://sass-lang.com/)/[coffeescript](http://coffeescript.org/) compilation and js/css compression

##Installation
For this to run, you may need to install [composer](https://getcomposer.org/download/) and [grunt-cli](http://gruntjs.com/getting-started).
```
git clone https://github.com/Mawalu/php-boilerplate.git
cd php-boilerplate
composer install
npm install #For grunt and grunt plugins
grunt build
```
Now you have to edit the config file at `application/config/config.php`. There is an example called `config.php.dist` in the same location. Finally you can point your browser to the address / folder you installed everything. But watch out! Unlike php-mvc, we store our `index.php` within `public/`.

##Documentation
For general instructions and a very good tutorial see [here](https://github.com/panique/php-mvc-advanced).
####Grunt
During everyday developing you just have to call `grunt` without any parameters. This will start a `watch` task, which will recompile your `scss` and `coffee` files every time you change them.

##License
This project is licensed under MIT.
