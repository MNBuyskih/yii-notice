<?php
/**
 * Notice.php
 * Date: 22.07.14
 * Time: 15:05
 *
 * @author MNB <buyskih@gmail.com>
 * @package notice
 */

Yii::import('notice.models.base.NoticeBase');

/**
 * Class Notice
 *
 * @property string $goUrl
 */
class Notice extends NoticeBase {

    /**
     * Не прочитанное
     */
    const UNREAD = 0;

    /**
     * Прочитанное
     */
    const READ = 1;

    /**
     * Актуальное
     */
    const ACTUAL = 0;

    /**
     * Проигнорированное
     */
    const DISMISS = 1;

    /**
     * @var string
     */
    private $_goUrl;

    /**
     * @param string $className
     *
     * @return Notice
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @param $userId
     *
     * @return $this
     */
    public function user($userId) {
        $criteria = $this->getDbCriteria();
        $criteria->addColumnCondition(['user_id' => $userId]);

        return $this;
    }

    /**
     * @return $this
     */
    public function actual() {
        $criteria = $this->getDbCriteria();
        $criteria->addColumnCondition(['`dismiss`' => self::ACTUAL]);

        return $this;
    }

    /**
     * @return $this
     */
    public function unread() {
        $criteria = $this->getDbCriteria();
        $criteria->addColumnCondition(['`read`' => self::UNREAD]);

        return $this;
    }

    /**
     * @return string
     */
    public function getGoUrl() {
        if (!$this->_goUrl)
            $this->_goUrl = Yii::app()->createAbsoluteUrl('/notice/default/go', ['id' => $this->id]);

        return $this->_goUrl;
    }

    public function makeRead() {
        $this->read = self::READ;

        return $this->save(true, ['read']);
    }

    public function makeDismiss() {
        $this->dismiss = self::DISMISS;

        return $this->save(true, ['dismiss']);
    }
}