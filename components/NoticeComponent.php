<?php
/**
 * NoticeComponent.php
 * Date: 22.07.14
 * Time: 15:45
 *
 * @author MNB <buyskih@gmail.com>
 * @package notice
 */

/**
 * Class NoticeComponent
 */
class NoticeComponent extends CComponent {

    public function init() {
        Yii::app()->getModule('notice');
    }

    public function add($userId, $text, $url = null, $color = 'success') {
        $model          = new Notice();
        $model->user_id = $userId;
        $model->text    = $text;
        $model->url     = $url;
        $model->color   = $color;

        return $model->save() ? : $model->getErrors();
    }


}