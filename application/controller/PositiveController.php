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
        if(isset($_GET['search'])){
	       $search=$_GET['search'];
	    }else{
	       $search='';
	    }
        
	    if(isset($_POST['go'])){
            $search= $_POST['search']?$_POST['search']:'';
        }
        $Positives = $this->manageModel->getPositives($search);
        
        $limit = isset($_REQUEST['limit']) ?  $_REQUEST['limit'] : 10;

        $Pagination = new Pagination($limit,'index.php?controller=positive&action=index&search='.$search);//,$base_url
        $totalRecord = count($Positives); 
        $totalPages = $Pagination->totalPages($totalRecord); 
        $limit = (int)$Pagination->limit; 
        $start = (int)$Pagination->start();

        $Positivelimit = $this->manageModel->getPositiveslimit($start,$limit,$search);
       // echo '<pre>'.print_r($Negativelimit,true).'</pre>';die();
        $listPage= $Pagination->listPages($totalPages);

       
        $this->template->assign('positives',$Positivelimit);
        $this->template->assign('search',$search);
        $this->template->assign('totalrecords',$totalRecord);
        $this->template->assign('limit',$limit);
        $this->template->assign('totalpages',$totalPages);

        $this->template->assign('listPage',$listPage);


		return $this->template->fetch('positive/index.tpl');
	}
    
}
?>