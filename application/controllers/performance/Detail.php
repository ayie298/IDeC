<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');
		$this->load->library('user');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/program/program_model');
		$this->load->model('modules/project/project_model');
		$this->load->model('modules/performance/performance_model');
		$this->load->model('idec_model');
	}

	public function index($id = null)
	{
		$data['allPerformance'] = $this->performance_model->findAll('getPerformance', array('md5(id_performance_system) !=' => $id));
		$data['performance'] = $this->performance_model->find('getPerformance', array('md5(id_performance_system)' => $id));
		$data['quartal']	 = $this->input->post('quartal') == '' ? 1 : $this->input->post('quartal');

		$item		 		 = $this->performance_model->find('getItem', array('md5(performance_system_item.id_performance_system)' => $id));
		$perspective 		 = $this->performance_model->findAll('getPerspective');
		$totalWeight		 = 0;
		$totalReal			 = 0;
		$totalAcheive	     = 0;
		$totalAccom			 = 0;
		$totalDeviation		 = 0;

		switch ($this->input->post('quartal')) {
				case '1':
					$period = 'TW I';
				break;
				case '2':
					$period = 'TW II';
				break;
				case '3':
					$period = 'TW III';
				break;
				case '4':
					$period = 'TW IV';
				break;
				default :
					$period = 'TW I';
				break;
				}

		$data['tw']   		= $period;
		$data['item']		= empty($item) ? '' : $item->name;
		$data['item_id']	= empty($item) ? '' : $item->id_performance_system_item;
		$data['item_tw1'] 	= empty($item) ? '' : $this->performance_model->find('getQuartal', array('id_performance_system_item' => $item->id_performance_system_item, 'period' => 1));
		$data['item_tw2'] 	= empty($item) ? '' : $this->performance_model->find('getQuartal', array('id_performance_system_item' => $item->id_performance_system_item, 'period' => 2));
		$data['item_tw3'] 	= empty($item) ? '' : $this->performance_model->find('getQuartal', array('id_performance_system_item' => $item->id_performance_system_item, 'period' => 3));
		$data['item_tw4'] 	= empty($item) ? '' : $this->performance_model->find('getQuartal', array('id_performance_system_item' => $item->id_performance_system_item, 'period' => 4));
		$data['summary']	= empty($item) ? '' : $this->performance_model->find('getQuartal', array('id_performance_system_item' => $item->id_performance_system_item, 'period' => $data['quartal']));
		$data['detail']		= $this->json($id, $data['quartal'], TRUE);
		$data['sumPers']	= $this->json_summary($id, $data['quartal']);
		$data['evidence']	= $this->db->where('md5(id_performance_system)', $id)->get('performance_evidence')->result();
		$data['perspective']= array();

		foreach($perspective as $pers) {
			$items1 = $this->performance_model->getSumPeriode($data['performance']->id_performance_system, 1, $pers->id_mas_perspective);
			$items2 = $this->performance_model->getSumPeriode($data['performance']->id_performance_system, 2, $pers->id_mas_perspective);
			$items3 = $this->performance_model->getSumPeriode($data['performance']->id_performance_system, 3, $pers->id_mas_perspective);
			$items4 = $this->performance_model->getSumPeriode($data['performance']->id_performance_system, 4, $pers->id_mas_perspective);

			$data['perspective'][] = array(
				'name' 	=> $pers->perspective,
				'tw1'	=> (int) $items1->total_achieve,
				'tw2'	=> (int) $items2->total_achieve,
				'tw3'	=> (int) $items3->total_achieve,
				'tw4'	=> (int) $items4->total_achieve
			);
		}
/*
		foreach($perspective as $pers) {
			$dataPers = $this->performance_model->findAll('getItem', array('md5(performance_system_item.id_performance_system)' => $id, 'id_mas_perspective' => $pers->id_mas_perspective));

			foreach($dataPers as $perss) {
				$tw1 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $perss->id_performance_system_item, 'period' => $data['quartal']));

				$datas[] = array(
					'weight'		=> !empty($tw1) ? (float) $tw1->weight : 0,
					'target'		=> !empty($tw1) ? (float) $tw1->target : 0,
					'achievement'	=> !empty($tw1) ? (float) $tw1->achievement : 0,
					'realization'	=> !empty($tw1) ? (float) $tw1->achievement_raw : 0,
					'accomplishment'=> !empty($tw1) ? (float) $tw1->accomplishment : 0,
					'deviation'		=> !empty($tw1) ? (float) $tw1->deviation : 0
				);
			}
		}

		for($i=0;$i<sizeof($datas);$i++) {
			$totalWeight += $datas[$i]['weight'];
			$totalWeight += $datas[$i]['weight'];
			$totalWeight += $datas[$i]['weight'];
			$totalWeight += $datas[$i]['weight'];
			$totalWeight += $datas[$i]['weight'];
		}
*/
		$this->template->write_view('content', MODULE_VIEW_PATH.'performance/performance_detail', $data);
		$this->template->render();
	}

	public function json($id = 0, $quartal = 1, $is_array = FALSE)
	{
		$data    = array();
		$program = $this->performance_model->findAll('getPerspective');

		foreach($program as $prog) {
			$data[] = array(
				'id'   			=> $prog->id_mas_perspective,
				'level'			=> 1,
				'parent'		=> '',
				'perspective'   => $prog->perspective,
			);

			$dataPers = $this->performance_model->findAll('getItem', array('md5(performance_system_item.id_performance_system)' => (is_array($id) ? $id[0] : $id), 'id_mas_perspective' => $prog->id_mas_perspective, 'id_performance_system_item_parent' => 0));

			foreach($dataPers as $pers) {
				$formula1 = $this->performance_model->find('getFormulaReal', array('formula_performance_indicator.id_performance_indicator' => $pers->id_performance_indicator));
				$formula2 = $this->performance_model->find('getFormulaAchieve', array('formula_performance_indicator.id_performance_indicator' => $pers->id_performance_indicator));

				$tw1 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers->id_performance_system_item, 'period' => $quartal));

				$data[] = array(
					'id'   			=> $pers->id_performance_system_item,
					'level'			=> 2,
					'parent'		=> $prog->id_mas_perspective,
					'measure'		=> $pers->measure_definition,
					'indicator'		=> $pers->name,
					'formula' 		=> $formula1->name . ' ' . $formula2->name,
					'weight'		=> empty($tw1) ? 100 : $tw1->weight,
					'target'		=> 100,
					'achievement'	=> empty($tw1) ? 0 : $tw1->achievement,
					'accomplishment'=> empty($tw1) ? 0 : $tw1->accomplishment
				);

				$dataPers2 = $this->performance_model->findAll('getItem', array('performance_system_item.id_performance_system_item_parent' => $pers->id_performance_system_item));

				foreach($dataPers2 as $pers2) {
				$formula1 = $this->performance_model->find('getFormulaReal', array('formula_performance_indicator.id_performance_indicator' => $pers2->id_performance_indicator));
				$formula2 = $this->performance_model->find('getFormulaAchieve', array('formula_performance_indicator.id_performance_indicator' => $pers2->id_performance_indicator));

				$tw1 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers2->id_performance_system_item, 'period' => $quartal));

				$data[] = array(
					'id'   			=> $pers2->id_performance_system_item,
					'level'			=> 3,
					'parent'		=> $pers->id_performance_system_item,
					'measure'		=> $pers2->measure_definition,
					'indicator'		=> $pers2->name,
					'formula' 		=> $formula1->name . ' ' . $formula2->name,
					'weight'		=> empty($tw1) ? 100 : $tw1->weight,
					'target'		=> 100,
					'achievement'	=> empty($tw1) ? 0 : $tw1->achievement,
					'accomplishment'=> empty($tw1) ? 0 : $tw1->accomplishment
				);
				}
			}
		}

		if($is_array) {
			return $data;
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode($json);
	}

	public function json_summary($id = 0, $period = 1)
	{
		$program = $this->performance_model->findAll('getPerspective');

		foreach($program as $prog) {
			$pers = $this->items($id, $prog->id_mas_perspective, $period);

			$data[] = array(
				'id'   			=> (int) $prog->id_mas_perspective,
				'perspective'   => $prog->perspective,
				'achievement'	=> (float) $pers['achievement'],
				'target'		=> (float) $pers['target'],
				'accomplishment'=> (float) $pers['accomplishment'],
				'total'			=> $pers['total']
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		return $data;
	}

	private function items($id, $id_pers, $period = 1)
	{
		$dataPers 		= $this->performance_model->findAll('getItem', array('md5(performance_system_item.id_performance_system)' => $id, 'id_mas_perspective' => $id_pers));
		$totalPers		= 0;
		$totalTarget	= 0;
		$totalAcheive	= 0;
		$totalAccom		= 0;
		$perform  		= array();

			foreach($dataPers as $pers) {
				$twe1 = $this->performance_model->find('getQuartal', array('id_performance_system_item' => $pers->id_performance_system_item, 'period' => $period));
				
				$tw1 		= empty($twe1) ? 0 : $twe1->weight;
				$tw1Target 	= empty($twe1) ? 0 : $twe1->target;
				$tw1Achieve = empty($twe1) ? 0 : $twe1->achievement;
				$tw1Accom 	= empty($twe1) ? 0 : $twe1->accomplishment;

				$totalPers 		+= $tw1;
				$totalAcheive 	+= $tw1Achieve;
				$totalTarget 	+= $tw1Target;
				$totalAccom 	+= $tw1Accom;
			}

		return array('achievement' => $totalAcheive, 'total' => $totalPers, 'target' => $totalTarget, 'accomplishment' => $totalAccom);
	}

	public function _remap($id, $params = "")
	{
		if(method_exists($this, $id)) {
			return $this->{$id}($params);
		} else {
			$this->index($id);
		}
	}
}