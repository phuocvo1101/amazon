<?php
include_once(PATH_MODEL.'ManageModel.php');
include_once(PATH_LIBRARY.'Pager.php');

class PositiveController extends  BaseController
{
    private $manageModel;
    public function __construct()
    {
      $this->manageModel = new ManageModel();
        parent::BaseController();

    }
	
	public function indexAction()
	{
       // $cu= $this->manageModel->getDistricts();
        $Positives = $this->manageModel->getPositives();
        
        $limit = isset($_REQUEST['limit']) ?  $_REQUEST['limit'] : 3;

        $Pagination = new Pagination($limit,'index.php?controller=positive&action=index');//,$base_url
        $totalRecord = count($Positives); // Tổng số user có trong database
        $totalPages = $Pagination->totalPages($totalRecord); // Tổng số trang tìm được
        $limit = (int)$Pagination->limit; // Số record hiển thị trên một trang
        $start = (int)$Pagination->start(); // Vị trí của record

        $Positivelimit = $this->manageModel->getPositiveslimit($start,$limit);
       // echo '<pre>'.print_r($Negativelimit,true).'</pre>';die();
        $listPage= $Pagination->listPages($totalPages);


        $this->template->assign('positives',$Positivelimit);

        $this->template->assign('listPage',$listPage);


        $this->template->assign('listPage',$listPage);

		return $this->template->fetch('positive/index.tpl');
	}
    public function indexAjaxAction()
    {
        $Positives = $this->manageModel->getPositives();
        
        $limit = isset($_REQUEST['limit']) ?  $_REQUEST['limit'] : 3;

        $Pagination = new Pagination($limit);//,$base_url
        $totalRecord = count($Positives); // Tổng số user có trong database
        $totalPages = $Pagination->totalPages($totalRecord); // Tổng số trang tìm được
        $limit = (int)$Pagination->limit; // Số record hiển thị trên một trang
        $start = (int)$Pagination->start(); // Vị trí của record
        $Positivelimit = $this->manageModel->getPositiveslimit($start,$limit);
       // echo '<pre>'.print_r($Negativelimit,true).'</pre>';die();
        $listPage= $Pagination->listPages($totalPages);

        $this->template->assign('positives',$Positivelimit);
        $data = $this->template->fetch('positive/dataindex.tpl');

        $this->template->assign('listPage',$listPage);
        if($listPage==''){
            $phantrang='';
        }else{
            $phantrang = $this->template->fetch('positive/listpageindex.tpl');
        }


        $result = array('data'=>$data,'phantrang'=>$phantrang);

        $strResult = json_encode($result);

        echo $strResult;
        exit();
    }

}
?>