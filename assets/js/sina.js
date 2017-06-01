/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * (function () {
 var w = [];
 w['济南'] = [{s1: '晴', s2: '晴', f1: 'qing', f2: 'qing', t1: '33', t2: '21', p1: '3-4', p2: '3-4', d1: '北风', d2: '南风'}];
 var add = {now: '2017-06-01 13:00:07', time: '1496293207', update: '北京时间06月01日08:10更新', error: '0', total: '1'};
 window.SWther = {w: w, add: add};
 })();//0 
 */
var Weather = function () {
    var element;
    var tpls;
    var funnyTips;
    var formatData = function (obj, add) {
        if (add.error != '0' || !add.total) {
            return false;
        }
        var data = {};

        var keys = Object.keys(obj);
        var temp;
        $.each(keys, function (i, name) {
            data.city = name;
            temp = obj[name][0];
        });

        data.timestamp = add.time;
        data.datetime = add.now;
        data.update = add.update;

        var hour = new Date(add.now).getHours();

        if (hour >= 7 && hour < 19) {
            //白天天气取值1
            data.direction = temp.d1;
            data.substance = temp.s1;
            data.format = temp.f1;
            data.temperature = temp.t1;
            data.power = temp.p1;
        } else {
            //夜间天气取值2
            data.direction = temp.d2;
            data.substance = temp.s2;
            data.format = temp.f2;
            data.temperature = temp.t2;
            data.power = temp.p2;
        }

        data.daynight = formatInterval(hour);

        return data;
    };
    var formatInterval = function (hour) {
        var data = {};
        if (hour >= 4 && hour <= 5) {
            //04-05 凌晨 beforedawn
            data.class = 'beforedawn';
        } else if (hour >= 6 && hour <= 8) {
            //06-08 早晨 morning
            data.class = 'morning';
        } else if (hour >= 9 && hour <= 11) {
            //09-12 上午 forenoon
            data.class = 'forenoon';
        } else if (hour >= 12 && hour <= 13) {
            //13-14 中午 noon
            data.class = 'noon';
        } else if (hour >= 14 && hour <= 17) {
            //15-17 下午 afternoon
            data.class = 'afternoon';
        } else if (hour >= 18 && hour <= 19) {
            //18-19 傍晚 evening
            data.class = 'evening';
        } else if (hour >= 20 && hour <= 22) {
            //20-22 晚上 night
            data.class = 'night';
        } else {
            //23-03 深夜 latenight
            data.class = 'latenight';
        }
        data.text = funnyTips[data.class];
        return data;
    };
    //组合数组
    var initBuild = function () {
        var buildUrl = 'http://php.weather.sina.com.cn/iframe/index/w_cl.php';
        $.ajax({
            url: buildUrl,
            data: {
                code: 'js',
                day: 0,
                city: '',
                dfc: 1,
                charset: 'utf-8'
            },
            dataType: "script",
            success: function () {
                var weatherData = formatData(window.SWther.w, window.SWther.add);
                viewBox(weatherData);
            }
        });
    };
    var viewBox = function (weather) {
        var format = weather.format;
        var wt = '<div class="weather-icon">' + tpls[format] + '</div>';
        var content = wt + '<div class="weather-data"><span class="temperature">'
                + weather.temperature +
                '</span><span class="weather-data-text"><i class="symbol">℃</i><i class="substance">'
                + weather.substance +
                '</i><i class="wind">'
                + weather.direction + weather.power +
                '</i></span><span class="city">'
                + weather.city +
                '</span></div><h2 class="dan">'
                + weather.daynight.text +
                '</h2><p>'
                + weather.update +
                '</p>';
        element.addClass('sky-' + weather.daynight.class);
        element.find('.weather').html(content);
    };
    return {
        //main function to initiate the module
        init: function (options) {
            element = $('#' + options.element);
            if (element.size() == 0) {
                return;
            }
            tpls = options.tpls;
            funnyTips = options.funnyTips;
            initBuild();
        }
    };
}();
