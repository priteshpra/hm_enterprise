     <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('admin/country_model');
        $this->load->model('admin/state_model');
        $this->load->model('admin/city_model');
    }
    public function CheckEmailMobExist(){
        if($this->input->post()){
            $res = $this->common_model->CheckEmailMobExist();
            if(@$res->ID){
                echo 1;
            }else{
                $msg = explode('~',@$res->Message);
                echo @$msg[1];
            }
        }
    }
    
    public function GetSkills(){
        if($this->input->get()){
            $this->load->model('admin/skill_model');
            $json = array();
            $_POST['SkillName'] = ($this->input->get('q')=="")?'':$this->input->get('q');
            $_POST['Status'] = 1;
            $data = $this->skill_model->listData(10,1);
            foreach ($data as $key => $value) {
                if(@$value->Message)
                    break;
                $json[] = ['id'=>$value->SkillID, 'text'=>$value->SkillName];
            }
            echo json_encode($json);
        }
    }
    
     public function GetCountry(){
        if($this->input->get()){
            $json = array();
            $_POST['CountryName'] = ($this->input->get('q')=="")?'':$this->input->get('q');
            $_POST['Status'] = 1;
            $data = $this->country_model->listData(10,1);
            foreach ($data as $key => $value) {
                if(@$value->Message)
                    break;
                $json[] = ['id'=>$value->CountryID, 'text'=>$value->CountryName];
            }
            echo json_encode($json);
        }
    }
    public function GetState(){
        if($this->input->get()){
            $json = array();
            $_POST['StateName'] = ($this->input->get('q')=="")?'-1':$this->input->get('q');
            $_POST['CountryID'] = ($this->input->get('CountryID')=="")?'-1':$this->input->get('CountryID');
            $_POST['Status'] = 1;
            $data = $this->state_model->listData(10,1);
            foreach ($data as $key => $value) {
                if(@$value->Message)
                    break;
                $json[] = ['id'=>$value->StateID, 'text'=>$value->StateName];
            }
            echo json_encode($json);
        }
    }
    public function GetCity(){
        if($this->input->get()){
            $json = array();
            $_POST['CityName'] = ($this->input->get('q')=="")?'':$this->input->get('q');
            $_POST['StateID'] = ($this->input->get('StateID')=="")?'-1':$this->input->get('StateID');
            $_POST['Status'] = 1;
            $data = $this->city_model->ListDataComboBox(10,1);
            foreach ($data as $key => $value) {
                if(@$value->Message)
                    break;
                $json[] = ['id'=>$value->CityID, 'text'=>$value->CityName];
            }
            echo json_encode($json);
        }
    }

    function SetCitySession(){
        $CityID = $this->input->post('CityID');
        @$this->session->userdata['CityID'] = $CityID;
    }

}
