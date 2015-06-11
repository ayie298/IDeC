<link  href="<?php echo base_url(); ?>plugins/js/jHorizontalTree/css/style.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>plugins/js/jHorizontalTree/js/jquery-1.8.1.min.js"></script>
<script src="<?php echo base_url(); ?>plugins/js/jHorizontalTree/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>plugins/js/jHorizontalTree/js/jquery.tree.js"></script>
<script>
$(document).ready(function() {
	$('.tree').tree_structure({
		'add_option': false,
		'edit_option': false,
		'delete_option': false,
		'confirm_before_delete' : true,
		'animate_option': [true, 5],
		'fullwidth_option': false,
		'align_option': 'center',
		'draggable_option': false
	});

	$(".pop").click(function(){

		parent.poping($(this).attr('level'),$(this).attr('id'));
	});
});

</script>
<div style="width:1450px;margin:0px;overflow:hidden;">
	<div>
		<ul class="tree">
			<?php foreach($organization as $org) : ?>
			<li>
				<?php if($org->level == "unit") : ?>
				<?php $employee = $this->employee_model->find(array('employee.id_mas_employee_position' => 2)) ?>
					<div style="width:120px;min-height:60px" class="pop" level="<?php echo $org->level ?>" id="<?php echo $org->id_organization_item ?>">
						<img class="blah" src="<?php echo base_url()?><?php echo empty($employee->photo) ? 'media/images/profile.jpeg' : 'uploads/default/photo/' . $employee->photo ?>" width="100" height="100">
					</div>
				<?php endif; ?>
				<ul class="tree">
					<?php $tree2 = $this->employee_model->organization(array('id_organization_item_parent' => $org->id_organization_item)); ?>
					<?php foreach($tree2 as $tree) : ?>
					<?php $employee = $this->employee_model->find(array('employee.id_mas_employee_position' => 3)) ?>
					<li>
						<div style="width:80px;min-height:60px" class="pop" level="<?php echo $tree->level ?>" id="<?php echo $tree->id_organization_item ?>"><img src="<?php echo base_url(); ?>media/images/profile.jpeg" height="60"><br><?php echo $tree->abbreviation ?></div>
						<ul>
							<?php $tree3 = $this->employee_model->organization(array('id_organization_item_parent' => $tree->id_organization_item)); ?>
							<?php foreach($tree3 as $tree3) : ?>
							<li>
								<div style="width:80;min-height:45px" class="pop" level="<?php echo $tree3->level ?>" id="<?php echo $tree3->id_organization_item ?>"><i class='icon-sitemap'></i><br><?php echo $tree3->abbreviation ?></div>
							</li>
							<?php endforeach; ?>
						</ul>
					</li>
					<?php endforeach; ?>
				</ul>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<br><br>