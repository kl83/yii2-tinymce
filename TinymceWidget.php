<?php
namespace kl83\tinymce;

use Yii;
use yii\helpers\Html;
use \yii\helpers\Json;

class TinymceWidget extends \yii\widgets\InputWidget
{
    public $clientOptions = [];

    private function setLanguageUrlProperty()
    {
        $language = Yii::$app->language;
        if ( $language != 'en-US' && ! isset($this->clientOptions['language_url']) ) {
            $langAsset = LangAsset::register($this->view);
            $jsFile = str_replace('-', '_', $language).".js";
            if ( file_exists("$langAsset->sourcePath/$jsFile") ) {
                $this->clientOptions['language_url'] = "$langAsset->baseUrl/$jsFile";
            } else {
                $jsFile = substr($language, 0, 2).".js";
                if ( file_exists("$langAsset->sourcePath/$jsFile") ) {
                    $this->clientOptions['language_url'] = "$langAsset->baseUrl/$jsFile";
                }
            }
        }
    }

    public function run()
    {
        TinymceAsset::register($this->view);
        $this->setLanguageUrlProperty();

        $name = $this->name ? $this->name : Html::getInputName($this->model, $this->attribute);
        $value = $this->name ? $this->value : $this->model->{$this->attribute};

        $clientOptions = Json::encode($this->clientOptions);
        $this->view->registerJs("
            tinymce.remove('#$this->id');
            $('textarea#$this->id').tinymce($clientOptions);
        ");

        $this->options['id'] = $this->id;
        return Html::textarea($name, $value, $this->options);
    }
}
