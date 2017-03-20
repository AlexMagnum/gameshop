<?php

namespace app\modules\admin\controllers;

use app\models\Language;
use Yii;
use app\models\Games;
use app\models\Gamegenre;
use app\models\Osgame;
use app\models\Gamelanguage;
use app\models\Gameplatform;
use app\models\Gamemode;
use app\models\Gamemedia;
use app\models\UploadFileForm;
use app\models\UploadFilesForm;
use app\models\Sliderimg;
use app\models\Syswindows;
use app\models\Sysmac;
use app\models\Syslinux;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

class GamecrudController extends Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update', 'index', 'create', 'view', 'delete', 'logout'],
                        'roles' => ['admin', 'redactor'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Games::find(),
        ]);

        $dataProvider->pagination->pageSize = 10;
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Games();
        $modelgenre = new Gamegenre();
        $modelos = new Osgame();
        $modellanguage = new Gamelanguage();
        $modelplatform = new Gameplatform();
        $modelmode = new Gamemode();
        $modelmedia = new UploadFileForm();
        $modelmedias = new UploadFilesForm();
        $modelvideo = new Gamemedia();
        $modelslideimg = new Sliderimg();
        $modelwin = new Syswindows();
        $modelmac = new Sysmac();
        $modellin = new Syslinux();

        
        if ($model->load(Yii::$app->request->post()) &&
            $modelgenre->load(Yii::$app->request->post()) &&
            $modelos->load(Yii::$app->request->post()) &&
            $modellanguage->load(Yii::$app->request->post()) &&
            $modelplatform->load(Yii::$app->request->post()) &&
            $modelmode->load(Yii::$app->request->post()) &&
            $modelmedia->load(Yii::$app->request->post()) &&
            $modelvideo->load(Yii::$app->request->post()) &&
            $modelmedias->load(Yii::$app->request->post()) &&
            $modelwin->load(Yii::$app->request->post()) &&
            $modelmac->load(Yii::$app->request->post()) &&
            $modellin->load(Yii::$app->request->post())
        ) {
            $model->save(false);

            $modelgenre->fk_game_id = $model->id;
            $modelos->fk_game_id = $model->id;
            $modellanguage->fk_game_id = $model->id;
            $modelplatform->fk_game_id = $model->id;
            $modelmode->fk_game_id = $model->id;

            $genre = $modelgenre->fk_genre_id;

            foreach ($genre as $g) {

                Yii::$app->db->createCommand()->insert('gs_gamegenre', ['fk_game_id' => $model->id,
                    'fk_genre_id' => $g])->execute();
            }
            $modelgenre->save();

            $os = $modelos->fk_os_id;
            foreach ($os as $o) {

                Yii::$app->db->createCommand()->insert('gs_osgame', ['fk_game_id' => $model->id,
                    'fk_os_id' => $o])->execute();
            }
            $modelos->save();

            $languages = $modellanguage->fk_language_id;
            foreach ($languages as $l) {

                Yii::$app->db->createCommand()->insert('gs_gamelanguage', ['fk_game_id' => $model->id,
                    'fk_language_id' => $l])->execute();
            }
            $modellanguage->save();

            $platform = $modelplatform->fk_platform_id;
            foreach ($platform as $p) {

                Yii::$app->db->createCommand()->insert('gs_gameplatform', ['fk_game_id' => $model->id,
                    'fk_platform_id' => $p])->execute();
            }
            $modelplatform->save();

            $mode = $modelmode->fk_mode_id;
            foreach ($mode as $m) {

                Yii::$app->db->createCommand()->insert('gs_gamemode', ['fk_game_id' => $model->id,
                    'fk_mode_id' => $m])->execute();
            }
            $modelmode->save();

            $modelmedia->imageFile = UploadedFile::getInstance($modelmedia, 'imageFile');
            if ($modelmedia->upload($model->meta_title)) {
                $modelvideo->poster_img = $modelmedia->imageFile->baseName . '.' . $modelmedia->imageFile->extension;
                $modelvideo->game_id = $model->id;
                $modelvideo->save();
            }

            $modelmedias->imageFiles = UploadedFile::getInstances($modelmedias, 'imageFiles');
            if ($modelmedias->upload($model->meta_title)) {
                foreach ($modelmedias->imageFiles as $file) {
                    Yii::$app->db->createCommand()->insert('gs_sliderimg', ['img' => $file->baseName . '.' . $file->extension,
                        'game_id' => $model->id])->execute();
                }
                $modelslideimg->save();
            }

            if ((!empty($modelwin->os)) || (!empty($modelwin->cpu)) ||
                (!empty($modelwin->ram)) || (!empty($modelwin->videocard)) ||
                (!empty($modelwin->hdd)) || (!empty($modelwin->directx))
            ) {
                $modelwin->game_id = $model->id;
                $modelwin->save();
            }

            if ((!empty($modelmac->os)) || (!empty($modelmac->cpu)) ||
                (!empty($modelmac->ram)) || (!empty($modelmac->videocard)) ||
                (!empty($modelmac->hdd))
            ) {
                $modelmac->game_id = $model->id;
                $modelmac->save();
            }

            if ((!empty($modellin->os)) || (!empty($modellin->cpu)) ||
                (!empty($modellin->ram)) || (!empty($modellin->videocard)) ||
                (!empty($modellin->hdd)) || (!empty($modellin->soundcard))
            ) {
                $modellin->game_id = $model->id;
                $modellin->save();
            }

            return $this->redirect(['view', 'id' => $model->id,]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelgenre' => $modelgenre,
                'modelos' => $modelos,
                'modellanguage' => $modellanguage,
                'modelplatform' => $modelplatform,
                'modelmode' => $modelmode,
                'modelmedia' => $modelmedia,
                'modelvideo' => $modelvideo,
                'modelmedias' => $modelmedias,
                'modelwin' => $modelwin,
                'modelmac' => $modelmac,
                'modellin' => $modellin
            ]);
        }

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelgenre = new Gamegenre();
        $modelos = new Osgame();
        $modellanguage = new Gamelanguage();
        $modelplatform = new Gameplatform();
        $modelmode = new Gamemode();
        $modelmedia = new UploadFileForm();
        $modelmedias = new UploadFilesForm();
        $modelvideo = Gamemedia::findOne(['game_id' => $id]);
        $modelslideimg = new Sliderimg();

        if (Syswindows::findOne(['game_id' => $id]))
            $modelwin = Syswindows::findOne(['game_id' => $id]);
        else
            $modelwin = new Syswindows();

        if (Sysmac::findOne(['game_id' => $id]))
            $modelmac = Sysmac::findOne(['game_id' => $id]);
        else
            $modelmac = new Sysmac();

        if (Syslinux::findOne(['game_id' => $id]))
            $modellin = Syslinux::findOne(['game_id' => $id]);
        else
            $modellin = new Syslinux();
        


        if ($model->load(Yii::$app->request->post()) &&
            $modelgenre->load(Yii::$app->request->post()) &&
            $modelos->load(Yii::$app->request->post()) &&
            $modellanguage->load(Yii::$app->request->post()) &&
            $modelplatform->load(Yii::$app->request->post()) &&
            $modelmode->load(Yii::$app->request->post()) &&
            $modelmedia->load(Yii::$app->request->post()) &&
            $modelvideo->load(Yii::$app->request->post()) &&
            $modelmedias->load(Yii::$app->request->post()) &&
            $modelwin->load(Yii::$app->request->post()) &&
            $modelmac->load(Yii::$app->request->post()) &&
            $modellin->load(Yii::$app->request->post())
        ) {
            $model->save(false);

            $genre = $modelgenre->fk_genre_id;

            Yii::$app
                ->db
                ->createCommand()
                ->delete('gs_gamegenre', ['fk_game_id' => $id])
                ->execute();

            foreach ($genre as $g) {
                Yii::$app->db->createCommand()->insert('gs_gamegenre', ['fk_game_id' => $model->id,
                    'fk_genre_id' => $g])->execute();
            }
            $modelgenre->save();

            $os = $modelos->fk_os_id;

            Yii::$app
                ->db
                ->createCommand()
                ->delete('gs_osgame', ['fk_game_id' => $id])
                ->execute();

            foreach ($os as $o) {
                Yii::$app->db->createCommand()->insert('gs_osgame', ['fk_game_id' => $model->id,
                    'fk_os_id' => $o])->execute();
            }
            $modelos->save();

            $languages = $modellanguage->fk_language_id;

            Yii::$app
                ->db
                ->createCommand()
                ->delete('gs_gamelanguage', ['fk_game_id' => $id])
                ->execute();

            foreach ($languages as $l) {

                Yii::$app->db->createCommand()->insert('gs_gamelanguage', ['fk_game_id' => $model->id,
                    'fk_language_id' => $l])->execute();
            }
            $modellanguage->save();

            $platform = $modelplatform->fk_platform_id;

            Yii::$app
                ->db
                ->createCommand()
                ->delete('gs_gameplatform', ['fk_game_id' => $id])
                ->execute();

            foreach ($platform as $p) {

                Yii::$app->db->createCommand()->insert('gs_gameplatform', ['fk_game_id' => $model->id,
                    'fk_platform_id' => $p])->execute();
            }
            $modelplatform->save();

            $mode = $modelmode->fk_mode_id;

            Yii::$app
                ->db
                ->createCommand()
                ->delete('gs_gamemode', ['fk_game_id' => $id])
                ->execute();

            foreach ($mode as $m) {

                Yii::$app->db->createCommand()->insert('gs_gamemode', ['fk_game_id' => $model->id,
                    'fk_mode_id' => $m])->execute();
            }
            $modelmode->save();


            $modelmedia->imageFile = UploadedFile::getInstance($modelmedia, 'imageFile');
            if (!empty($modelmedia->imageFile)) {
                unlink(dirname(__FILE__) . "../../" . $modelvideo->img_main);
                if ($modelmedia->upload($model->meta_title)) {
                    $modelvideo->poster_img = $modelmedia->imageFile->baseName . '.' . $modelmedia->imageFile->extension;
                    $modelvideo->game_id = $model->id;
                    $modelvideo->save();
                }
            }
            else{
                $modelvideo->save();
            }

            $modelmedias->imageFiles = UploadedFile::getInstances($modelmedias, 'imageFiles');
            if (!empty($modelmedias->imageFiles)) {
                Yii::$app
                    ->db
                    ->createCommand()
                    ->delete('gs_sliderimg', ['game_id' => $id])
                    ->execute();
                if ($modelmedias->upload($model->meta_title)) {
                    foreach ($modelmedias->imageFiles as $file) {
                        Yii::$app->db->createCommand()->insert('gs_sliderimg', ['img' => $file->baseName . '.' . $file->extension,
                            'game_id' => $model->id])->execute();
                    }
                    $modelslideimg->save();
                }
            }

            $modelwin->save();
            $modelmac->save();
            $modellin->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelgenre' => $modelgenre,
                'modelos' => $modelos,
                'modellanguage' => $modellanguage,
                'modelplatform' => $modelplatform,
                'modelmode' => $modelmode,
                'modelmedia' => $modelmedia,
                'modelvideo' => $modelvideo,
                'modelmedias' => $modelmedias,
                'modelwin' => $modelwin,
                'modelmac' => $modelmac,
                'modellin' => $modellin
            ]);
        }
    }

    public function actionDelete($id)
    {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelos' => Osgame::find()->where(['fk_game_id' => $id])->all(),
            'modellang' => Gamelanguage::find()->where(['fk_game_id' => $id])->all(),
            'modelplat' => Gameplatform::find()->where(['fk_game_id' => $id])->all(),
            'modelmode' => Gamemode::find()->where(['fk_game_id' => $id])->all(),
            'modelgenre' => Gamegenre::find()->where(['fk_game_id' => $id])->all(),
            'sliderimg' => Sliderimg::find()->where(['game_id' => $id])->all(),
            'modelvideo' => Gamemedia::findOne(['game_id' => $id]),
            'syswin' => Syswindows::findOne(['game_id' => $id]),
            'sysmac' => Sysmac::findOne(['game_id' => $id]),
            'syslinux' => Syslinux::findOne(['game_id' => $id]),

        ]);
    }

    protected function findModel($id)
    {
        if (($model = Games::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
