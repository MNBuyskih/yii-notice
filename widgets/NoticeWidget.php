<?php
/**
 * NoticeWidget.php
 * Date: 22.07.14
 * Time: 15:17
 *
 * @author MNB <buyskih@gmail.com>
 * @package notice
 */

/**
 * Class NoticeWidget
 */
class NoticeWidget extends CWidget {

    /**
     * @var int
     */
    public $userId;

    public function run() {
        if (!($userId = $this->userId)) {
            /** @var CWebApplication $app */
            $app    = Yii::app();
            $userId = $app->user->id;
        }

        if ($userId) {
            /** @var Notice[] $models */
            $models = Notice::model()->user($userId)->actual()->unread()->findAll();
            if (count($models)) {
                $this->assets();
            }
            foreach ($models as $model) {
                echo CHtml::tag('div', ['class' => 'alert alert-' . $model->color],
                    CHtml::tag('button', [
                        'class'          => 'close',
                        'data-notice-id' => $model->id
                    ], '&times;') . ($model->url ? CHtml::link($model->text, $model->goUrl) : $model->text));
            }
        }
    }

    public function assets() {
        /** @var CWebApplication $app */
        $app = Yii::app();
        $app->clientScript->registerPackage('jquery');
        $app->clientScript->registerScript('notice_dismiss',
            '$(".alert .close[data-notice-id]").click(function(e){e.preventDefault();var $this = $(this);$.ajax({url:"'
            . Yii::app()->createUrl('/notice/default/dismiss') .
            '",data:{id:$this.data("notice-id")},complete:function(){$this.closest(".alert").slideUp();}});})');
    }
}