# Stock plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require thurdelima/PluginStockCakePHP3X
```

Update your config/bootstrap.php.

```
Plugin::load('Stock', ['bootstrap' => false, 'routes' => true]);
```

Run migrations

```
bin/cake migrations migrate --plugin Stock
bin/cake migrations migrate --plugin Stock
```