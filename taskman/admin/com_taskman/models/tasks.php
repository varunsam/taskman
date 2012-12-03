<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import the Joomla modellist library
jimport('joomla.application.component.modellist');
/**
 * HelloWorldList Model
 */
class TaskManModelTasks extends JModelList
{
  protected function populateState($ordering = null, $direction = null)
	{
		// List state information.
		parent::populateState('title', 'asc');
	}

        /**
         * Method to build an SQL query to load the list data.
         *
         * @return      string  An SQL query
         */
        protected function getListQuery()
        {
                // Create a new query object.           
                $db = JFactory::getDBO();
                $query = $db->getQuery(true);
                
                // Select some fields
                $query->select('a.task_id,a.title,a.notes,a.assignee,company,label,a.created_by,a.task_status,a.priority,projects,'
								.'a.subtasks,a.comments,a.duedate,a.tags,'
								.'a.file,a.followers,a.feed,a.state');
                // From the hello table
                $query->from('#__taskman_task as a');
                
                
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		//if ($orderCol == 'name') {
			$orderCol = 'title';
		//}
		//$query->order($db->escape($orderCol.' '.$orderDirn));
		
                return $query;
        }
}
