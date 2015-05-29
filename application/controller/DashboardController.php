<?php
include_once(PATH_MODEL.'DashboadModel.php');
include_once(PATH_LIBRARY.'Pager.php');

class DashboardController extends  BaseController
{
    private $dashboardModel;
    public function __construct()
    {
      $this->dashboardModel = new DashboardModel();
        parent::BaseController();

    }
	
	public function indexAction()
	{
	   $totalnagetive=count($this->dashboardModel->sumNegative());
       $totalpositive=count($this->dashboardModel->sumPositive());
       $totalorders=count($this->dashboardModel->sumOrder());
       
       $this->template->assign('totalnegative',$totalnagetive);
       $this->template->assign('totalpositive',$totalpositive);
       $this->template->assign('totalorders',$totalorders);
       
		return $this->template->fetch('dashboard/index.tpl');
	}
   

}
?>