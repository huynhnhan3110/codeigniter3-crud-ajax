<?php
class Product extends CI_Model{
    public function getTblProduct() {
        return $this->db->get('tbl_product')->result_array();
    }
    public function add($data) {
        $this->db->insert('tbl_product',$data);
        return $this->db->insert_id();
    }
    function getById($productId) {
        $this->db->where('id',$productId);
        $product = $this->db->get('tbl_product')->row_array();
        return $product;
    }
    function update($data, $productId) {
        return $this->db->update('tbl_product', $data, array('id' => $productId));
    }
    public function delete($productId) {
		return $this->db->delete('tbl_product', array('id'=>$productId));
	}
}
?>