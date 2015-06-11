<script>
	$(function(){
	   $("#btn_add_exp").jqxButton({ height: 28, theme: theme });

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_employee', type: 'number' },
			{ name: 'work_type', type: 'string' },
			{ name: 'category', type: 'string' },
			{ name: 'start_year', type: 'number' },
			{ name: 'end_year', type: 'number' },
			{ name: 'job_desk', type: 'string' },
        ],
		url: "<?php echo site_url('researcher/detail/work_json/' . $id_employee); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_experience").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_experience").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_experience").jqxGrid(
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
				{ text: '#', align: 'center', filtertype: 'none', sortable: false, width: '5%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_experience").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='editexp("+dataRecord.id_employee+","+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='delexp("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Description', datafield: 'job_desk', columntype: 'textbox', filtertype: 'textbox', width: '30%' },
				{ text: 'Type', datafield: 'work_type', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Category ', datafield: 'category', columntype: 'textbox', filtertype: 'textbox', width: '20%' },
				{ text: 'Start Year ', datafield: 'start_year', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'End Year ', datafield: 'end_year', columntype: 'textbox', filtertype: 'textbox', width: '10%' }
            ]
		});
        
		$('#btn_add_exp').click(function () {
			editexp(<?php echo $id_employee ?>,0);
		});
	});

	function editexp(id_emp, id){
		var offset = $("#jqxgrid").offset();
		$.get("<?php echo site_url('researcher/detail/add_work');?>",'id_emp=' + id_emp +'&id=' + id, function(response) {
			$("#popupexp_content2").html(response);
		});
		$("#popupexp2").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 420,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popupexp2").jqxWindow('open');
	}

	function delexp(id){
		var confirms = confirm("Delete Exeprience?");
		if(confirms == true){
			$.post('<?php echo site_url("researcher/detail/delete_work/") ?>', 'id='+id, function(){
				alert('data deleted');

				$("#jqxgrid_experience").jqxGrid('updatebounddata', 'cells');
			});
		}
	}

</script>
<div id="popupexp2" style="display:none">
	<div id="popupexp_title2">Researcher Experience</div>
	<div id="popupexp_content2"></div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;padding:2px">
			<button id='btn_add_exp' type='button'>ADD EXPERIENCE</button>
		</div>
        <div id="jqxgrid_experience"></div>
	</div>
</div>