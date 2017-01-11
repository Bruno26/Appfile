<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Video */

?>
<?php
$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-form">
  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">Datos del Video</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <video width="100%"  height="100%" controls>
              <source src="<?= Yii::$app->homeUrl.$model->url ?>" type="video/mp4" >
            </video>

          </div>

          <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                  <label>Nombre: </label> <?= $model->nombre ?>
              </div>
              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                  <label>Descripción: </label> <?= $model->descripcion ?>
              </div>
              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <div class="form-group">
                  <label for="">Comparte:</label>
                  <textarea  readonly='readonly' class="form-control" rows="5" id="comment">
                    <iframe width="560" height="315"
                    src="<?=  Yii::$app->getRequest()->serverName.Yii::$app->homeUrl.$model->url ?>"
                    frameborder="0" allowfullscreen></iframe>
                  </textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
