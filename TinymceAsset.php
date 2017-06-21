<?php
namespace kl83\tinymce;

class TinymceAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/tinymce/tinymce-dist';
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public function init()
    {
        $min = YII_DEBUG ? '' : '.min';
        $this->js = [
            "tinymce$min.js",
            "jquery.tinymce$min.js",
        ];
    }
}
