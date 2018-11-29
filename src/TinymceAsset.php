<?php

namespace kl83\tinymce;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class TinymceAsset extends AssetBundle
{
    public $sourcePath = '@bower/tinymce-dist';
    public $js = [
        'tinymce.min.js',
        'jquery.tinymce.min.js',
    ];
    public $depends = [
        JqueryAsset::class,
    ];
}
