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
	   if(isset($_GET['search'])){
	       $search=$_GET['search'];
	   }else{
	       $search='';
	   }
        
	    if(isset($_POST['go'])){
            $search= $_POST['search']?$_POST['search']:'';
        }
        
        $Negatives = $this->manageModel->getNegatives($search);
        
        $limit = isset($_REQUEST['limit']) ?  $_REQUEST['limit'] : 10;

        $Pagination = new Pagination($limit,'index.php?controller=negative&action=index&search='.$search);//,$base_url
        $totalRecord = count($Negatives); 
        $totalPages = $Pagination->totalPages($totalRecord); 
        $limit = (int)$Pagination->limit; 
        $start = (int)$Pagination->start();

        $Negativelimit = $this->manageModel->getNegativeslimit($start,$limit,$search);
       // echo '<pre>'.print_r($Negativelimit,true).'</pre>';die();
        $listPage= $Pagination->listPages($totalPages);


        $this->template->assign('negatives',$Negativelimit);
        $this->template->assign('search',$search);

        $this->template->assign('listPage',$listPage);


		return $this->template->fetch('manage/index.tpl');
	}
   

}
?>