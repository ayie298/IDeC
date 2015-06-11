<script>
	$(function(){
	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'id_emp', type: 'number' },
			{ name: 'cer_name', type: 'string' },
			{ name: 'certificate.name', type: 'string' },
			{ name: 'organizer', type: 'string' },
			{ name: 'is_down', type: 'boolean' },
			{ name: 'file', type: 'string' },
			{ name: 'expired_date', type: 'date' }
        ],
		url: "<?php echo base_url(); ?>idec/employee/certificate?id=<?php echo md5($employee->id_employee) ?>",
		cache: false,
		updaterow: function (rowid, rowdata, commit) {
			},
		filter: function(){
			$("#jqxgrid_certificate").jqxGrid('updatebounddata', 'filter');
		},
		sort: function(){
			$("#jqxgrid_certificate").jqxGrid('updatebounddata', 'sort');
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
     
		$("#jqxgrid_certificate").jqxGrid(
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
				    var dataRecord = $("#jqxgrid_certificate").jqxGrid('getrowdata', row);
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit_certificate("+dataRecord.id_emp+","+dataRecord.id+");'></a> <a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/del.gif' onclick='del_certificate("+dataRecord.id+");'></a></div>";
                 }
                },
				{ text: 'Name', datafield: 'cer_name', columntype: 'textbox', filtertype: 'textbox', width: '28%' },
				{ text: 'Category', datafield: 'certificate.name', columntype: 'textbox', filtertype: 'textbox', width: '25%' },
				{ text: 'Organizer ', datafield: 'organizer', columntype: 'textbox', filtertype: 'textbox', width: '22%' },
				{ text: 'Expired Date ', datafield: 'expired_date', columntype: 'date', filtertype: 'date', cellsformat: 'yyyy-MM-dd', width: '10%' },
				{ text: 'Download ',  filtertype: 'none', sortable: false, width: '10%' , cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid_certificate").jqxGrid('getrowdata', row);
				    if(dataRecord.is_down) {
						return "<div style='width:100%;padding-top:2px;text-align:center'><a href='<?php echo base_url() ?>uploads/default/"+dataRecord.file+"' target=_blank''><img border=0 src='<?php echo base_url(); ?>public/images/download.gif'></a></div>";
					}
                 }
                }
            ]
		});
        
		$('#btn_add2').click(function () {
			add_certificate('<?php echo $employee->id_employee ?>');
		});

	});

	function edit_certificate(id_emp, id){
		$.post("<?php echo site_url('idec/certificate/add/') ?>/" + id_emp + '/' + id, function(response) {
			$("#popup_certificate_content").html(response);
		});
		$("#popup_certificate").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_certificate").jqxWindow('open');
	}

	function add_certificate(id){
		$.get("<?php echo site_url('idec/certificate/add/') ?>/" + id, function(response) {
			$("#popup_certificate_content").html(response);
		});
		$("#popup_certificate").jqxWindow({
			theme: theme, resizable: false,
			width: 600,
			height: 350,
			isModal: true, autoOpen: false, modalOpacity: 0.2
		});
		$("#popup_certificate").jqxWindow('open');
	}

	function del_certificate(id){
		var confirms = confirm("Delete Certificate?");
		if(confirms == true){
			$.post('<?php echo site_url("idec/certificate/delete/") ?>', 'id=' + id, function(){
				alert('data berhasil dihapus');

				$("#jqxgrid_certificate").jqxGrid('updatebounddata', 'cells');
			});
		}
	}

</script>
<div id="popup_certificate" style="display:none">
	<div id="popup_certificate_title">Researcher Certificate</div>
	<div id="popup_certificate_content"></div>
</div>
<div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;padding:2px">
			<input type="button" style='width:180px' id='btn_add2' value='ADD NEW'>
		</div>
        <div id="jqxgrid_certificate"></div>
	</div>
</div>