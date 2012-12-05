<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

// load tooltip behavior
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>
<!-- Add the side bar-->
<script type="text/javascript">
$(document).ready(function(){
	  $("button").click(function( $v){
	    $("#texens").val($v);
	    alert($("#texens").val());
	  });
	});

	
</script>



<form
	action="<?php echo JRoute::_('index.php?option=com_taskman&view=tasks'); ?>"
	method="post" name="adminForm" id="adminForm">

	<?php if(!empty( $this->sidebar)): ?>
	<!-- set span 2 for side bar container(because if no sider bar it will not take space) and set span 10 for main container-->
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else : ?>
		<div id="j-main-container">
			<?php endif;?>
<p>Name: <input type="hidden" id="texens" name="user" value="texens" /></p>


			<!--search filter-->
			<div id="filter-bar" class="btn-toolbar">
				<div class="filter-search btn-group pull-left">
					<label for="filter_search" class="element-invisible"><?php echo JText::_('COM_WEBLINKS_SEARCH_IN_TITLE');?>
					</label> <input type="text" name="filter_search" id="filter_search"
						placeholder="<?php echo JText::_('COM_HELLOWORLD_SEARCH'); ?>"
						value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
						title="<?php echo JText::_('COM_WEBLINKS_SEARCH_IN_TITLE'); ?>" />
				</div>

				<div class="btn-group pull-left">
					<button class="btn hasTooltip" type="submit"
						title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>">
						<i class="icon-search"></i>
					</button>
					<button class="btn hasTooltip" type="button"
						title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>"
						onclick="document.id('filter_search').value='';this.form.submit();">
						<i class="icon-remove"></i>
					</button>
				</div>
				<div class="btn-group pull-right hidden-phone">
					<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?>
					</label>
					<?php echo $this->pagination->getLimitBox(); ?>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="span6 pull-left">
	<div id="xxx">
		<table class="table ">
			<thead>
				<tr>
					<th width="5">
						<!-- arg1-text, arg2-db query name, arg3,4 ordering default values -->
						<?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_ID', 'a.task_id', $listDirn, $listOrder); ?>
					</th>
					<th width="20"><input type="checkbox" name="toggle" value=""
						onclick="Joomla.checkAll(this)" />
					</th>



					<th><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_TITLE', 'a.title', $listDirn, $listOrder); ?>
					</th>

					<th><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_NOTES', 'a.notes', $listDirn, $listOrder); ?>

					</th>
					<th></th>
				</tr>

			</thead>
			<tfoot>
				<tr>
					<td colspan="20"><?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php $a=0; foreach($this->items as $i => $item): 
				$canChange=1;

				?>
				<tr class="row<?php echo $i % 2; ?>">
					<td><?php echo $item->task_id; ?>
					</td>
					<td><?php echo JHtml::_('grid.id', $i, $item->task_id); ?>
					</td>

					<td><?php echo $item->title; ?>
					</td>
					<td><?php echo $item->notes; ?>
					</td>
					
					<td><button class="icon-arrow-right"
						onClick="disp($i)"></button>
					</td>
				</tr>
				<?php  endforeach; ?>

			</tbody>
		</table>

		<div>
			<input type="hidden" name="task" value="" /> <input type="hidden"
				name="boxchecked" value="0" /> <input type="hidden"
				name="filter_order" value="<?php echo $listOrder; ?>" /> <input
				type="hidden" name="filter_order_Dir"
				value="<?php echo $listDirn; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</div>
</div>

<div id="ccc" class="span6 pull-right ">
	<table class="table ">
		<thead>
			<tr>
				<th width="5"></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($this->items as $i => $item): 
				$canChange=1;
       if($a!=$i)
                {
				?>

			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_ASIGNEE', 'a.assignee', $listDirn, $listOrder); ?>

				</td>
				<td><?php echo $item->assignee; ?>
				</td>

			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_COMPANY', 'company', $listDirn, $listOrder); ?>

				</td>

				<td><?php echo $item->company; ?>
				</td>
			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_PROJECTS', 'projects', $listDirn, $listOrder); ?>

				</td>
				<td><?php echo $item->projects; ?>
				</td>

			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_DUEDATE', 'a.duedate', $listDirn, $listOrder); ?>

				</td>

				<td><?php echo $item->duedate; ?>
				</td>

			</tr>
			<tr>

				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_FOLLOWERS', 'a.followers', $listDirn, $listOrder); ?>

				</td>
				<td><?php echo $item->followers; ?>
				</td>
			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_FEED', 'a.feed', $listDirn, $listOrder); ?>

				</td>
				<td><?php echo $item->feed; ?>
				</td>
			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort','TASKMAN_MSGS_COMMENTS', 'a.comments', $listDirn, $listOrder); ?>

				</td>
				<td><?php echo $item->comments; ?>
				</td>
			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_TAGS', 'a.tags', $listDirn, $listOrder); ?>

				</td>
				<td><?php echo $item->tags; ?>
				</td>
			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_LABEL', 'label', $listDirn, $listOrder); ?>

				</td>
				<td><?php echo $item->label; ?>
				</td>

			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_FILE', 'a.file', $listDirn, $listOrder); ?>

				</td>
				<td><?php echo $item->file; ?>
				</td>

			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_SUBTASKS', 'a.subtasks', $listDirn, $listOrder); ?>
	
				</td>
				<td><?php echo $item->subtasks; ?>
				</td>
			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_STATE', 'a.state', $listDirn, $listOrder); ?>

				</td>
				<td><?php echo $item->state; ?>
				</td>
			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_CREATEDBY', 'a.created_by', $listDirn, $listOrder); ?>

				</td>
				<td><?php echo $item->created_by; ?>
				</td>
			</tr>
			<tr>
				<td><?php echo JHtml::_('grid.sort', 'TASKMAN_MSGS_PRIORITY', 'a.priority', $listDirn, $listOrder); ?>
				</td>
				<td><?php echo $item->priority; ?>
				</td>
			</tr>
		
		<?php  }else { continue; } endforeach; ?>
		<tbody>
	
	</table>
</div>
