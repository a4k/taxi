<?php

namespace app\controllers;

use app\models\OrderForm;
use app\models\SignupDriverForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\Order;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
        if (Yii::$app->user->isGuest) {
            return $this->render('index', []);
        }

        $userId = Yii::$app->user->identity->getId();
        $userGroupId = Yii::$app->user->identity->getGroupId();

        $modelOrder = new OrderForm();
        if ($modelOrder->load(Yii::$app->request->post()) && $modelOrder->order()) {
            Yii::$app->session->setFlash('success',
                'Спасибо за заказ такси. Можете отследить ваш заказ в истории');
            return $this->goHome();
        }

        if ($userGroupId == User::GROUP_DRIVER) {

            $dataProviderDriverHistory = new ActiveDataProvider([
                'query' => Order::find()
                    ->andWhere(['driver_id' => $userId])
                    ->andWhere(['status' => Order::STATUS_FINISH])
                    ->orderBy('id'),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            $countDrivesCurrent = Order::find()
                ->andWhere(['driver_id' => $userId])
                ->andWhere(['or',
                    ['status' => Order::STATUS_DRIVER_WAITING],
                    ['status' => Order::STATUS_DRIVING],
                ])
                ->count();

            if ($countDrivesCurrent == 0) {
                $dataProviderDriveAvailable = new ActiveDataProvider([
                    'query' => Order::find()
                        ->where(['status' => Order::STATUS_FREE])
                        ->orderBy('id'),
                    'pagination' => [
                        'pageSize' => 20,
                    ],
                ]);
                return $this->render('index', [
                    'modelOrderDriveHistory' => $dataProviderDriverHistory,
                    'modelOrderDriveAvailable' => $dataProviderDriveAvailable,
                ]);
            } else {
                $dataCurrentDrive = Order::find()
                    ->andWhere(['driver_id' => $userId])
                    ->andWhere(['or',
                        ['status' => Order::STATUS_DRIVER_WAITING],
                        ['status' => Order::STATUS_PASSENGER_WAITING],
                        ['status' => Order::STATUS_DRIVING],
                    ])->one();
                return $this->render('index', [
                    'modelCurrentDrive' => $dataCurrentDrive,
                    'modelOrderDriveHistory' => $dataProviderDriverHistory,
                ]);
            }
        }
        elseif ($userGroupId == User::GROUP_CLIENT) {
            $dataCurrentDrive = Order::find()
                ->andWhere(['user_id' => $userId])
                ->andWhere(['<>', 'status', Order::STATUS_FINISH])->one();

            return $this->render('index', [
                'modelOrder' => $modelOrder,
                'modelCurrentDrive' => $dataCurrentDrive,
            ]);
        }

        return $this->render('index', []);

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Спасибо за регистрацию. Теперь вы можете войти в личный кабинет.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup_driver()
    {
        $model = new SignupDriverForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Спасибо за регистрацию. Теперь вы можете войти в личный кабинет.');
            return $this->goHome();
        }

        return $this->render('signup_driver', [
            'model' => $model,
        ]);
    }

    /**
     * Displays order history.
     *
     * @return string
     */
    public function actionOrder_history()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $userId = Yii::$app->user->identity->getId();
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->where(['user_id' => $userId])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('order_history', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single news model.
     * @param integer $id
     * @return mixed
     */
    public function actionOrder_view($id)
    {
        return $this->render('order_view', [
            'model' => $this->findOrderModel($id),
        ]);
    }

    /**
     * Finds the news model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findOrderModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Displays a single news model.
     * @param integer $id
     * @return mixed
     */
    public function actionOrder_accept($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $userId = Yii::$app->user->identity->getId();
        $currentOrder = Order::findOne($id);

        if (strlen($currentOrder->driver_id) > 0 && $currentOrder->driver_id != $userId) {
            Yii::$app->session->setFlash('success',
                'Заказ выполняет другой водитель');
            return $this->goHome();
        }

        $queryOrderType = Yii::$app->getRequest()->getQueryParam('type');

        if ($currentOrder->status == Order::STATUS_FREE) {

            $currentOrder->status = Order::STATUS_DRIVER_WAITING;
            $currentOrder->driver_id = $userId;
            $currentOrder->save();
        } else if ($currentOrder->status == Order::STATUS_DRIVER_WAITING) {

            if (isset($queryOrderType) && strlen($queryOrderType) > 0
                && strtoupper($queryOrderType) == Order::STATUS_PASSENGER_WAITING) {
                $currentOrder->status = Order::STATUS_PASSENGER_WAITING;
                $currentOrder->save();
            }
        } else if ($currentOrder->status == Order::STATUS_PASSENGER_WAITING) {

            if (isset($queryOrderType) && strlen($queryOrderType) > 0
                && strtoupper($queryOrderType) == Order::STATUS_DRIVING) {
                $currentOrder->status = Order::STATUS_DRIVING;
                $currentOrder->save();
            }
        } else if ($currentOrder->status == Order::STATUS_DRIVING) {

            if (isset($queryOrderType) && strlen($queryOrderType) > 0
                && strtoupper($queryOrderType) == Order::STATUS_FINISH) {
                $currentOrder->status = Order::STATUS_FINISH;
                $currentOrder->save();
            }
        }

        return $this->render('order_accept', [
            'model' => $this->findOrderModel($id),
        ]);
    }
}
