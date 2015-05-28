<?php
include_once(PATH_MODEL.'OrdersModel.php');
include_once(PATH_LIBRARY.'Pager.php');

class OrdersController extends  BaseController
{
    private $ordersModel;
    public function __construct()
    {
      $this->ordersModel = new OrdersModel();
        parent::BaseController();

    }
	
	public function indexAction()
	{
	   if(isset($_GET['search'])){
	       $search=$_GET['search'];
	   }else{
	       $search='';
	   }
        
	    if(isset($_POST['go'])){
            $search= $_POST['search']?$_POST['search']:'';
        }
        
        $Orders = $this->ordersModel->getOrders($search);
        
        $limit = isset($_REQUEST['limit']) ?  $_REQUEST['limit'] : 10;

        $Pagination = new Pagination($limit,'index.php?controller=order&action=index&search='.$search);//,$base_url
        $totalRecord = count($Orders); 
        $totalPages = $Pagination->totalPages($totalRecord); 
        $limit = (int)$Pagination->limit; 
        $start = (int)$Pagination->start();

        $orderslimit = $this->ordersModel->getOrderslimit($start,$limit,$search);
       // echo '<pre>'.print_r($Negativelimit,true).'</pre>';die();
        $listPage= $Pagination->listPages($totalPages);


        $this->template->assign('orders',$orderslimit);
        $this->template->assign('search',$search);

        $this->template->assign('listPage',$listPage);


		return $this->template->fetch('order/index.tpl');
	}
   

}
?>