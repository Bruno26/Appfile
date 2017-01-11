<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="video-form">
  <div class="row">
    <div class="panel panel-success">
      <div class="panel-heading">Datos del Video</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
            <?php if (Yii::$app->session->hasFlash('error')): ?>
              <div class="alert alert-danger  alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= Yii::$app->session->getFlash('error') ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="row">
          <?php
          $form = ActiveForm::begin([
            "method" => "post",
            'enableClientValidation' => true,
            'options' => ['enctype' => 'multipart/form-data']
          ]);
          ?>
          <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <?php
            echo FileInput::widget([
              'attribute' => 'nameFile',
              'model' => $model,
              'pluginOptions' => [
                'initialPreviewAsData' => true,
                'initialPreviewFileType'=> 'image',
                'allowedPreviewTypes' => 'image',
                'showCaption' => true,
                'showRemove' => false,
                'showUpload' => false,
                'showMessage' => false,
                'browseClass' => 'btn btn-primary btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-film"></i> ',
                'browseLabel' => 'Cargar',
                'overwriteInitial' => true,
                'mainClass' => 'text-center',
                'allowedFileExtensions' => ["avi","mp4"],
                'previewFileType' => 'any'
              ],
              'options' => ['accept' => 'video/*']
            ]);
            ?>
          </div>
          <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

            <?php
            echo $form->field($model, 'status')->widget(Select2::classname(), [
              'data' => [1 => 'Active', 2=>'Inactive'],
              'options' => ['placeholder' => 'Select a state ...'],
              'pluginOptions' => [
                'allowClear' => true
              ],
            ]);
            ?>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 text-center">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
          </div>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
