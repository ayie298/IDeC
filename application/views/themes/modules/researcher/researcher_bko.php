<script>
	$(function(){
	   $("#btn_add_bko").jqxButton({ height: 28, theme: theme });

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_employee', type: 'number' },
			{ name: 'org_name', type: 'string' },
			{ name: 'bagian_org', type: 'string' },
			{ name: 'title', type: 'string' },
			{ name: 'year', type: 'number' }
        ],
		url: "<?php echo site_url('researcher/detail/bko_json/' . $id_employee); ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_bko").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_bko").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_bko").jqxGrid(
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
				    var dataRecord = $("#jqxgrid_bko").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='editbko("+dataRecord.id_employee+","+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='delbko("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Year ', datafield: 'year', columntype: 'textbox', filtertype: 'textbox', width: '10%' },
				{ text: 'Unit / Bidang', datafield: 'org_name', columntype: 'textbox', filtertype: 'textbox', width: '30%' },
				{ text: 'Lab', datafield: 'bagian_org', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Title ', datafield: 'title', columntype: 'textbox', filtertype: 'textbox', width: '30%' }
            ]
		});
        
		$('#btn_add_bko').click(function () {
			editbko(<?php echo $id_employee ?>, 0);
		});

	});

	function editbko(id_emp, id){
		var offset = $("#jqxgrid").offset();
		$.get("<?php echo site_url('researcher/detail/add_bko');?>", 'id_emp=' + id_emp + '&id='+id, function(response) {
			$("#popupexp_content").html(response);
		});
		$("#popupexp").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popupexp").jqxWindow('open');
	}

	function delbko(id){
		var confirms = confirm("Delete BKO history?");
		if(confirms == true){
			$.post('<?php echo site_url("researcher/detail/delete/") ?>', 'id='+id, function(){
				alert('data deleted');

				$("#jqxgrid_bko").jqxGrid('updatebounddata', 'cells');
			});
		}
	}

</script>
<div id="popupexp" style="display:none">
	<div id="popupexp_title">Researcher BKO</div>
	<div id="popupexp_content"></div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;padding:2px">
			<button id='btn_add_bko' type='button'>NEW BKO RESEARCHER</button>
		</div>
        <div id="jqxgrid_bko"></div>
	</div>
</div>