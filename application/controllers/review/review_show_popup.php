<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_simpan,#btn_ulang").click(function(){
			closepopup();
		});
	});
</script>
<div style="padding:5px;text-align:center">
	<table border="0" cellpadding="0" cellspacing="8" align="center">
		<tr>
			<td>

				<table border="0" cellpadding="2" cellspacing="2" style="font-size:14px">
					<tr>
						<td>Program</td>
						<td>:</td>
						<td><?php echo $program->name ?></td>
					</tr>
					<tr>
						<td>Unit</td>
						<td>:</td>
						<td><?php echo !empty($unit) ? $unit->org_name : $program->org_name ?></td>
					<tr>
						<td>Bagian / Lab</td>
						<td>:</td>
						<td><?php echo !empty($lab) ? $lab->org_name : '' ?></td>
					</tr>
					<tr>
						<td>Type</td>
						<td>:</td>
						<td><?php echo $review->type ?></td>
					</tr>
					<tr>
						<td>File</td>
						<td>:</td>
						<td><?php echo anchor('uploads/default/review/' . $review->files, $review->files, 'target="_blank"') ?></td>
					</tr>
					<tr>
						<td>Description</td>
						<td>:</td>
						<td><?php echo $review->description ?></td>
					</tr>
					<tr>
						<td colspan="3" style="padding:10px"><b>Comment</b></td>
					</tr>
					<?php foreach($comments as $comm) : ?>
					<tr>
						<td colspan="3" style="padding:10px;font-size:12px">
							By: <?php echo $comm->name ?>, RESEARCHER DIGITAL ECOSYSTEM ANALISYS<br>
							<?php echo $comm->timestamp ?><br>
							<?php echo $comm->content ?>
						</td>
					</tr>
					<?php endforeach ?>
				</table>
			</td>
		</tr>
	</table>
</div>