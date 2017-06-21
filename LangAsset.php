<?php
namespace kl83\tinymce;

class LangAsset extends \yii\web\AssetBundle
{
    public function init()
    {
        $this->sourcePath = __DIR__."/dist/langs";
    }
}
