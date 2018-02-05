<?php

namespace App\Controller;
use Cake\Core\Configure;

use App\Controller\AppController;
use Cake\Event\Event;


/**
 * Mrs Controller
 */
class MrsController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Roles');
        $this->loadModel('Specialities');
        $this->loadModel('States');
        $this->loadModel('Cities');
        $this->loadModel('Doctors');
        $this->loadModel('Chemists');
        $this->loadModel('Stockists');
        $this->loadModel('WorkPlans');
        $this->loadModel('WorkReports');
        $this->loadModel('WorkTypes');
        $this->loadModel('LeaveTypes');
        $this->loadModel('DoctorsRelation');
        $this->loadModel('ChemistsRelation');
        $this->loadModel('DoctorTypes');
        $this->loadModel('Products');
    }
    
    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        if($this->Auth->User()) {
            $currentUserid = $this->Auth->user('id');
        }else{
            return $this->redirect($this->Auth->logout()); 
        }
    }    
    public function dashboard(){
        $this->set('title', 'Doctor Visit Report');        
    }      
    public function chemistList(){
        $this->set('title', 'Chemist List');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $states = $this->States->find('all')->where(['id =' => $state_id])->toarray();
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
        $chemistsRelation = $this->paginate($this->ChemistsRelation->find('all')->contain(['Chemists.Cities','Chemists.States'])->where(['ChemistsRelation.user_id =' => $uid])->order(['ChemistsRelation.id' => 'ASC']));
        $chemists = $this->Chemists
			->find()
			->notMatching('ChemistsRelation', function ($q) use ($uid) {
				return $q->where(['ChemistsRelation.user_id' => $uid]);
			})->where(['city_id =' => $userCity]);
        //pj($chemists);exit;
        $this->set(compact('userCity', 'states', 'cities', 'chemistsRelation', 'chemists'));            

    }
    public function dailyReport(){
        $this->set('title', 'Daily Report');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
		$products = $this->Products->find('all')->toarray();
		$stockists = $this->Stockists->find('all')->where(['city_id =' => $userCity])->toarray();
		$chemists = $this->Chemists->find('all')->where(['city_id =' => $userCity])->toarray();
		$doctorsRelation = array();
		$date = "";
		$html = "";
		if(isset($_GET['date']))
		{
			$date = $_GET['date'];
			//echo $date; exit;
			$start_date = $date." 00:00:00";
			$end_date = $date." 23:59:00";
			$planned_doctors=array();
			
			$WorkPlansD = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities', 'Doctors'])	
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.start_date =' => $start_date, 'WorkPlans.doctor_id IS NOT' => null, 'WorkPlans.work_type_id =' => 2])->toArray();
			
			$WorkPlansC = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities'])	
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.start_date =' => $start_date, 'WorkPlans.chemist_id IS NOT' => null])->toArray();
			
			$WorkPlansS = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities'])	 
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.start_date =' => $start_date, 'WorkPlans.stockist_id IS NOT' => null])->toArray();

			$WorkPlans = $this->WorkPlans
			->find('all')
			->contain(['WorkTypes', 'Cities'])	
			->where(['WorkPlans.user_id =' => $uid])
			->where(['WorkPlans.start_date =' => $start_date, 'WorkPlans.work_type_id <>' => 2])->toArray();
			
			$html = "";
			if(count($WorkPlansD))
			{
				$work_with = '<select name="work_with[%s]"><option>Alone</option><option>TM</option><option>BM</option><option>ZM</option><option>HO</option><option>TM-ZBM</option><option>BM-ZBM</option><option>TM-BM-ZBM</option><option>TM-HO</option><option>TM-BM-HO</option><option>TM-BM-ZBM-HO</option></select>';
				$is_missed = '<select name="missed_reason[%s]"><option value="">No</option><option>Doctor Refused Appointment</option><option>Doctor on Leave</option><option>Doctor not in Station</option><option>Plan Changed</option><option>Meeting / CME</option><option>Others</option></select>';
				$product_popup = '<div class="mfp-hide white-popup-block small_popup doctor_product" id="doctor_product_%s">
				<div class="popup-content">
					<div class="popup-header">
						<button type="button" class="close popup-modal-dismiss"><span>&times;</span></button>
						<div class="hr-title"><h4>Select Products Given as samples</h4><hr /></div>
					</div>
					<div class="popup-body">
						<div class="row">
							<div class="col-sm-12 mar-bottom-20">
								<div class="radio-blk">
								<select name="products[%s]" multiple="" id="products_%s"  onchange="productShow(%s)">%products</select>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn blue-btn btn-block margin-right-35 popup-modal-dismiss pull-right">OK</button></div>
						</div>
					</div>
				</div>';

				$html.='<h3 class="mar-top-10 mar-bottom-10">Doctors</h3><table id="doctors_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Doctor Name</th><th>City</th><th>Work With</th><th>Is Missed</th><th>Products</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlansD as $WorkPlanD)
				{
					
					$work_with_selected = str_replace("<option>".$WorkPlanD->work_with."</option>","<option selected>".$WorkPlanD->work_with."</option>",$work_with);
					$is_missed_selected = str_replace("<option>".$WorkPlanD->missed_reason."</option>","<option selected>".$WorkPlanD->missed_reason."</option>",$is_missed);;
					$products_array = array();
					if($WorkPlanD->products!="")
					$products_array = unserialize($WorkPlanD->products);

					$sample_products =array();$product_options="";
					foreach($products as $product)
					{
						if (in_array($product->id, $products_array))
						{
							$product_options.='<option value="'.$product->id.'" selected>'.$product->name.'</option>';
							$sample_products[$product->id]= $product->name;
						}
						else
						$product_options.='<option value="'.$product->id.'">'.$product->name.'</option>';
							
					}
					if(count($sample_products)>0) {$pdt_lnk_text = implode(", ",$sample_products); $pdt_val_text=implode(",",array_keys($sample_products));}
					else {$pdt_lnk_text = "Select Products"; $pdt_val_text="";}
					$product_popup_selected = str_replace("%products",$product_options,$product_popup);
					$planned_doctors[]=$WorkPlanD->doctor_id;
					$html.='<tr><td><input type="hidden" name=workplan_id['.$WorkPlanD->id.'] value="1">'.$i.'</td><td>'.$WorkPlanD->doctor->name.'</td><td>'.$WorkPlanD->city->city_name.'</td><td>'.str_replace("%s",$WorkPlanD->id,$work_with_selected).'</td><td>'.str_replace("%s",$WorkPlanD->id,$is_missed_selected).'</td><td><a href="#doctor_product_'.$WorkPlanD->id.'" id="pdt_link_'.$WorkPlanD->id.'" class="popup-modal">'.$pdt_lnk_text.'</a><input type="hidden" id="pdt_val_'.$WorkPlanD->id.'" name=pdt_val['.$WorkPlanD->id.'] value="'.$pdt_val_text.'">'.str_replace("%s",$WorkPlanD->id,$product_popup_selected).'</td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}
			$doctorsRelation = $this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $uid, 'DoctorsRelation.doctor_id NOT IN' => $planned_doctors])->contain(['Doctors']);

			if(count($WorkPlans))
			{
				$is_cancelled = '<select name="is_cancelled[%s]"><option value="0">No</option><option value="1">Yes</option></select>';
				$html.='<h3 class="mar-top-10 mar-bottom-10">Other Plans</h3><table id="plans_table" class="table table-striped table-bordered table-hover"><thead><tr><th width="">S.No</th><th>Work Type</th><th>City</th><th>Is Cancelled</th></tr></thead><tbody>';
				$i = 1;
				foreach ($WorkPlans as $WorkPlan)
				{
					$is_cancelled_selected = str_replace('value="'.$WorkPlan->is_cancelled.'"','value="'.$WorkPlan->is_cancelled.'" selected',$is_cancelled);
					$html.='<tr><td><input type="hidden" name=workplan_id['.$WorkPlan->id.'] value="1">'.$i.'</td><td>'.$WorkPlan->work_type->name.'</td><td>'.$WorkPlan->city->city_name.'</td><td>'.sprintf($is_cancelled_selected,$WorkPlan->id).'</td></tr>';
				$i++;
				}
				$html.='</tbody></table>';
			}
		}
		if($html == ""){$html.="<p>No plans on this date</p>";}
        $this->set(compact('userCity', 'cities', 'products', 'chemists', 'stockists', 'html', 'doctorsRelation', 'date'));        
		
    }
	
	public function monthlyplan(){
        $this->viewBuilder()->layout('monthlyplan');
        $this->set('title', 'Monthly Plan');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $workTypes = $this->WorkTypes->find()->order(['list' => 'ASC'])->toarray();
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
        $doctorsRelation = $this->DoctorsRelation->find('all')->where(['DoctorsRelation.user_id =' => $uid])->contain(['Doctors']);
        $leaveTypes = $this->LeaveTypes->find()->toarray();
        $this->set(compact('userCity', 'workTypes', 'leaveTypes', 'cities', 'doctorsRelation'));        
    }
    
    public function doctorList(){
        $this->set('title', 'Doctor List');
        $uid = $this->Auth->user('id');
        $userCity = $this->Auth->user('city_id');
        $user =  $this->Auth->user;
		$state_id = $this->Auth->user('state_id');
        $specialities = $this->Specialities->find('all')->toarray();
        $doctorTypes = $this->DoctorTypes->find('all')->toarray();
        $states = $this->States->find('all')->where(['id =' => $state_id])->toarray();
        $cities = $this->Cities->find('all')->where(['state_id =' => $state_id])->toarray();
        $doctorsRelation = $this->paginate($this->DoctorsRelation->find('all')->contain(['DoctorTypes','Doctors.Specialities','Doctors.Cities'])->where(['DoctorsRelation.user_id =' => $uid])->order(['DoctorsRelation.id' => 'ASC']));
        $doctors = $this->Doctors
			->find()
			->notMatching('DoctorsRelation', function ($q) use ($uid) {
				return $q->where(['DoctorsRelation.user_id' => $uid]);
			})->where(['city_id =' => $userCity]);
        //pj($doctors);exit;
        $this->set(compact('userCity', 'specialities', 'states', 'cities', 'doctorsRelation', 'doctors', 'doctorTypes'));            
    }
	
    public function doctorSelection(){
        $this->set('title', 'Doctor Visit Report');        
    }      
}
