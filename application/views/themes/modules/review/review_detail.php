<script type="text/javascript">
    $(document).ready(function(){
		$('#btn_back').click(function () {
			document.location.href="<?php echo site_url('review');?>";
		});
	   $("#btn_add,#btn_back").jqxButton({ height: 28, theme: theme });

	   showGrid();

        
		$('#btn_add').click(function () {
			add(<?php echo $program->id_program ?>);
		});

		$('.btn_filter').change(function() {
	   		$.ajax({
	   			url : "<?php echo current_url();?>",
	   			type : "POST",
	   			data : $('.filter-form').serialize(),
	   			success : function() {
	   				$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
	   			}
	   		})

	   		return false;
	   })

	});

    function showGrid()
    {
    	var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number'},
			{ name: 'id_encrypt', type: 'string'},
			{ name: 'type', type: 'string'},
			{ name: 'files', type: 'string'},
			{ name: 'comment', type: 'string'},
			{ name: 'date', type: 'date'}
        ],
		url: "<?php echo site_url('review/detail/json/' . md5($program->id_program)); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
        pagesize: 10,
        beforeprocessing: function(data){		
			if (data != null){
				source.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var dataadapter = new $.jqx.dataAdapter(source, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});
     
		$("#jqxgrid").jqxGrid(
		{		
			width: '1100',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Show', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif' onclick='detail("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Comment', align: 'center', filtertype: 'none', sortable: false, width: '8%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit("+dataRecord.id+");'></a></div>";
                 }
                },<?php if($this->session->userdata('level')!="researcher"){?>
				{ text: 'Del', align: 'center', filtertype: 'none', sortable: false, width: '4%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0)'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='del("+dataRecord.id+");'></a></div>";
                 }
                },<?php } ?>
				{ text: 'Date', datafield: 'date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy-MM-dd', width: '9%'},
				{ text: 'Type', datafield: 'type', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'File', datafield: 'files', columntype: 'textbox', filtertype: 'textbox', width: '37%' },
				{ text: 'Comment', datafield: 'comment', columntype: 'textbox', filtertype: 'textbox', width: '18%' }
            ]
		});
    }
	function closepopup(){
		$("#popup").jqxWindow('open');
	}

	function edit(id){
		$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url() ?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.post("<?php echo site_url('review/detail/comment/');?>", 'id=' + id, function(response) {
			$("#popup_content").html(response);
		});
		$("#popup").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 500,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup").jqxWindow('open');
	}

	function add(id){
		$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url() ?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.post("<?php echo site_url('review/detail/add/');?>", 'id=' + id, function(response) {
			$("#popup_content").html(response);
		});
		$("#popup").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 500,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup").jqxWindow('open');
	}

	function detail(id){
		$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url() ?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.post("<?php echo site_url('review/detail/show');?>", 'id=' + id, function(response) {
			$("#popup_content").html(response);
		});
		$("#popup").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 500,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup").jqxWindow('open');
	}

	function del(id){
		var confirms = confirm("Delete review?");
		if(confirms == true){
			$.post('<?php echo site_url("review/detail/delete") ?>', 'id='+id, function(){
				alert('data deleted');

				$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
			});
		}
	}
</script>
<style type="text/css">
.white {
    background: white;
	font-size:14px;
}

</style>
<div id="popup" style="display:none">
	<div id="popup_title">Review Management</div><div id="popup_content"><?php echo $popup ?></div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Review Management
	   </h3>
   </div>
</div>
<div class="row-fluid">
   <div class="span12">
		 <?php echo $this->session->flashdata('notice') == "" ? "" : '<div class="alert">' . $this->session->flashdata('notice') . '</div>'; ?>
   </div>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
    <table width='100%' cellpadding='4' cellspacing='2' border='0' style="border: 1px solid rgb(204,209,205);background: rgb(244,244,244);font-size:12px;">
    <tr>
        <td colspan="3" style="font-size:24px"><?php echo $program->name ?></td>
    </tr>
    <tr id="td_proses" height="30">
        <td colspan="3" align="right">
			<button id='btn_back' type='button'>KEMBALI</button>
		</td>
    </tr>
	<tr valign="top">
		<td width='18%'>Program Name</td>
		<td width='1%'>:</td>
		<td class="white"><?php echo $program->name ?></td>
	</tr>
   <tr valign="top">
		<td width='18%'>Unit</td>
		<td width='1%'>:</td>
		<td class="white"><?php echo !empty($unit) ? $unit->org_name : $program->org_name ?></td>
	</tr>
   <tr valign="top">
		<td width='18%'>Bagian / Lab</td>
		<td width='1%'>:</td>
		<td class="white"><?php echo !empty($lab) ? $lab->org_name : '' ?></td>
	</tr>
    </table>
</div>
<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
	<div style="position:relative;width:50%;float:left;padding-top:5px;padding-bottom:5px;font-size:18px">Review</div>
	<div style="position:relative;width:50%;text-align:right;padding-top:5px;padding-bottom:5px;float:right">
		<?php echo form_open('', 'class="filter-form"') ?>
			<select size="1" class="btn_filter" name="type" style="width:300px;margin-top:10px;">
				<option value="">Filter Type</option>
				<?php foreach($types as $type) : ?>
					<option value="<?php echo $type->id_mas_review_type ?>"><?php echo $type->type ?></option>
				<?php endforeach ?>
			</select>
		<button id='btn_add' type='button'>ADD REVIEW</button>
		</form>
	</div>
	<div id="jqxgrid"></div>
</div>
