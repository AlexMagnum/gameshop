<?php

namespace app\controllers;

use app\models\Gamegenre;
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Games;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SearchForm;
use app\models\Genre;
use app\models\Platform;
use app\models\AdvancedSearchForm;
use app\models\Contact;
use app\models\Gamemedia;
use app\models\Sliderimg;
use app\models\Syswindows;
use app\models\Sysmac;
use app\models\Syslinux;
use app\models\Gameplatform;
use app\models\Buy;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */

    public function beforeAction($action)
    {
        $model = new SearchForm();
        $modelas = new AdvancedSearchForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $q = Html::encode($model->q);
            return $this->redirect(Yii::$app->urlManager->createUrl(['site/search', 'q' => $q]));
        }
        if($modelas->load(Yii::$app->request->post()) && $modelas->validate()){

            $game = Html::encode($modelas->game);
            $publisher = Html::encode($modelas->publisher);
            $genre = Html::encode($modelas->genre);
            $platform = Html::encode($modelas->platform);
            $price_from = Html::encode($modelas->price_from);
            $price_to = Html::encode($modelas->price_to);
            $order = Html::encode($modelas->order);

            return $this->redirect(Yii::$app->urlManager->createUrl(['site/advancedsearch',
                'game' => $game,
                'publisher' => $publisher,
                'genre' => $genre,
                'platform' => $platform,
                'price_from' => $price_from,
                'price_to' => $price_to,
                'order' => $order
            ]));
        }
        return true;
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Games::find()->where(['>', 'in_stock', 0]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $games = $query->orderBy(['name' => SORT_ASC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'games' => $games,
            'active_page' => Yii::$app->request->get('page', 1),
            'count_pages' => $pagination->getPageCount(),
            'pagination' => $pagination
        ]);
    }

    public function actionAbout(){
        return $this->render('about');
    }

    public function actionGame(){
        $game = Games::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
        $game_media = Gamemedia::find()->where(['game_id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
        $slider_img = Sliderimg::find()->where(['game_id' => Yii::$app->getRequest()->getQueryParam('id')])->all();
        $os = $game->os;
        $genre = $game->genre;
        $language = $game->language;
        $platform = $game->platform;
        $mode = $game->mode;
        $syswin = Syswindows::find()->where(['game_id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
        $sysmac = Sysmac::find()->where(['game_id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
        $syslinux = Syslinux::find()->where(['game_id' => Yii::$app->getRequest()->getQueryParam('id')])->one();

        return $this->render('game', [
            'game' => $game,
            'gamemedia' => $game_media,
            'slideimg' => $slider_img,
            'os' => $os,
            'genre' => $genre,
            'language' => $language,
            'platform' => $platform,
            'mode' => $mode,
            'syswin' => $syswin,
            'sysmac' => $sysmac,
            'syslinux' => $syslinux
        ]);
    }

    public function actionSearch(){
        $q = Yii::$app->getRequest()->getQueryParam('q');
        $query = Games::find()->where(['like', 'name', $q])->andWhere(['>', 'in_stock', 0]);

        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $query->count()
        ]);

        $games = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('search', [
            'games' => $games,
            'q' => $q,
            'active_page' => Yii::$app->request->get('page', 1),
            'count_pages' => $pagination->getPageCount(),
            'pagination' => $pagination
        ]);
    }

    public function actionAdvancedsearch(){

        $game = Yii::$app->getRequest()->getQueryParam('game');
        $publisher = Yii::$app->getRequest()->getQueryParam('publisher');
        $genre = Yii::$app->getRequest()->getQueryParam('genre');
        $platform = Yii::$app->getRequest()->getQueryParam('platform');
        $price_from = Yii::$app->getRequest()->getQueryParam('price_from');
        $price_to = Yii::$app->getRequest()->getQueryParam('price_to');
        $order = Yii::$app->getRequest()->getQueryParam('order');

        $query = Games::find()->where(['>', 'in_stock', 0]);

        $gp = Gameplatform::find()->where(['fk_platform_id' => $platform]);
        $gg = Gamegenre::find()->where(['fk_genre_id' => $genre]);

        if(!empty($game)) {
            $query->andWhere(['like', 'name', $game]);
        }
        if(!empty($publisher)){
            $query->andWhere(['publisher' => $publisher])->distinct();
        }
        if(!empty($genre)){
            $query->innerJoin(['u' => $gg], 'u.fk_game_id = gs_games.id');
        }
        if(!empty($platform)) {
            $query->innerJoin(['u' => $gp], 'u.fk_game_id = gs_games.id');
        }
        if(!empty($price_from)) {
            $query->andWhere(['>=', 'price', $price_from]);
        }
        if(!empty($price_to)) {
            $query->andWhere(['<=', 'price', $price_to]);
        }
        if(!empty($order)) {
            if($order == "name_asc"){
                $query->orderBy(['name' => SORT_ASC]);
            } else if($order == "name_desc"){
                $query->orderBy(['name' => SORT_DESC]);
            } else if($order == "price_asc"){
                $query->orderBy(['price' => SORT_ASC]);
            } else if($order == "price_desc"){
                $query->orderBy(['price' => SORT_DESC]);
            } else if($order == "discount_asc"){
                $query->andWhere(['>', 'discount', 0])->orderBy(['discount' => SORT_ASC]);
            } else if($order == "discount_desc"){
                $query->andWhere(['>', 'discount', 0])->orderBy(['discount' => SORT_DESC]);
            } else if($order == "date_asc"){
                $query->orderBy(['date_release' => SORT_ASC]);
            } else if($order == "date_desc"){
                $query->orderBy(['date_release' => SORT_DESC]);
            }
        }

        $count_find = $query->count();

        $pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $query->count()
        ]);

        $games = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('advancedsearch',[
            'games' => $games,
            'count_find' => $count_find,
            'active_page' => Yii::$app->request->get('page', 1),
            'count_pages' => $pagination->getPageCount(),
            'pagination' => $pagination
        ]);
    }

    public function actionContact(){

        $model = new ContactForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $contact = new Contact();

            $contact->name = $model->name;
            $contact->email = $model->email;
            $contact->body = $model->body;
            $contact->save();

            return $this->render('contact', [
                'model' => $model,
                'success' => true,
                'error' => false
            ]);
        }
        else {
            if(isset($_POST["body"])) $error = true;
            else $error = false;
            return $this->render('contact', [
                'model' => $model,
                'success' => false,
                'error' => $error
            ]);
        }
    }

    public function actionWarranty(){
        return $this->render('warranty',[

        ]);
    }

    public function actionReview(){
        return $this->render('review', [

        ]);
    }

    public function actionHowbuy(){
        return $this->render('howbuy', [

        ]);
    }

    public function actionTop(){
    	$totalquery = Games::find()->where(['>', 'in_stock', 0])->all();
    	$avg = 0;
    	foreach ($totalquery as $t) {
    		$avg += $t->sale_count;
    	}
    	$avg /= count($totalquery); 

        $query = Games::find()->where(['>=', 'sale_count', floor($avg)])->andWhere(['>', 'in_stock', 0]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $games = $query->orderBy(['name' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('top', [
            'games' => $games,
            'active_page' => Yii::$app->request->get('page', 1),
            'count_pages' => $pagination->getPageCount(),
            'pagination' => $pagination
        ]);
    }

    public function actionNew(){
		
		$date = time() - 31556926;
        $datenew = date("Y-m-d", $date);
        
        $query = Games::find()->where(['>', 'in_stock', 0])->andWhere(['>', 'date_release', $datenew]);


        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $games = $query->orderBy(['date_release' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('new', [
            'games' => $games,
            'active_page' => Yii::$app->request->get('page', 1),
            'count_pages' => $pagination->getPageCount(),
            'pagination' => $pagination
        ]);
    }

    public function actionSale(){
        $query = Games::find()->where(['>', 'discount', 0])->andWhere(['>', 'in_stock', 0]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $games = $query->orderBy(['discount' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('sale', [
            'games' => $games,
            'active_page' => Yii::$app->request->get('page', 1),
            'count_pages' => $pagination->getPageCount(),
            'pagination' => $pagination
        ]);
    }

    public function actionPreorder(){
        $query = Games::find()->where(['=', 'is_release', 1])->andWhere(['>', 'in_stock', 0]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count()
        ]);

        $games = $query->orderBy(['discount' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('preorder', [
            'games' => $games,
            'active_page' => Yii::$app->request->get('page', 1),
            'count_pages' => $pagination->getPageCount(),
            'pagination' => $pagination
        ]);
    }

    public function actionPlatform($id){

        $gp = Gameplatform::find()->where(['fk_platform_id' => $id]);

        //$querys = Games::find()->innerJoin(['u' => $gp], 'u.fk_game_id = gs_games.id');

        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $gp->count()
        ]);

        $games = Games::find()->where(['>', 'in_stock', 0])->innerJoin(['u' => $gp], 'u.fk_game_id = gs_games.id')
            ->orderBy(['name' => SORT_ASC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('platform', [
            'games' => $games,
            'active_page' => Yii::$app->request->get('page', 1),
            'count_pages' => $pagination->getPageCount(),
            'pagination' => $pagination
        ]);
    }

    public function actionGenre($id){

        $gp = Gamegenre::find()->where(['fk_genre_id' => $id]);
       // $query = Games::find()->where(['genre_id' => $id]);

        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $gp->count()
        ]);

        $games = Games::find()->where(['>', 'in_stock', 0])->innerJoin(['u' => $gp], 'u.fk_game_id = gs_games.id')
            ->orderBy(['name' => SORT_ASC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('genre', [
            'games' => $games,
            'active_page' => Yii::$app->request->get('page', 1),
            'count_pages' => $pagination->getPageCount(),
            'pagination' => $pagination
        ]);
    }

    public function actionBuy(){
        $game = Games::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
        $model = new Buy();

        if ($model->load(Yii::$app->request->post())){
            $session = Yii::$app->session;
            $session->set('gameid', $game->id);
            $session->set('usermail', $model->email);
            $this->redirect('../../');
        }
        return $this->render('buy', ['game' => $game]);
    }

    public function actionAfterbuy(){
        $session = Yii::$app->session;
        if(Yii::$app->request->post('ik_inv_st') == "success") {
            $model = Games::find()->where(['id' => $session['gameid']])->one();
            $model->sale_count += 1;
            $model->in_stock -= 1;
            $model->last_sale = date("Y-m-d H:i:s");
            $model->save();        
            if($model->is_release == 0){
            	$key = strtoupper(substr(str_shuffle(MD5(microtime())), 0, 5))."-".strtoupper(substr(str_shuffle(MD5(microtime())), 0, 5))."-".strtoupper(substr(str_shuffle(MD5(microtime())), 0, 5));
            	Yii::$app->mailer->compose()
		           ->setTo($session['usermail'])
		           ->setFrom('magdubor@gmail.com')
		           ->setSubject('Покупка на gameshop.kl.com.ua')
		           ->setTextBody("Ключ активации к игре $model->name:  $key

		           	Активация Steam: 
		           		1) Нажать '+ ДОБАВИТЬ ИГРУ' 
		           		2) Выбрать 'Активировать в Steam...' 
		           		3) Нажать 'ДАЛЕЕ>' 
		           		4) Нажать 'СОГЛАСЕН' 
		           		5) Ввести ключ активации и нажмите 'ДАЛЕЕ>'. 

		           	Активация Origin: 
		           		1)Скачайте и установите клиент Origin 
		           		2) Зарегистрируйте новый или войдите в свой аккаунт Origin 
		           		3) Воспользуйтесь функцией «Активировать код продукта» 
		           		4) Введите в ключ активации 
		           		5) После этого игра отобразится в разделе 'Мои игры', и вы сможете скачать игру. 

		           	Активация Uplay: 
		           		1) Скачайте и установите Uplay клиент 
		           		2) Зарегистрируйте новый или войдите в свой аккаунт Uplay 
		           		3) Введите ключ активации 
		           		4) После этого игру можно будет запускать через Uplay. 

		           	Активация Battle.Net: 
		           		1) Скачайте клиент Battle.net и установите его 
		           		2) Зарегистрируйте новый или войдите в свой аккаунт Battle.net 
		           		3) Введите ключ активации 
		           		4) После активации игру необходимо установить, а после можно будет запускать.")
		           ->send();
            }
            if($model->is_release == 1){
            	Yii::$app->mailer->compose()
		           ->setTo($session['usermail'])
		           ->setFrom('magdubor@gmail.com')
		           ->setSubject('Покупка на gameshop.kl.com.ua')
		           ->setTextBody("Спасбо за покупку игры $model->name Вы купили данную игру по предзаказу и в день выхода (примерная дата $model->date_release) игры вам на этот адрес электронной почты придет ключ активации!")
		           ->send();
            }
            $this->redirect(['site/afterbuymessage']);
            $session->remove('gameid');            
        }
        else{
            $this->redirect(['site/index']);
        }
       
    }

    public function actionAfterbuymessage(){
 		return $this->render('afterbuymessage');
    }

}
