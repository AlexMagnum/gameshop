<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/web/css/jquery-ui.css',    
        '/web/unitegallery/css/unite-gallery.css',
        '/web/unitegallery/themes/default/ug-theme-default.css',
        '/web/css/responsiveslides.css',
        '/web/css/main.css',

    ];
    public $js = [
        '/web/js/myFunctions.js',
        '/web/js/priceslider.js',
        '/web/js/jquery-ui.min.js',
        '/web/unitegallery/js/unitegallery.min.js',
        '/web/unitegallery/themes/default/ug-theme-default.js',
        '/web/js/responsiveslides.min.js',
        '//vk.com/js/api/openapi.js?139'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
