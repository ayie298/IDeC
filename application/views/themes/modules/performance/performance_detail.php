<script>
	$(function(){
       $("#bar_pms").click();
	   $("#clearfilteringbutton, #refreshdatabutton").jqxButton({ height: 28, theme: theme });
	   <?php if($this->session->userdata('level')!="researcher"){ ?>
		   $("#btn_list,#btn_new,#btn_show").jqxButton({ height: 28, theme: theme });
	   <?php } ?>
	   $("#btn_indicator, #btn_edit,#btn_show_detail,#btn_show_edit,#btn_realization,#btn_analysis").jqxButton({ height: 28, theme: theme });

		$('#btn_analysis').click(function () {
			$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url();?>media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
			var offset = $("#jqxgrid").offset();
			$.get("<?php echo site_url('performance/indicator/analysis/');?>/" + $(this).attr('value'), function(response) {
				$("#popup_content").html(response);
			});
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 420,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');

		});

		$('#btn_list').click(function () {
			document.location.href="<?php echo site_url('performance');?>";
		});
        
		$('#btn_new').click(function () {
			document.location.href="<?php echo site_url('performance/system/update');?>";
		});
        
		$('#btn_edit').click(function () {
			document.location.href="<?php echo site_url('performance/system/update/' . $performance->id_performance_system);?>";
		});
        
		$('#btn_show_edit').click(function () {
			document.location.href="<?php echo site_url('performance/indicator/edit/');?>/" + $(this).attr('value');
		});
        
		$('#btn_show_detail').click(function () {
			document.location.href="<?php echo site_url('performance/target/edit/');?>/" + $(this).attr('value');
		});

		$('#btn_realization').click(function () {
			document.location.href="<?php echo site_url('performance/target/edit/');?>/" + $(this).attr('value');
		});

		var source = {
			datatype: "json",
			type	: "POST",
			datafields: [
			{ name: 'urut'},
			{ name: 'id', type: 'number'},
			{ name: 'parent', type: 'number'},
			{ name: 'perspective', type: 'string'},
			{ name: 'measure', type: 'string'},
			{ name: 'indicator', type: 'string'},
			{ name: 'formula', type: 'string'},
			{ name: 'weight', type: 'number'},
			{ name: 'target', type: 'number'},
			{ name: 'achievement', type: 'number'},
			{ name: 'accomplishment', type: 'number'}
        ],
			hierarchy:
			{
				keyDataField: { name: 'id' },
				parentDataField: { name: 'parent' }
			},
			id: 'id',
			root: 'Rows',
			url: "<?php echo site_url('performance/detail/json/' . md5($performance->id_performance_system)); ?>",
			cache: false
		};
     
		var dataadapter = new $.jqx.dataAdapter(source, {
			loadError: function(xhr, status, error){
				alert(error);
			}
		});

		var cellsRendererFunction = function (row, dataField, cellValue, rowData, cellText) {
			i = rowData.achievement; 
			if(i>0){
				if(i>100)i=100;
				if(i>85){
					color="#00cc00";
				}else if(i>75){
					color="#ffff00";
				}else if(i>65){
					color="#ffcc00";
				}else{
					color="#ff6600";
				}
				return "<div style='position:relative;float:left;width:" + i  + "%;height:100%;background:"+color+";'>&nbsp;</div><div style='position:absolute;float:left;width:80px;height:20px;text-align:center;color:#111;'>" + i  + " %</div>";
			}
		}
/*
		$("#treeGrid").jqxTreeGrid(
            {
                width: '99%',
                source: dataadapter,
                sortable: true,
				columnsResize: true,
                ready: function()
                {
                    $("#treeGrid").jqxTreeGrid('expandRow', '1');
                    $("#treeGrid").jqxTreeGrid('expandRow', '3');
                    $("#treeGrid").jqxTreeGrid('expandRow', '8');
                    $("#treeGrid").jqxTreeGrid('expandRow', '17');
                },
                columns: [
				{ text: 'Perspective', datafield: 'perspective', width: '18%' },
				{ text: 'Performance Indicator', datafield: 'indicator', width: '32%' },
				{ text: 'Formula', datafield: 'formula', width: '7%' },
				{ text: 'Measure', datafield: 'measure', width: '7%' },
				{ text: 'Weight', datafield: 'weight', width: '7%' },
				{ text: 'Target', datafield: 'target', width: '7%' },
				{ text: 'Achievement', width: '7%', cellsrenderer:  cellsRendererFunction },
				{ text: 'Accomplishment', datafield: 'accomplishment', width: '7%' },
				{ text: 'Edit', width: '4%', cellsrenderer: function (row) {
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='javascript:void(0);'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit();'></a> </div>";
                 }
                },
				{ text: 'Show', width: '4%', cellsrenderer: function (row) {
					return "<div style='width:100%;padding-top:2px;text-align:center'><a href='#summary'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif'></a></div>";
                 }
                }
                ]
            });
*/
		$('.percentage_yellow').easyPieChart({
			animate: 1000,
			size: 65,
			barColor:'#ffff00'
		});

		$('.percentage_green').easyPieChart({
			animate: 1000,
			size: 65,
			barColor:'#00cc00'
		});

		$('.percentage_red').easyPieChart({
			animate: 1000,
			size: 65,
			barColor:'#ff0000'
		});

		$('.percentage_orange').easyPieChart({
			animate: 1000,
			size: 65,
			barColor:'#ff9900'
		});

	});

	function edit(){
		var selection = $("#treeGrid").jqxTreeGrid('getSelection');
		document.location.href="<?php echo base_url();?>performance/target/edit/"+selection[0].id;
	}

	var chart;

	var chartData = [{
		quartal: "TW I",
		target: <?php echo empty($item_tw1) ? 0 : (int) $item_tw1->target ?>,
		realization: <?php echo empty($item_tw1) ? 0 : (int) $item_tw1->achievement_raw ?>,
		max: 105,
		min: 60
	}, {
		quartal: "TW II",
		target: <?php echo empty($item_tw2) ? 0 : (int) $item_tw2->target ?>,
		realization: <?php echo empty($item_tw2) ? 0 : (int) $item_tw2->achievement_raw ?>,
		max: 105,
		min: 60
	}, {
		quartal: "TW III",
		target: <?php echo empty($item_tw3) ? 0 : (int) $item_tw3->target ?>,
		realization: <?php echo empty($item_tw3) ? 0 : (int) $item_tw3->achievement_raw ?>,
		max: 105,
		min: 60
	}, {
		quartal: "TW IV",
		target: <?php echo empty($item_tw4) ? 0 : (int) $item_tw4->target ?>,
		realization: <?php echo empty($item_tw3) ? 0 : (int) $item_tw4->achievement_raw ?>,
		max: 105,
		min: 60
	}];


	AmCharts.ready(function () {
		// SERIAL CHART
		chart = new AmCharts.AmSerialChart();
		chart.dataProvider = chartData;
		chart.categoryField = "quartal";
		chart.startDuration = 0.5;
		chart.balloon.color = "#000000";

		// AXES
		// category
		var categoryAxis = chart.categoryAxis;
		categoryAxis.fillAlpha = 1;
		categoryAxis.fillColor = "#FAFAFA";
		categoryAxis.gridAlpha = 0;
		categoryAxis.axisAlpha = 0;
		categoryAxis.gridPosition = "start";
		categoryAxis.position = "bottom";

		// value
		var valueAxis = new AmCharts.ValueAxis();
		valueAxis.title = "Measure";
		valueAxis.dashLength = 5;
		valueAxis.axisAlpha = 0;
		valueAxis.minimum = 50;
		valueAxis.maximum = 120;
		valueAxis.integersOnly = false;
		valueAxis.gridCount = 10;
		valueAxis.reversed = false; // this line makes the value axis reversed
		chart.addValueAxis(valueAxis);

		// GRAPHS
		// Target graph						            		
		var graph = new AmCharts.AmGraph();
		graph.title = "Target";
		graph.valueField = "target";
		graph.balloonText = "Target [[category]]: [[value]]";
		graph.lineAlpha = 1;
		graph.bullet = "round";
		chart.addGraph(graph);

		// Realization graph
		var graph = new AmCharts.AmGraph();
		graph.title = "Realization";
		graph.valueField = "realization";
		graph.balloonText = "Realization [[category]]: [[value]]";
		graph.bullet = "square";
		chart.addGraph(graph);

		// Max graph
		var graph = new AmCharts.AmGraph();
		graph.title = "Maximum";
		graph.valueField = "max";
		graph.balloonText = "Maximum [[category]]: [[value]]";
		graph.bullet = "square";
		chart.addGraph(graph);

		// Min graph
		var graph = new AmCharts.AmGraph();
		graph.title = "Min";
		graph.valueField = "min";
		graph.balloonText = "Minimum [[category]]: [[value]]";
		graph.bullet = "square";
		chart.addGraph(graph);

		// LEGEND
		var legend = new AmCharts.AmLegend();
		legend.markerType = "circle";
		chart.addLegend(legend);

		// WRITE
		chart.write("chartdiv");

	});

	$(function(){
		$('.perform').change(function(){
			document.location.href="<?php echo site_url('performance/detail/');?>/" + $(this).val();
		});

		$('#btn_evidence').click(function () {
			$("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='http://idec.byethost4.com/media/images/indicator.gif' alt='loading content.. '><br>loading</div>");
			var offset = $("#jqxgrid").offset();
			$.get("<?php echo site_url('performance/system/evidence/');?>", 'id='+$('#btn_evidence').attr('value'), function(response) {
				$("#popup_content").html(response);
			});
			$("#popup").jqxWindow({
				theme: theme, resizable: false,
				width: 600,
				height: 220,
				isModal: true, autoOpen: false, modalOpacity: 0.2
			});
			$("#popup").jqxWindow('open');

		});
	})
