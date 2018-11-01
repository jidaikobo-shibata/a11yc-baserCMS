<?php
class A11ycHelperEventListener extends BcHelperEventListener
{
	/**
	 * 登録イベント
	 *
	 * @var array
	 */
	public $events = array(
		'Form.beforeCreate'
	);

	public function formBeforeCreate(CakeEvent $event)
	{
		$view = $event->subject;

		foreach(Configure::read('A11yc.views') as $modelName => $requestTarget)
		{
			if (
				$requestTarget['controller'] == $view->request['controller'] &&
				$requestTarget['action'] == $view->request['action']
			)
			{
				require_once (dirname(__DIR__).'/a11yc/libs/a11yc/main.php');
				$errs      = \A11yc\Session::fetch('a11yc', 'errs');
				$errs_logs = \A11yc\Session::fetch('a11yc', 'errs_logs');

				// error or not
				$html = '';
				if (isset($errs[0]['errors']) && ! empty($errs[0]['errors']))
				{
					$html.= '<div class="a11yc_error">';
					$html.= \A11yc\Message\Plugin::error($errs[0]['errors']);
					$html.= '</div>';
				}
				elseif (empty($errs[0]['errors']))
				{
					$html.= '<div id="a11yc_validation_not_found_error"><span class="a11yc_icon_fa" role="presentation" aria-hidden="true"></span>';
					$html.= \A11yc\Message\Plugin::noError();
					$html.= '</div>';
				}

				// notice
				if (isset($errs[0]['notices']) && ! empty($errs[0]['notices']))
				{
					$html.= '<div class="a11yc_notice">';
					$html.= \A11yc\Message\Plugin::notice($errs[0]['notices']);
					$html.= '</div>';
				}

				if (isset($errs[0]))
				{
					echo $view->element(
						'A11yc.admin/messages',
						array(
							'html'                 => $html,
							'yml'                  => \A11yc\Yaml::fetch(),
							'machine_check_status' => \A11yc\Values::machineCheckStatus(),
							'errs_logs'            => $errs_logs[0],
						)
					);
				}
			}
		}
	}
}
