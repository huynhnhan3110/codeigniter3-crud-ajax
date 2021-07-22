<?php
class Product extends CI_Model{
    public function getTblProduct() {
        $data =$this->db->get('tbl_product')->result_array();
        return $data;
    }
    public function add($data) {
        $this->db->insert('tbl_product',$data);
    }
    function getById($productId) {
        $this->db->where('id',$productId);
        $product = $this->db->get('tbl_product')->row_array();
        return $product;
    }
    function update($data, $productId) {
        $this->db->update('tbl_product', $data, array('id' => $productId));
    }
    public function delete($productId) {
		return $this->db->delete('tbl_product', array('id'=>$productId));
	}
}
?>