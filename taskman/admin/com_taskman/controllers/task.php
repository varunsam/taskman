<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controllerform library
jimport('joomla.application.component.controllerform');
 
/**
 * HelloWorld Controller
 */
class TaskManControllerTask extends JControllerForm
{
	function saveDate(){
		$post = JRequest::get('post');
		$model= $this->getModel();
		$row = $model->getTable();
		$row->load($post['task_id']);
		//replace the db duedate row by POSTED value
		$row->duedate = $post['duedate'];
		//save the values
		$row->store();
		//display the date
		echo $post['duedate'];
		exit;

	} 
	function saveText(){
		$post=JRequest::get('post');
		$model=$this->getModel();
		$row=$model->getTable();
		$row->load($post['task_id']);
		$row->assignee=$post['assignee'];
		$row->store();
		echo $post['assignee'];
		exit;
	}
	}