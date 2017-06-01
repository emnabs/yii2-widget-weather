<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2017
 * @package yii2-widgets
 * @subpackage yii2-widget-alert
 * @version 1.1.1
 */

namespace widgets\weather;

use Yii;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Alert widget extends the [[BsAlert]] widget with an easier configuration and additional styling options including
 * auto fade out.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Weather extends Widget {

    /**
     * Initializes the widget.
     */
    public $weatherTemplates = [
        'qing' => '<div class="sun"><div class="rays"></div></div>',
        'duoyun' => '<div class="cloud"></div><div class="cloud"></div>',
        'yin' => '<div class="cloud"></div><div class="cloud"></div>',
        'mai' => '<div class="haze"></div>',
        'wu' => '<div class="fog"></div>',
        'leiyu' => '<div class="cloud"></div><div class="lightning"><div class="bolt"></div><div class="bolt"></div></div>',
        'xue' => '<div class="cloud"></div><div class="snow"><div class="flake"></div><div class="flake"></div></div>',
        'xiaoyu' => '<div class="cloud"></div><div class="rain"></div>',
        'xiaoyuzhuanqing' => '<div class="cloud"></div><div class="sun"><div class="rays"></div><div class="rays"></div></div><div class="rain"></div>',
    ];

    /**
     * Initializes the widget.
     */
    public $weatherFunnyTips = [
        //04-05 凌晨 beforedawn
        'beforedawn' => '凌晨时分，注意别着凉，忙完快睡吧。',
        //06-08 早晨 morning
        'morning' => 'Good morning~ 哈哈，来这么早~',
        //09-12 上午 forenoon
        'forenoon' => '上午好，美好的一天开始了',
        //13-14 中午 noon
        'noon' => '中午吃饱喝足了，努力ing',
        //15-17 下午 afternoon
        'afternoon' => '下午犯困，不想加班就快点干活~看什么看',
        //18-19 傍晚 evening
        'evening' => '(^_^) 傍晚啦，都这点儿了，还不下班...',
        //20-22 晚上 night
        'night' => '晚上好，没猜错的话来加班的吧~',
        //23-03 深夜 latenight
        'latenight' => '已至深夜，还是要早点休息啊',
    ];

    /**
     * Initializes the widget.
     */
    public function init() {
        parent::init();
        $this->registerAssets();
        Html::addCssClass($this->options, 'sky');
        echo Html::beginTag('div', $this->options) . "\n";
    }

    /**
     * Renders the widget.
     */
    public function run() {
        echo "\n" . $this->renderBody();
        echo "\n" . Html::endTag('div');
        parent::run();
    }

    /**
     * Gets the title section
     *
     * @return string
     */
    protected function renderBody() {
        $content = '';
        $clouds = [
            'clouds_one',
            'clouds_two',
            'clouds_three',
        ];
        foreach ($clouds as $cloud) {
            $content .= Html::tag('div', '', ['class' => $cloud]) . "\n";
        }
        return $content .= Html::tag('div', '', ['class' => 'weather']) . "\n";
    }

    /**
     * Register the client assets for the [[Alert]] widget.
     */
    protected function registerAssets() {
        $view = $this->getView();
        WeatherAsset::register($view);

        $opts = Json::htmlEncode([
            'element' => $this->options['id'],
            'tpls' => $this->weatherTemplates,
            'funnyTips' => $this->weatherFunnyTips
        ]);
        $view->registerJs("Weather.init({$opts});");
    }

}
