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
			{ name: 'id_pers', type: 'number' },
			{ name: 'perspective', type: 'string' },
			{ name: 'level', type: 'number' },
			{ name: 'tw1', type: 'string' },
			{ name: 'tw2', type: 'string' },
			{ name: 'tw3', type: 'string' },
			{ name: 'tw4', type: 'string' },
			{ name: 'total', type: 'string' }
        ],
		url: "<?php echo site_url('performance/indicator/json/' . md5($performance->id_performance_system)); ?>",
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
				{ text: 'TW-I', datafield: 'tw1', columntype: 'textbox', filtertype: 'textbox', width: '10%', align: 'center' },
				{ text: 'TW-II', datafield: 'tw2', columntype: 'textbox', filtertype: 'textbox', width: '10%', align: 'center'},
				{ text: 'TW-III', datafield: 'tw3', columntype: 'textbox', filtertype: 'textbox', width: '10%', align: 'center'},
				{ text: 'TW-IV', datafield: 'tw4', columntype: 'textbox', filtertype: 'textbox', width: '10%', align: 'center'},
				{ text: 'Total', datafield: 'total', columntype: 'textbox', filtertype: 'textbox', width: '10%', align: 'center'},
				{ text: 'Action', align: 'center', filtertype: 'none', sortable: false, width: '20%', cellsrenderer: function (row) {
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
				    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
					if(dataRecord.level==2){
						<?php if($this->session->userdata('level')!="researcher"){ ?>
							return "<div style='width:100%;padding-top:2px;text-align:center'> <button class='btn' onClick='detail("+dataRecord.id+")'>Detail</button> <button class='btn' onClick='add(<?php echo $performance->id_performance_system ?>,"+dataRecord.id_pers+","+dataRecord.id+")'>Add New</button>  <button class='btn' onClick='edit("+dataRecord.id+")'>Edit</button> <button class='btn'>Delete</button></div>";
						<?php }else{ ?>
							return "<div style='width:100%;padding-top:2px;text-align:center'> <button class='btn' onClick='detail("+dataRecord.id+")'>Detail</button></div>";
						<?php } ?>
					}else if(dataRecord.level==3){
						<?php if($this->session->userdata('level')!="researcher"){ ?>
							return "<div style='width:100%;padding-top:2px;text-align:center'> <button class='btn' onClick='detail("+dataRecord.id+")'>Detail</button>  <button class='btn' onClick='edit("+dataRecord.id+")'>Edit</button> <button class='btn'>Delete</button></div>";
						<?php }else{ ?>
							return "<div style='width:100%;padding-top:2px;text-align:center'> <button class='btn' onClick='detail("+dataRecord.id+")'>Detail</button></div>";
						<?php } ?>
					}else if(dataRecord.level==1){
						<?php if($this->session->userdata('level')!="researcher"){ ?>return "<div style='width:100%;padding-top:2px;text-align:center'><button class='btn' onClick='add(<?php echo $performance->id_performance_system ?>,"+dataRecord.id+")'>Add New</button></div>";<?php }?>
					}else{
						return "<div style='width:100%;padding-top:2px;text-align:center'>&nbsp;</div>";
					}
                 }
                }
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
			window.location.href="<?php echo site_url('performance/detail/' . md5($performance->id_performance_system));?>";
		});

	});

	function add(id, id_pers, id_parent){
		var pers = id_parent == undefined ? "" : id_parent;

		window.location.href="<?php echo site_url('performance/indicator/add');?>/" + id + '/' + id_pers + '/' + pers;
	}

	function edit(id, id_pers){
		window.location.href="<?php echo site_url('performance/indicator/edit/');?>/" + id;
	}

	function detail(id){
		window.location.href="<?php echo site_url('performance/indicator/detail/');?>/" + id;
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
<div id="popup" style="display:none"><div id="popup_title">Indicator</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:left;position:relative;width:450px;padding:5px;height:90px">
			<div style="font-size:14px">Performance System</div>
			<div style="font-size:20px"><a>Sub Unit <?php echo $performance->org_name ?></a></div>
			<div style="font-size:18px;padding-top:30px">Edit Indicator</div>
		</div>
		<div style="float:right;text-align:right;position:relative;width:250px;padding-right:10px;padding-top:70px">
			<?php if($this->session->userdata('level')!="researcher"){ ?>
			<a href="<?php echo site_url('performance/bobot/update/' . md5($performance->id_performance_system)) ?>"><input style="padding: 5px;" value=" Edit Weight " id="btn_adds" type="button" /></a>
			<input style="padding: 5px;" value=" Add New Indicator " id="btn_add" type="button" /><?php } ?>
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
</div>