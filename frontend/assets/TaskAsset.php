<?php
/**
 * Created by PhpStorm.
 * User: post.user14
 * Date: 17.06.2019
 * Time: 15:35
 */

namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class TaskAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.fancybox.min.css',
        'css/site.css'
    ];
    public $js =['js/jquery.fancybox.min.js'];
    public $depends = [
        JqueryAsset::class
    ];


}