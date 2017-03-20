<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\LoginForm; 

class DefaultController extends Controller
{
    public $defaultAction = "login";
    public $layout = 'admin';

    public function actionLogin()
    {
        $this->layout = 'loginlayout';

        if (!Yii::$app->user->isGuest) {
            return $this->redirect('default/main');
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                Yii::$app->user->login($model->getUser());
                return $this->redirect('default/main');
            }
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionMain()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->render('main', [
            ]);
        } else
            return $this->redirect(['../admin/ ']);
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
            return $this->redirect(['../admin/ ']);
        }
    }

}
