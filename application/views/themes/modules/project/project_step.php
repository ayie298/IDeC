<script>
	$(function(){
	   <?php if($this->session->userdata('level')!="researcher" && !empty($detail) && !$detail_view){?>$("#btn_add2").jqxButton({ height: 28, theme: theme });<?php }?>
	   
	   showGrid();
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid_step").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid_step").jqxGrid('updatebounddata', 'cells');
		});

	});

	function showGrid()
	{
		var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_project', type: 'number' },
			{ name: 'id_encrypt', type: 'string' },
			{ name: 'step_name', type: 'string' },
			{ name: 'weight', type: 'string' },
			{ name: 'step_description', type: 'string' },
			{ name: 'start_date', type: 'date' },
			{ name: 'end_date', type: 'date' }
        ],
		url: "<?php echo site_url('researcher/project/step_json/' . $id_project); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_step").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_step").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_step").jqxGrid(
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
				    var dataRecord = $("#jqxgrid_step").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit_step("+dataRecord.id_project+","+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='del_step("+dataRecord.id_project+",\""+dataRecord.id_encrypt+"\");'></a></div>";
                 }
                },<?php }?>
				{ text: 'Name', datafield: 'step_name', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Description', datafield: 'step_description', columntype: 'textbox', filtertype: 'textbox', width: '36%' },
				{ text: 'Bobot', datafield: 'weight', columntype: 'textbox', filtertype: 'textbox', width: '6%' },
				{ text: 'Date Start', datafield: 'start_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '14%' },
				{ text: 'Date End', datafield: 'end_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy/MM/dd', width: '14%' }
            ]
		});
	}

	function del_step(id_emp, id){
		var confirms = confirm("Delete Step?");
		if(confirms == true){
			$.get('<?php echo site_url("researcher/project/delete_step/") ?>/' + id_emp + '/' + id, '', function(){
				alert('data deleted');

				showGrid();
			});
		}
	}

	function edit_step(id_project, id){
			$("#popup_title").html("Step Project");
			$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
			var offset = $("#jqxgrid").offset();
			$.get("<?php echo site_url('researcher/project/add_step');?>/"+id+"?id=" + id_project, function(response) {
				$("#popup_content").html(response);
			});
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 350,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');
		}

</script>
<div id="popupstep" style="display:none">
	<div id="popupstep_title">Step Project</div><div id="popupstep_content">{popup}</div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<?php if($this->session->userdata('level')!="researcher" && !empty($project) && empty($detail)){?>
		<div style="float:right;padding:2px">
			<button style='width:200px' id='btn_add2' type='button'>ADD NEW STEP</button>
		</div><?php }?>
        <div id="jqxgrid_step"></div>
	</div>
</div>