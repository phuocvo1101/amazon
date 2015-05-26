<?php
$layout="index.tpl";
$basecontroller = null;
$content = "";

    if(isset($_GET["controller"]) && isset($_GET['action'])) {

		switch($_GET["controller"]) {
			case "manage":
				$basecontroller = new ManageController();
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
            case 'indexthanhvien':
                $content = $basecontroller->indexActionThanhVien();
                break;
			case 'view':
				$content = $basecontroller->viewAction();
				break;
			case 'viewajax':
				$content = $basecontroller->viewAjaxAction();
				break;
			default:
				$content =$basecontroller->indexAction();
				break;
		}	
	} else {
        $_GET['controller'] = 'manage';
        $_GET['action'] = 'index';
		$basecontroller = new ManageController();
		$content = $basecontroller->indexAction();
	}	

$template->assign('content',$content);
$template->display($layout);