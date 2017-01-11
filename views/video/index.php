<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_video',
            'descripcion',
            'url:url',
            'status',
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
              if ($action === 'view') {
                $url = yii\helpers\Url::to(['view', 'id' => $model->id_video]); // your own url generation logic
                return $url;
              }
              if ($action === 'delete') {
                $url = yii\helpers\Url::to(['delete', 'id' => $model->id_video]); // your own url generation logic
                return $url;
              }
            }
          ],
        ],
    ]); ?>
</div>
