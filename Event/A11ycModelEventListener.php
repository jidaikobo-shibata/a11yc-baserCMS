<?php
class A11ycModelEventListener extends BcModelEventListener
{
	/**
	 * 登録イベント
	 *
	 * @var array
	 */
	public $events = array(
		'afterSave',
	);

	/**
	 * afterSave
	 *
	 * @param CakeEvent $event
	 * @return boolean
	 */
	public function afterSave(CakeEvent $event)
	{
		$model     = $event->subject;
		$modelName = $model->name;

		foreach (Configure::read('A11yc.keys') as $modelName => $target_key)
		{
			// コンテンツがなければチェック対象外
			if ( ! is_string($model->data[$modelName][$target_key])) continue;

			// チェックを行う
			require_once (dirname(__DIR__).'/a11yc/libs/a11yc/main.php');
			$url = $model->data['Content']['url'];
			\A11yc\Validate::$is_partial    = true;
			\A11yc\Validate::$do_link_check = \A11yc\Input::post('jwp_a11y_link_check', false);
			\A11yc\Validate::$do_css_check  = \A11yc\Input::post('jwp_a11y_css_check', false);
			\A11yc\Validate::html($url, $model->data[$modelName][$target_key]);

			// セッションに格納
			\A11yc\Session::add('a11yc', 'errs',      \A11yc\Validate\Get::errors($url));
			\A11yc\Session::add('a11yc', 'errs_cnts', \A11yc\Validate\Get::errorCnts($url));
			\A11yc\Session::add('a11yc', 'errs_logs', \A11yc\Validate\Get::logs($url) ?: array());
		}

		return true;
	}
}
