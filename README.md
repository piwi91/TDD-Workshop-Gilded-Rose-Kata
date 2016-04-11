# TDD Workshop - Golden Rose Kata

Starting code for a Testing Code Kata on the Gilded Rose.
The language is PHP with [PHPUnit](https://phpunit.de/)

# Usage

Clone the code to your development machine with PHP or use [Docker](http://docker.com) to boot up a container.

Run `docker-compose build` to build the docker PHP 5.6 container and `docker-compose run application composer install` to install the dependencies with composer. Execute the tests with `docker-compose run application vendor/bin/phpunit`.

If you don't use docker, run the above commands without `docker-compose run application`.

# Credits

This Kata was originally created by [Terry Hughes](https://twitter.com/TerryHughes).
[Emily Bache](https://twitter.com/emilybache) translated it to a few other languages.
She wrote this article ["Writing Good Tests for the Gilded Rose Kata"](http://coding-is-like-cooking.info/2013/03/writing-good-tests-for-the-gilded-rose-kata/)
about how you could use this kata.
The original source of the kata is on [her GitHub page](https://github.com/emilybache/GildedRose-Refactoring-Kata).

### License ###
[New BSD License](http://opensource.org/licenses/bsd-license.php)
