<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $redactor = $auth->createRole('redactor');
        $auth->add($redactor);

        $support = $auth->createRole('support');
        $auth->add($support);

        $auth->assign($admin, 1);
    }
}
