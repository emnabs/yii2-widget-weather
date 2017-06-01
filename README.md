# Yii2 Weather Widget

This extension contains a couple of useful widgets. The `Weather` widget extends the `\yii\bootstrap\Widget` widget with more easy styling and auto fade out options. 

[![Latest Stable Version](https://poser.pugx.org/emnabs/yii2-widget-weather/v/stable.png)](https://packagist.org/packages/emnabs/yii2-widget-weather)
[![Total Downloads](https://poser.pugx.org/emnabs/yii2-widget-weather/downloads.png)](https://packagist.org/packages/emnabs/yii2-widget-weather)
[![License](https://poser.pugx.org/emnabs/yii2-widget-weather/license.png)](https://packagist.org/packages/emnabs/yii2-widget-weather)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist emnabs/yii2-widget-weather "*"
```

or add

```json
"emnabs/yii2-widget-weather": "*"
```

to the require section of your composer.json.

## Usage

To use this widget, you have to add the codes in your page:

```php
use emhome\weather\Weather;

echo Weather::widget();
```

## License

**yii2-widget-weather** is released under the `BSD 3-Clause` License. See the bundled `LICENSE.md` for details.