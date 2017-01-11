<?php

namespace app\controllers;

use Yii;
use app\models\Video;
use app\models\search\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
* VideoController implements the CRUD actions for Video model.
*/
class VideoController extends Controller
{
  /**
  * @inheritdoc
  */
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
        ],
      ],
    ];
  }

  /**
  * Lists all Video models.
  * @return mixed
  */
  public function actionIndex()
  {
    $searchModel = new VideoSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  /**
  * Displays a single Video model.
  * @param integer $id
  * @return mixed
  */
  public function actionView($id)
  {
    return $this->render('view', [
    'model' => $this->findModel($id),
    ]);
  }

  /**
  * Creates a new Video model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return mixed
  */
  public function actionCreate(){
    $model = new Video();

    if ($model->load(Yii::$app->request->post()) ) {
      $model->attributes = $_POST['Video'];
      $image = UploadedFile::getInstance($model, 'nameFile');
      if(empty($image)){
          Yii::$app->getSession()->setFlash('error', 'Adjunte un video.' );
          return $this->render('create', [
            'model' => $model,
          ]);
      }else{
        // store the source file name
        $ext = end(explode(".", $image->name));
        $foto = Yii::$app->security->generateRandomString() . ".{$ext}";
        // ruta fisica del articulo
        $path = Yii::$app->basePath . '/web/movie/' . $foto;
        // ruta  que se guarda en la base de datos
        $model->url = 'movie/' . $foto;

        if ($model->save()) {
          $image->saveAs($path);
        }

        return $this->redirect(['view', 'id' => $model->id_video]);
      }

    } else {
      return $this->render('create', [
      'model' => $model,
      ]);
    }
  }

  /**
  * Updates an existing Video model.
  * If update is successful, the browser will be redirected to the 'view' page.
  * @param integer $id
  * @return mixed
  */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id_video]);
    } else {
      return $this->render('update', [
      'model' => $model,
      ]);
    }
  }

  /**
  * Deletes an existing Video model.
  * If deletion is successful, the browser will be redirected to the 'index' page.
  * @param integer $id
  * @return mixed
  */
  public function actionDelete($id)
  {
    $model = $this->findModel($id);
    $url = Yii::$app->basePath . '/web/' .$model->url;
    if($model->delete()){
      unlink($url);
    }



    return $this->redirect(['index']);
  }

  /**
  * Finds the Video model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param integer $id
  * @return Video the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */
  protected function findModel($id)
  {
    if (($model = Video::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }
}
