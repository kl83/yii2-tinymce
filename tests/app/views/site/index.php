<?php

use kl83\tinymce\TinymceWidget;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Test;

?>

<h3>Plain</h3>
<?= TinymceWidget::widget([
    'name' => 'test',
    'options' => [
        'class' => 'xxx',
    ],
]) ?>

<h3>Form</h3>
<?php
    $model = new Test;
    $model->load(Yii::$app->request->get());
    $form = ActiveForm::begin([ 'method' => 'get' ]);
    echo $form->field($model, 'content')->widget('kl83\tinymce\TinymceWidget', [
        'clientOptions' => [
            'toolbar' => 'link image',
            'plugins' => 'link image',
            'file_browser_callback' => new \yii\web\JsExpression("function(field_name, url, type, win) {
            }"),
        ],
    ]);
    echo Html::submitButton();
    ActiveForm::end();
