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

        $manage = $this->manageModel->getNegative();
        var_dump($manage);die();

        /*$limit = isset($_REQUEST['limit']) ?  $_REQUEST['limit'] : 10;

        $Pagination = new Pagination($limit);//,$base_url
        $totalRecord = count($customers); // Tổng số user có trong database
        $totalPages = $Pagination->totalPages($totalRecord); // Tổng số trang tìm được
        $limit = (int)$Pagination->limit; // Số record hiển thị trên một trang
        $stat = (int)$Pagination->start(); // Vị trí của record

       // $customers1 = $this->customerModel->getCustomerslimit($stat,$limit);
        $listPage= $Pagination->listPages($totalPages);


        $this->template->assign('customers',$customers1);

            $this->template->assign('listPage',$listPage);


        $this->template->assign('listPage',$listPage);*/

		return $this->template->fetch('manage/index.tpl');
	}
}
?>