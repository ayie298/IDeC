<script type="text/javascript">
    $(document).ready(function(){
		$("#btn_simpan,#btn_ulang").jqxInput({ theme: 'fresh', height: '30px', width: '100px' }); 
		$("#btn_simpan,#btn_ulang").click(function(){
			closepopup();
		});

		$("#btn_ulang").click(function(){
			$("#popup").jqxWindow('close');
		})
	});
</script>
<script type="text/javascript">
    $(function(){
        $('#form-comment  form').submit(function(){
            $.post('<?php echo site_url('review/detail/comment') ?>', $('#form-comment form').serialize()+'&btn_simpan=send', function(data){
                var obj = $.parseJSON(data);
                
                if(obj.error == 1) {
                    $('.notice').html('<div class="alert">' + obj.notice + '</div>');
                } else {
                    $.post('<?php echo site_url('review/detail/comment_ajax') ?>', 'id='+obj.id_review, function(response){
                    	$('#form-comment').html(response);
                    })
                    alert(obj.notice);
                    $("#jqxgrid").jqxGrid('updatebounddata', 'filter');
                }
            });

            return false;
        });
    });
</script>
<?php echo form_open('review/detail/comment') ?>
<input type="hidden" name="id" value="<?php echo $id_review ?>" />
<input type="hidden" name="id_program" value="<?php echo $review->id_program ?>" />
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
					<tr>
						<td colspan="3" style="padding:10px"><textarea name="comment" placeholder="Comment" rows="3" cols="70" style="width:99%"/></textarea></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<input type="submit" id="btn_simpan" name="btn_simpan" value=" SEND " />
	<button type="reset" id="btn_ulang"> CLOSE </button>
</form>