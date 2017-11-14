<?php
class ControllerModuleTabCategories extends Controller {
    private $error = array(); 
 
    public function index() {
        $this->load->language('module/tabcategories'); 
     
        $this->document->setTitle($this->language->get('heading_title'));
     
        $this->load->model('setting/setting');
     
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                $this->model_setting_setting->editSetting('tabcategories', $this->request->post);
     
                $this->session->data['success'] = $this->language->get('text_success');
     
                $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }
     
        $data['heading_title'] = $this->language->get('heading_title');
     
        $data['text_edit']    = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_content_top'] = $this->language->get('text_content_top');
        $data['text_content_bottom'] = $this->language->get('text_content_bottom');      
        $data['text_column_left'] = $this->language->get('text_column_left');
        $data['text_column_right'] = $this->language->get('text_column_right');
     
        $data['entry_code'] = $this->language->get('entry_code');
        $data['entry_limit'] = $this->language->get('entry_limit');
        $data['entry_layout'] = $this->language->get('entry_layout');
        $data['entry_position'] = $this->language->get('entry_position');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
     
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_add_module'] = $this->language->get('button_add_module');
        $data['button_remove'] = $this->language->get('button_remove');
         if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
     
        if (isset($this->error['code'])) {
            $data['error_code'] = $this->error['code'];
        } else {
            $data['error_code'] = '';
        }     
     
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/tabcategories', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
          $data['action'] = $this->url->link('module/tabcategories', 'token=' . $this->session->data['token'], 'SSL'); 
     
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'); 
              if (isset($this->request->post['tabcategories_text_field'])) {
            $data['tabcategories_text_field'] = $this->request->post['tabcategories_text_field'];
        } else {
            $data['tabcategories_text_field'] = $this->config->get('tabcategories_text_field');
        }
          if (isset($this->request->post['tabcategories_status'])) {
            $data['tabcategories_status'] = $this->request->post['tabcategories_status'];
        } else {
            $data['tabcategories_status'] = $this->config->get('tabcategories_status');
        }
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/tabcategories.tpl', $data));

    }

    /* Function that validates the data when Save Button is pressed */
    protected function validate() {
 
        if (!$this->user->hasPermission('modify', 'module/tabcategories')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
 
        if (!$this->request->post['tabcategories_text_field']) {
            $this->error['code'] = $this->language->get('error_code');
        }
        /* End Block*/
 
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
