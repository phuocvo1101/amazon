<?php
$layout="index.tpl";
$basecontroller = null;
$content = "";

    if(isset($_GET["controller"]) && isset($_GET['action'])) {

		switch($_GET["controller"]) {
			
            case "negative":
				$basecontroller = new ManageController();
				break;
            case "positive":
				$basecontroller = new PositiveController();
				break;
			default:
				$basecontroller = new ManageController();
				break;	
		}
		switch(strtolower($_GET['action'])) {
			case 'index':
				$content = $basecontroller->indexAction();
				break;
			case 'indexajax':
				$content = $basecontroller->indexAjaxAction();
				break;
            
			default:
				$content =$basecontroller->indexAction();
				break;
		}	
	} else {
        $_GET['controller'] = 'negative';
        $_GET['action'] = 'index';
		$basecontroller = new ManageController();
		$content = $basecontroller->indexAction();
	}	

$template->assign('content',$content);
$template->display($layout);