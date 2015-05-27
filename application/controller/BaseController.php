<?php

abstract class BaseController
{
	protected $template;
	public function BaseController()
	{
		global $template;
		$this->template = $template;
	}
	public   function indexAction()
	{
	}
	public   function indexAjaxAction()
	{
	}
	public   function viewAction()
	{
	}
	public   function viewAjaxAction()
	{
	}
	public   function createAction()
	{
	}
	public   function createAjaxAction()
	{
	}
	public   function deleteAction()
	{
	}
	public   function deleteAjaxAction()
	{
	}
	public   function updateAction()
	{
	}
	public   function updateAjaxAction()
	{
	}
}