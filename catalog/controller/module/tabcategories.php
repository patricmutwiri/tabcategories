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

        $this->load->language('product/category');
        $this->load->model('catalog/category');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');
        
        $url = '';
        if (isset($this->request->get['filter'])) {
            $url .= '&filter=' . $this->request->get['filter'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['limit'])) {
            $url .= '&limit=' . $this->request->get['limit'];
        }

        $data['categories'] = array();
        $results = $this->model_catalog_category->getCategories($id);
        foreach ($results as $key => $result) {
            if ($result['image']) {
                $result['thumb'] = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
            } else {
                $result['thumb'] = '';
            }

            $filter_data = array(
                'filter_category_id'  => $result['category_id'],
                'filter_sub_category' => true
            );

            $data['categories'][] = array(
                'name'  => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
                'href'  => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url),
                'thumb' => $result['thumb'],
                'category_id' => $result['category_id']
            );
        }

        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/tabcategories.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/tabcategories.tpl', $data);
        } else {
            return $this->load->view('default/template/module/tabcategories.tpl', $data);
        }
    }
}