<?php
/**
 * NoticeModule.php
 * Date: 22.07.14
 * Time: 14:36
 *
 * @author MNB <buyskih@gmail.com>
 * @package notice
 */

/**
 * Class NoticeModule
 */
class NoticeModule extends CWebModule {

    /**
     * @var string
     */
    public $defaultController = 'admin';

    protected function init() {
        $this->setImport(['notice.models.*']);
    }

}