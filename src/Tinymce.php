<?php

namespace kl83\tinymce;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Tinymce input widget
 */
class Tinymce extends InputWidget
{
    /**
     * @var array Js-options
     */
    public $clientOptions = [];

    private static $languageUrl;

    private function setLanguageUrlProperty()
    {
        $language = Yii::$app->language;
        if (
            !isset($this->clientOptions['language_url']) &&
            self::$languageUrl !== false &&
            $language &&
            $language != 'en-US'
        ) {
            if (self::$languageUrl === null) {
                $langAsset = LangAsset::register($this->view);
                $jsFile = str_replace('-', '_', $language) . '.js';
                if (file_exists($langAsset->sourcePath . '/' . $jsFile)) {
                    self::$languageUrl = $langAsset->baseUrl . '/' . $jsFile;
                } else {
                    $jsFile = substr($language, 0, 2) . '.js';
                    if (file_exists($langAsset->sourcePath . '/' . $jsFile)) {
                        self::$languageUrl = $langAsset->baseUrl . '/' . $jsFile;
                    } else {
                        self::$languageUrl = false;
                    }
                }
            }
            if (self::$languageUrl) {
                $this->clientOptions['language_url'] = self::$languageUrl;
            }
        }
    }

    private function registerJs()
    {
        $id = $this->options['id'];
        $options = Json::encode($this->clientOptions);
        $this->view->registerJs(
            'tinymce.remove("#' . $id . '");' .
            '$("#' . $id . '").tinymce(' . $options . ');'
        );
    }

    public function run()
    {
        TinymceAsset::register($this->view);

        $this->setLanguageUrlProperty();
        $this->registerjs();

        if ($this->hasModel()) {
            return Html::activeTextarea(
                $this->model,
                $this->attribute,
                $this->options
            );
        } else {
            return Html::textarea($this->name, $this->value, $this->options);
        }
    }
}
