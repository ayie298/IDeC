<script>
	$(function(){
	   <?php if($this->session->userdata('level')!="researcher" && !empty($detail) && !$detail_view){?>$("#btn_add1,#btn_draft").jqxButton({ height: 28, theme: theme });<?php }?>
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_proj', type: 'number' },
			{ name: 'id_emp', type: 'number' },
			{ name: 'employee.name', type: 'string' },
			{ name: 'nik', type: 'string' },
			{ name: 'title', type: 'string' },
			{ name: 'position', type: 'string' }
        ],
		url: "<?php echo site_url('researcher/project/member_json/' . $id_project); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_member").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_member").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_member").jqxGrid(
		{		
			width: '100%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false, pagesizeoptions: ['10', '25', '50', '100', '200'],
			showfilterrow: true, filterable: true, sortable: true, autoheight: true, pageable: true, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				<?php if($this->session->userdata('level')!="researcher"){?>{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_member").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='selectmember("+dataRecord.id_emp+","+dataRecord.id_proj+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='delmember("+dataRecord.id+");'></a></div>";
                 }
                },<?php }?>
				{ text: 'NIK', datafield: 'nik', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Name', datafield: 'employee.name', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Title ', datafield: 'title', columntype: 'textbox', filtertype: 'textbox', width: '40%' },
				{ text: 'Position ', datafield: 'position', columntype: 'textbox', filtertype: 'textbox', width: '20%' }
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_member").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_member").jqxGrid('updatebounddata', 'cells');
		});

		$('#btn_add1').click(function () {
			add_member(1);
		});

	});

	function add_member(id){
		$("#popupmember_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.get("<?php echo site_url('researcher/project_member/add/' . $id_project);?>", function(response) {
			$("#popupmember_content").html(response);
		});
		$("#popupmember").jqxWindow({
			theme: theme, resizable: false,
			width: 800,
			height: 550,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popupmember").jqxWindow('open');
	}

	function projectlist(id, status){
		$("#popupmember2_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.post("<?php echo site_url('researcher/project_member/ongoing');?>", 'id_emp=' + id + '&status=' + status, function(response) {
			$("#popupmember2_content").html(response);
		});
		$("#popupmember2").jqxWindow({
			theme: theme, resizable: false,
			width: 800,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popupmember2").jqxWindow('open');
	}

	function selectmember(id, id_project){
		$("#popupmember2_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
		$.post("<?php echo site_url('researcher/project_member/select/');?>", "id="+id+"&id_project="+id_project, function(response) {
			$("#popupmember2_content").html(response);
		});
		$("#popupmember2").jqxWindow({
			theme: theme, resizable: false,
			width: 800,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popupmember2").jqxWindow('open');
	}

	function selected(id){
		$("#popupmember").jqxWindow('close');
		$("#popupmember2").jqxWindow('close');
	}

	function detailmember(id){
		document.location.href="<?php echo base_url();?>idec_rms/researcher_detail/"+id;
	}

	function delmember(id){
		var confirms = confirm("Delete Team member?");
		if(confirms == true){
			$.post('<?php echo site_url("researcher/project/delete_team") ?>', 'id=' + id, function(){
				alert('data berhasil dihapus');

				$("#jqxgrid_member").jqxGrid('updatebounddata', 'cells');
			});
		}
	}

	function editmember(id){
		$('#btn_add1').click();
	}

</script>
<div id="popupmember" style="display:none">
	<div id="popumember_title">Project Member</div><div id="popupmember_content">{popup}</div>
</div>
<div id="popupmember2" style="display:none">
	<div id="popumember2_title">Member Project List</div><div id="popupmember2_content">{popup}</div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<?php if($this->session->userdata('level')!="researcher"){?>
		<div style="float:right;padding:2px">
			<?php if(empty($detail)) : ?>
			<!--<button style='width:150px' id='btn_draft' type='button'>SEND DRAFT</button>-->
			<button style='width:250px' id='btn_add1' type='button'>ADD RESEARCHER ALLOCATION</button>
			<?php endif; ?>
		</div>
		<?php } ?>
        <div id="jqxgrid_member"></div>
	</div>
</div>