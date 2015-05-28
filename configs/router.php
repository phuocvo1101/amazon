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
            case "order":
				$basecontroller = new OrdersController();
				break;
            case "dashboard":
				$basecontroller = new DashboardController();
				break;
			default:
				$basecontroller = new DashboardController();
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
        $_GET['controller'] = 'dashboard';
        $_GET['action'] = 'index';
		$basecontroller = new DashboardController();
		$content = $basecontroller->indexAction();
	}	

$template->assign('content',$content);
$template->display($layout);