</script>
<style>
	#treeGrids table{font-size: 12px!important;}
	#treeGrids td{padding:10px;}
</style>
<div class="row-fluid">
   <div class="span12">
	   <h3 class="page-title">
		 Performance
	   </h3>
   </div>
</div>
<div class="row-fluid">
   <div class="span12">
	   <?php echo $this->session->flashdata('notice') == '' ? '' : '<div class="alert">' . $this->session->flashdata('notice') . '</div>'; ?>
   </div>
</div>
<div id="popup" style="display:none"><div id="popup_title">Performance</div><div id="popup_content">{popup}</div></div>
<div>
	<div style="width:99%;background-color:#EEEEEE;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
		<div style="float:right;position:relative;width:600px;padding-right:10px;height:60px;text-align:right">
			<select size="1" class="input perform" name="performance" style="width:300px;margin-top:8px;">
				<option>Chose Performance</option>
				<?php foreach($allPerformance as $per) : ?>
					<option value="<?php echo md5($per->id_performance_system) ?>">
						<?php echo $per->perform_name ?>
					</option>
				<?php endforeach ?>
			</select>
			<?php if($this->session->userdata('level')!="researcher"){ ?><input value=" Manage List " id="btn_list" type="button" />
			<input value=" Add New " id="btn_new" type="button" />
			<?php } ?>
			<hr style="border:1px solid silver;margin:0;padding:0">
			<?php echo form_open() ?>
			Triwulan : <select size="1" class="input" name="quartal" style="margin-top:8px;width:150px">
				<option value="1" <?php echo $quartal == 1 ? 'selected' : '' ?>>TW I - Maret</option>
				<option value="2" <?php echo $quartal == 2 ? 'selected' : '' ?>>TW II - Juni</option>
				<option value="3" <?php echo $quartal == 3 ? 'selected' : '' ?>>TW III - Sepetember</option>
				<option value="4" <?php echo $quartal == 4 ? 'selected' : '' ?>>TW IV - Desember</option>
			</select>
			<input style="padding: 5px;width:50px;" value=" Go " name="refresh" id="refreshdatabutton" type="submit" />
			</form>
		</div>
		<div style="float:left;position:relative;width:550px;padding:5px;top:45px;height:125px">
			<div style="font-size:20px"><a>Sub Unit <?php echo $performance->org_name . ' ' . date('Y') ?></a></div>
			<br>
			<?php if($this->session->userdata('level')!="researcher"){ ?>
			<a href="<?php echo site_url('performance/indicator/update/' . $performance->id_performance_system) ?>"><input style="padding: 5px;" value=" Edit Indicator List" id="btn_indicator" type="button" /></a>
			<input style="padding: 5px;" value=" Edit Performance System" id="btn_edit" type="button" />
			<?php }?>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="width:99%;background-color:#DDDDDD;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        <div id="treeGrids">
        	<div style="width:99%;background-color:#FFFFFF;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;">
        	<table border="1" width="100%">
        		<tr style="background:#EEEEEE;">
        			<td>Perspective</td>
        			<td>Performance Indicator</td>
        			<td>Formula</td>
        			<td>Measure</td>
        			<td>Weight</td>
        			<td>Target</td>
        			<td>Achievement</td>
        			<td>Accomplishment</td>
        			<td>Edit</td>
        			<td>Show</td>
        		</tr>
        		<?php for($i=0;$i<sizeof($detail);$i++) : ?>
        		<?php
        			$div = "";
        			$im  = $detail[$i]['parent'] != "" ? $detail[$i]['achievement'] : 0;

        			if($im>0){
						if($im>100){$im=100;}
						if($im>85){
							$color="#00cc00";
						}else if($im>75){
							$color="#ffff00";
						}else if($im>65){
							$color="#ffcc00";
						}else{
							$color="#ff6600";
						}

						$div = "<div style='position:relative;float:left;width:" . $im  . "%;height:100%;background:".$color.";'>&nbsp;</div><div style='position:absolute;float:left;width:80px;height:20px;text-align:center;color:#111;'>" . round($im,1)  . " %</div>";
					}
        		?>
        		<tr>
        			<?php $space = $detail[$i]['level'] == 3 ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '' ?>
        			<td><?php echo $detail[$i]['parent'] == "" ? $detail[$i]['perspective'] : "" ?></td>
        			<td><?php echo $detail[$i]['parent'] != "" ? $space.$detail[$i]['indicator'] : "" ?></td>
        			<td><?php echo $detail[$i]['parent'] != "" ? $detail[$i]['formula'] : "" ?></td>
        			<td><?php echo $detail[$i]['parent'] != "" ? $detail[$i]['measure'] : "" ?></td>
        			<td><?php echo $detail[$i]['parent'] != "" ? $detail[$i]['weight'] : "" ?></td>
        			<td><?php echo $detail[$i]['parent'] != "" ? $detail[$i]['target'] : "" ?></td>
        			<td><?php echo $div ?></td>
        			<td><?php echo $detail[$i]['parent'] != "" ? (float) round($detail[$i]['accomplishment']/100,1) : "" ?></td>
        			<td><?php if($detail[$i]['parent'] != "" && $this->session->userdata('level')!='Researcher') : ?><a href='<?php echo site_url('performance/target/edit/' . $detail[$i]['id']) ?>'><img border=0 src='<?php echo base_url(); ?>public/images/edt.gif' onclick='edit();'></a><?php endif ?></td>
        			<td><?php if($detail[$i]['parent'] != "") : ?><a href='#'><img border=0 src='<?php echo base_url(); ?>media/images/16_view.gif'></a><?php endif ?></td>
        		</tr>
        		<?php endfor ?>
        	</table>
        </div>
        </div>
		<br>
		<div style="color:black">Limit Max : &nbsp;&nbsp;105% &nbsp;&nbsp;|&nbsp;&nbsp; Limit Min :&nbsp;&nbsp;60%</div><br>
	</div>
	<div style="clear:both"></div>
	<div style="width:99%;background-color:#FFFFFF;-moz-border-radius:5px;border-radius:5px;padding:2px;border:3px solid #ebebeb;height:1200px">
		<div style="width:47%;position:relative;float:left;padding:15px">
			<div style="font-size:20px"><a name="summary">All Summary</a></div>
			<div style="font-size:16px;padding-top:10px;padding-bottom:10px">Summary For : <?php echo $tw ?> </div>
			<div style="background:#EEEEEE;padding:15px;height:150px">
				<table width="100%" cellpadding="4" cellspacing="4" style="font-size:14px;background:#FFFFFF;border:1px solid #CCC">
					<tr style="font-weight:bold;background:#EEE">
						<td>Perspective</td>
						<td>Bobot</td>
						<td>Target</td>
						<td>Achievement</td>
						<td>Accomplishment</td>
					</tr>
					<?php $total = 0; $totalAcom = 0; ?>
					<?php for($i=0;$i<sizeof($sumPers);$i++) : ?>
					<tr>
						<td><?php echo $sumPers[$i]['perspective']; ?></td>
						<td align="right"><?php echo $sumPers[$i]['total']; ?> %</td>
						<td align="right"><?php echo $sumPers[$i]['target']; ?></td>
						<td align="right"><?php echo round($sumPers[$i]['achievement'],1); ?></td>
						<td align="right"><?php echo round($sumPers[$i]['accomplishment']/100,1); ?></td>
					</tr>
					<?php $total+= $sumPers[$i]['total']; $totalAcom += ($sumPers[$i]['accomplishment']/100); ?>
					<?php endfor ?>
					<tr>
						<td>Total</td>
						<td align="right"><?php echo $total ?> %</td>
						<td align="right">&nbsp;</td>
						<td align="right">&nbsp;</td>
						<td align="right"><?php echo $totalAcom ?></td>
					</tr>
				</table>
			</div>
			<div style="font-size:16px;padding-top:10px;padding-bottom:10px">Overall</div>
			<div style="background:#EEEEEE;padding:15px;height:720px">
				<b>Perspective</b>
				<?php for($i=0;$i<sizeof($perspective);$i++) : ?>
				<div style="padding:10px;clear:both"><?php echo $perspective[$i]['name'] ?><br>
					<div style="padding:12px;position:relative;float:left;width:65px;text-align:center">
						<b>TW I</b>
						<div data-percent="<?php echo $perspective[$i]['tw1'] ?>" class="percentage_red success easyPieChart" style="width: 95px; height: 95px; line-height: 95px;"><span><?php echo $perspective[$i]['tw1'] ?></span>%<canvas height="95" width="95"></canvas></div>
					</div>
					<div style="padding:12px;position:relative;float:left;width:65px;text-align:center">
						<b>TW II</b>
						<div data-percent="<?php echo $perspective[$i]['tw2'] ?>" class="percentage_orange success easyPieChart" style="width: 95px; height: 95px; line-height: 95px;"><span><?php echo $perspective[$i]['tw2'] ?></span>%<canvas height="95" width="95"></canvas></div>
					</div>
					<div style="padding:12px;position:relative;float:left;width:65px;text-align:center">
						<b>TW III</b>
						<div data-percent="<?php echo $perspective[$i]['tw3'] ?>" class="percentage_yellow success easyPieChart" style="width: 95px; height: 95px; line-height: 95px;"><span><?php echo $perspective[$i]['tw3'] ?></span>%<canvas height="95" width="95"></canvas></div>
					</div>
					<div style="padding:12px;position:relative;float:left;width:65px;text-align:center">
						<b>TW IV</b>
						<div data-percent="<?php echo $perspective[$i]['tw4'] ?>" class="percentage_green success easyPieChart" style="width: 95px; height: 95px; line-height: 95px;"><span><?php echo $perspective[$i]['tw4'] ?></span>%<canvas height="95" width="95"></canvas></div>
					</div>
				</div>
				<?php endfor; ?>
			</div>
		</div>
		<div style="width:47%;position:relative;float:right;padding:15px">
			<div style="font-size:14px"><a>Performance Indicator Summary</a></div>
			<div style="font-size:20px;"><?php echo $item ?></div>
			<div style="padding-top:20px;clear:both;text-align:right">
				<?php if(!empty($item_id)) : ?>
					<button id="btn_realization" value="<?php echo $item_id ?>" style=";">Edit Realization</button>
					<button id="btn_show_edit" value="<?php echo $item_id ?>" style=";">Editor Indicator</button>
					<button id="btn_show_detail" value="<?php echo $item_id ?>" style=";">Indicator Detail</button>
				<?php endif; ?>
			</div>
			<div style="background:#EEEEEE;clear:both;margin-top:20px">
				<div style="z-index:999;background:#EEE;width:95%;height:25px;position:absolute">&nbsp;</div>
				<div id="chartdiv" style="width: 99%;top:20px;height: 383px;"></div>
			</div>
			<div style="font-size:16px;padding-top:20px;padding-bottom:10px">
				Summary For : <?php echo $tw ?>
			</div>
			<div style="background:#EEEEEE;padding:15px">
				Metric&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Target&nbsp;&nbsp;&nbsp;&nbsp;Realisasi<br>
				Quantity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;90&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;60&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;proposal yang diterima<br><br>
				<table style="border:1px solid #333;font-size:14px;background:#FEFEFE" cellpadding="4" cellspacing="0" width="80%">
					<tr style="font-weight:bold;background:#DDDDDD">
						<td style="border:1px solid #333;">Name</td><td style="border:1px solid #333;">Value</td>
					</tr>
					<tr>
					<td style="border:1px solid #999999;">Weight</td><td style="border:1px solid #999999;"><?php echo !empty($summary) ? (float) $summary->weight : 0 ?>%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Target</td><td style="border:1px solid #999999;">100%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Realization</td><td style="border:1px solid #999999;"><?php echo !empty($summary) ? (float) $summary->achievement_raw : 0 ?>%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Achievement </td><td style="border:1px solid #999999;"><?php echo !empty($summary) ? (float) $summary->achievement : 0 ?>%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Deviation</td><td style="border:1px solid #999999;"><?php echo !empty($summary) ? (float) $summary->deviation : 0 ?>%</td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Analysis</td><td style="border:1px solid #999999;"><?php echo !empty($summary) ? $summary->analysis : NULL ?></td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Evaluation</td><td style="border:1px solid #999999;"><?php echo !empty($summary) ? $summary->evaluation : NULL ?></td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Recomendation</td><td style="border:1px solid #999999;"><?php echo !empty($summary) ? $summary->recommendation : NULL ?></td>
				</tr>
				<tr>
					<td style="border:1px solid #999999;">Accomplishment</td><td style="border:1px solid #999999;"><?php echo !empty($summary) ? (float) $summary->accomplishment/100 : 0 ?>%</td>
				</tr>
				</table>
				<br>
				<button id='btn_analysis' style='width:100px' value="<?php echo $summary->id_performance_quartal ?>" type='button'>Edit Analysis</button>
			</div>
			<br><br>
			<div style="background:#EEEEEE;padding:15px">
				File / Evidence<br><br>
				<table style="border:1px solid #333;font-size:14px;background:#FEFEFE" cellpadding="4" cellspacing="0" width="80%">
					<tr style="font-weight:bold;background:#DDDDDD">
						<td style="border:1px solid #333;">No</td><td style="border:1px solid #333;">File</td>
					</tr>
					<?php $no = 1; ?>
					<?php foreach($evidence as $evi) : ?>
					<tr>
						<td style="border:1px solid #333;"><?php echo $no ?></td><td style="border:1px solid #333;"><?php echo $evi->file ?></td>
					</tr>
					<?php $no++ ?>
					<?php endforeach ?>
				</table>
				<br>
				<button id='btn_evidence' value="<?php echo $performance->id_performance_system ?>" style='width:100px' type='button'>Upload File</button>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
</div>
<br>
