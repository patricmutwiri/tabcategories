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

        if (isset($this->request->get['filter'])) {
            $filter = $this->request->get['filter'];
        } else {
            $filter = '';
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'p.sort_order';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->request->get['limit'])) {
            $limit = $this->request->get['limit'];
        } else {
            $limit = $this->config->get('config_product_limit');
        }

        $data['categories'] = array();
        $results = $this->model_catalog_category->getCategories($id);
        shuffle($results);
        foreach ($results as $key => $result) {
            //products
            $data['products'] = array();
            $filter_data = array(
                'filter_category_id' => $result['category_id'],
                'filter_sub_category' => true,
                'filter_filter'      => $filter,
                'sort'               => $sort,
                'order'              => $order,
                'start'              => ($page - 1) * $limit,
                'limit'              => $limit
            );

            $product_total = $this->model_catalog_product->getTotalProducts($filter_data);

            $p_results = $this->model_catalog_product->getProducts($filter_data);

            foreach ($p_results as $p_result) {
                if ($p_result['image']) {
                    $image = $this->model_tool_image->resize($p_result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                } else {
                    $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                }

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($p_result['price'], $p_result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $price = false;
                }

                if ((float)$p_result['special']) {
                    $special = $this->currency->format($this->tax->calculate($p_result['special'], $p_result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $special = false;
                }

                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format((float)$p_result['special'] ? $p_result['special'] : $p_result['price']);
                } else {
                    $tax = false;
                }

                if ($this->config->get('config_review_status')) {
                    $rating = (int)$p_result['rating'];
                } else {
                    $rating = false;
                }
                $discounts = $this->model_catalog_product->getProductDiscounts($p_result['product_id']);
                $product_discounts = array(); 
                foreach ($discounts as $discount) {
                    $product_discounts[] = array(
                        'quantity' => $discount['quantity'],
                        'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')))
                    );
                }
                $data['products'][] = array(
                    'product_id'    => $p_result['product_id'],
                    'thumb'         => $image,
                    'name'          => $p_result['name'],
                    'startdate'     => $p_result['date_added'],
                    'description'   => utf8_substr(strip_tags(html_entity_decode($p_result['description'], ENT_QUOTES, 'UTF-8')), 0, 270, $this->config->get('config_product_description_length')) . '..',
                    'price'         => $price,
                    'discounts'     => $product_discounts,
                    'special'     => $special,
                    'tax'         => $tax,
                    'rating'      => $p_result['rating'],
                    'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $p_result['product_id'] . $url),
                    'href_qv'     => $this->url->link('product/quickview', 'product_id=' . $p_result['product_id'])
                );
            }

            //products
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
                'name'      => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
                'href'      => $this->url->link('product/category', 'path=' . $this->request->get['path'] . '_' . $result['category_id'] . $url),
                'thumb'     => $result['thumb'],
                'category_id'   => $result['category_id'],
                'products'      => $data['products']
            );
        }

        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/tabcategories.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/tabcategories.tpl', $data);
        } else {
            return $this->load->view('default/template/module/tabcategories.tpl', $data);
        }
    }
}