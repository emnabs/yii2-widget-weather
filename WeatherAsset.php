<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2017
 * @package yii2-widgets
 * @subpackage yii2-widget-alert
 * @version 1.1.1
 */

namespace widgets\weather;

use yii\web\AssetBundle;

/**
 * Asset bundle for the [[Alert]] widget.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class WeatherAsset extends AssetBundle {

    public $css = [
        'css/weather.min.css',
    ];
    public $js = [
        'js/sina.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init() {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }

}
