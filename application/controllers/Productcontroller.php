<?php
class ProductController extends CI_Controller {
    public function index() {
        $this->load->view('crud_ajax');
    }
    public function fetch_product() {
        $fetch_data = $this->Product->getTblProduct();  
        $data = array();
        foreach($fetch_data as $key => $row)  {  
            $sub_array = array();  
            $sub_array[] = $row['id'];  
            $sub_array[] = $row['title'];  
            $sub_array[] = $row['price'];  
            $sub_array[] = $row['quantity'];  
            $sub_array[] = $row['created_time'];  
            $sub_array[] = $row['updated_time'];  
            $sub_array[] = '<button type="button" name="update" onclick="editProduct('.$row['id'].')" class="btn btn-warning btn-xs">Edit</button>';  
            $sub_array[] = '<button type="button" name="delete" onclick="deleteProduct('.$row['id'].')" class="btn btn-danger btn-xs">Delete</button>';  
            $data[] = $sub_array;  
        }
        $output = array(
            "data" => $data,
            'recordsFiltered' =>  0,
            'recordsTotal' => 0
        );
        echo json_encode($output);
        exit;
    }
    public function add_product() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->form_validation->set_rules('title_name', 'Title', 'required|min_length[6]');
        $this->form_validation->set_rules('price_name', 'Price', 'required|numeric');
        $this->form_validation->set_rules('quantity_name', 'Quantity', 'required|numeric');
           
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
            
        } else{
            $insertdata = array(
                'title' => $this->input->post('title_name'),
                'price' => $this->input->post('price_name'),
                'quantity' => $this->input->post('quantity_name'),
                'created_time' => date('Y-m-d H:i:s'),
                'updated_time' => date('Y-m-d H:i:s'),
            );
            
            if($this->Product->add($insertdata) == 0) {
               echo 'fail';
              
            };
        }
        exit;
    }
    public function getDataProduct() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $productId = $this->input->post('productId');
            $product = $this->Product->getById($productId);
            echo json_encode($product);
            exit;
        }
    }
    public function update_product() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $productId = $this->input->post('product_id');
        $this->form_validation->set_rules('title_name_edit', 'Title', 'required|min_length[6]');
        $this->form_validation->set_rules('price_name_edit', 'Price', 'required|numeric');
        $this->form_validation->set_rules('quantity_name_edit', 'Quantity', 'required|numeric');
           
        if($this->form_validation->run() == FALSE){
            echo validation_errors();
            
        } else {
            $updateData = array(
                'title' => $this->input->post('title_name_edit'),
                'price' => $this->input->post('price_name_edit'),
                'quantity' => $this->input->post('quantity_name_edit'),
                'updated_time' => date('Y-m-d H:i:s'),
            );
            
            if($this->Product->update($updateData, $productId) == 0) {
                echo 'fail';
            };
        }
        exit;
    }
    public function delete_product() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $productId = $this->input->post('productId');
        $product = $this->Product->delete($productId);
        echo $product;
        exit;
    }
    
}

?>