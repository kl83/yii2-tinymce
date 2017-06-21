<?php
namespace app\models;

class Test extends \yii\base\Model
{
    public $content;

    public function rules()
    {
        return [
            ['content', 'string'],
        ];
    }
}
