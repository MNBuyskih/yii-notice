<?php
/**
 * DefaultController.php
 * Date: 23.07.14
 * Time: 8:42
 *
 * @author MNB <buyskih@gmail.com>
 * @package notice
 */

/**
 * Class DefaultController
 */
class DefaultController extends Controller {

    public function actionGo($id) {
        $model = $this->loadModel($id);

        if ($model->makeRead()) {
            $this->redirect($model->url, true, 301);
        }
    }

    public function actionDismiss($id) {
        $model = $this->loadModel($id);
        $model->makeDismiss();
    }

    /**
     * @param $id
     *
     * @return Notice
     * @throws CHttpException
     */
    public function loadModel($id) {
        /** @var Notice $model */
        $model = Notice::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, 'Оповещение не найдено');
        }

        /** @var CWebApplication $app */
        $app = Yii::app();
        if ($model->user_id !== $app->user->id) {
            throw new CHttpException(403, 'Это сообщение было адресовано не вам');
        }

        return $model;
    }

}