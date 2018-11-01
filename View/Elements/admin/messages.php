<?php
$this->BcBaser->css('A11yc.admin/a11yc');
$this->BcBaser->css('A11yc.admin/basercms');
$this->BcBaser->css('A11yc.admin/font-awesome/css/font-awesome.min.css');
$this->BcBaser->js('A11yc.admin/a11yc.js');
?>

<div class="a11yc">
<?php
echo $html;

// logs
if ( ! empty($errs_logs)):
	echo '<details>';
	echo '<summary>'.A11YC_LANG_CHECKLIST_MACHINE_CHECK_LOG.'</summary>';

	foreach ($errs_logs as $err => $log):
		echo '<details>';
		echo '<summary>'.$yml['errors'][$err]['title'].'</summary>';
		echo '<ul>';
		foreach ($log as $loghtml => $logresult):
			if ($logresult == 0) continue;
			if (
				$logresult == 4 || // not exist
				$loghtml == A11YC_LANG_CHECKLIST_MACHINE_CHECK_UNSPEC // place not specified
			):
				echo '<li>'.$machine_check_status[$logresult].'</li>';
			else:
				echo '<li>'.$machine_check_status[$logresult].': '.\A11yc\Util::s($loghtml).'</li>';
			endif;

		endforeach;
		echo '</ul>';
		echo '</details>';
	endforeach;
	echo '</details>';
endif; // logs
?>
</div>
