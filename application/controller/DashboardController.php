<?php
include_once(PATH_MODEL.'ManageModel.php');
include_once(PATH_LIBRARY.'Pager.php');

class DashboardController extends  BaseController
{
    private $dashboardModel;
    public function __construct()
    {
      $this->dashboardModel = new ManageModel();
        parent::BaseController();

    }
	
	public function indexAction()
	{
		return $this->template->fetch('dashboard/index.tpl');
	}
   

}
?>