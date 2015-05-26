<?php
include_once(PATH_MODEL.'ManageModel.php');
include_once(PATH_LIBRARY.'Pager.php');

class ManageController extends  BaseController
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
        $Negatives = $this->manageModel->getNegatives();
        
        $limit = isset($_REQUEST['limit']) ?  $_REQUEST['limit'] : 3;

        $Pagination = new Pagination($limit,'index.php?controller=negative&action=index');//,$base_url
        $totalRecord = count($Negatives); // Tổng số user có trong database
        $totalPages = $Pagination->totalPages($totalRecord); // Tổng số trang tìm được
        $limit = (int)$Pagination->limit; // Số record hiển thị trên một trang
        $start = (int)$Pagination->start(); // Vị trí của record

        $Negativelimit = $this->manageModel->getNegativeslimit($start,$limit);
       // echo '<pre>'.print_r($Negativelimit,true).'</pre>';die();
        $listPage= $Pagination->listPages($totalPages);


        $this->template->assign('negatives',$Negativelimit);

        $this->template->assign('listPage',$listPage);


        $this->template->assign('listPage',$listPage);

		return $this->template->fetch('manage/index.tpl');
	}
   

}
?>