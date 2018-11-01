<?php
class A11ycDocsController extends AppController
{
	/**
	 * コントローラー名
	 *
	 * @var string
	 */
	public $name = 'A11ycDocs';

	/**
	 * beforeFilter
	 *
	 * @return void
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();
		require_once (dirname(__DIR__).'/a11yc/libs/a11yc/main.php');
	}

	/**
	 * [ADMIN] 参考資料
	 *
	 * @return void
	 */
	public function admin_index()
	{
		\A11yc\Controller\Docs::index();
		$this->pageTitle = __d('baser', A11YC_LANG_DOCS_TITLE);
		$this->body = \A11yc\View::fetch('body');
	}

	/**
	 * [ADMIN] 参考資料個票
	 *
	 * @return void
	 */
	public function admin_each()
	{
		\A11yc\Controller\Docs::each(\A11yc\Input::get('criterion', ''));
		$this->pageTitle = __d('baser', \A11yc\View::fetch('title'));
		$this->body = \A11yc\View::fetch('body');
	}
}
