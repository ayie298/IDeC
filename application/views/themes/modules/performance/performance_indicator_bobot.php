<script>
	$(function(){
       $("#bar_profile").click();
	   $("#clearfilteringbutton, #refreshdatabutton,#btn_add,#btn_back").jqxButton({ height: 28, theme: theme });

	   var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number' },
			{ name: 'perspective', type: 'string' },
			{ name: 'level', type: 'number' },
			{ name: 'tw1', type: 'string' },
			{ name: 'tw2', type: 'string' },
			{ name: 'tw3', type: 'string' },
			{ name: 'tw4', type: 'string' },
			{ name: 'total', type: 'string' }
        ],
		url: "<?php echo site_url('performance/bobot/json/' . md5($performance->id_performance_system)); ?>",
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
			width: '100%',
			selectionmode: 'singlerow',
			source: dataadapter, theme: theme,columnsresize: true,showtoolbar: false,
			showfilterrow: false, filterable: false, sortable: true, autoheight: true, pageable: false, virtualmode: true, editable: false,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Perspective', datafield: 'perspective', filtertype: 'textbox', sortable: false, width: '30%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					if(dataRecord.level==3){
						return "<div style='width:100%;padding-top:2px;text-align:center'>"+dataRecord.perspective+"</div>";
					}else if(dataRecord.level==2){
						return "<div style='width:100%;padding-top:2px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+dataRecord.perspective+"</div>";
					}else if(dataRecord.level==1){
						return "<div style='width:100%;padding-top:2px;'>&nbsp;"+dataRecord.perspective+"</div>";
					}else{
						return "<div style='width:100%;padding-top:2px;'>&nbsp;</div>";
					}
                 }
				},
				{ text: 'TW-I', datafield: 'tw1', columntype: 'textbox', filtertype: 'textbox', width: '12%', align: 'center' },
				{ text: 'TW-II', datafield: 'tw2', columntype: 'textbox', filtertype: 'textbox', width: '12%', align: 'center'},
				{ text: 'TW-III', datafield: 'tw3', columntype: 'textbox', filtertype: 'textbox', width: '12%', align: 'center'},
				{ text: 'TW-IV', datafield: 'tw4', columntype: 'textbox', filtertype: 'textbox', width: '12%', align: 'center'},
				{ text: 'Total', datafield: 'total', columntype: 'textbox', filtertype: 'textbox', width: '12%', align: 'center'},
				
                
            ]
		});
        
		$('#clearfilteringbutton').click(function () {
			$("#jqxgrid").jqxGrid('clearfilters');
		});
        
 		$('#refreshdatabutton').click(function () {
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		});

 		$('#btn_add').click(function () {
			window.location.href="<?php echo base_url();?>idec_pms/performance_new";
		});

 		$('#btn_back').click(function () {
			window.location.href="<?php echo site_url('performance/indicator/update/' . $performance->id_performance_system);?>";
		});

	});

	function add(id, id_pers){
		window.location.href="<?php echo site_url('performance/indicator/add');?>/" + id + '/' + id_pers;
	}

	function edit(id, id_pers){
		window.location.href="<?php echo site_url('performance/indicator/edit/');?>/" + id;
	}

	function detail(){
		window.location.href="<?php echo base_url();?>idec_pms/performance_indicator_detil";
	}

	function close_dialog(s){
		$("#popup").jqxWindow('close');
		if(s==1){
			$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
		}
	}
</script>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Performance Indicator
	   </h3>
   </div>
</div>
<div class="row-fluid">
	<?php $notice = $this->session->flashdata('notice') ?>
	<?php echo !empty($notice) ? '<div class="alert">'.$this->session->flashdata('notice') : '' ?>
</div>
<div id="popup" style="display:none"><div id="popup_title">Indicator</div><div id="popup_content">{popup}</div></div>
<div>
	<?php echo form_open() ?>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:left;position:relative;width:450px;padding:5px;height:90px">
			<div style="font-size:14px">Performance System</div>
			<div style="font-size:20px"><a>Sub Unit <?php echo $performance->org_name ?></a></div>
			<div style="font-size:18px;padding-top:30px">Edit Indicator</div>
		</div>
		<div style="float:right;text-align:right;position:relative;width:250px;padding-right:10px;padding-top:70px">
			<?php if($this->session->userdata('level')!="researcher"){ ?>
			<input type="submit" name="submit" value="Save Weight" />
			<?php } ?>
			<input style="padding: 5px;" value=" Back " id="btn_back" type="button" />
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="jqxgrid"></div>
	</div>
	<br>
	<br>
	<br>
	</form>
</div>