<?php
class ControllerModuleTabCategories extends Controller {
    public function index() {
        $this->load->language('module/tabcategories'); // loads the language file of tabcategories
         
        $data['heading_title'] = $this->language->get('heading_title'); // set the heading_title of the module
         
        $data['tabcategories_value'] = html_entity_decode($this->config->get('tabcategories_text_field')); // gets the saved value of tabcategories text field and parses it to a variable to use this inside our module view
        $id = '';
        if(!empty($this->config->get('tabcategories_text_field'))) {
            $id = $this->config->get('tabcategories_text_field');
        }
        
        $this->load->model('catalog/category');
        $this->load->model('tool/image');
        $data['categories'] = $this->model_catalog_category->getCategories($id);
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/tabcategories.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/tabcategories.tpl', $data);
        } else {
            return $this->load->view('default/template/module/tabcategories.tpl', $data);
        }
    }
}