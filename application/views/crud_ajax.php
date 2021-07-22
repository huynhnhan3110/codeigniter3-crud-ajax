<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sửa xóa sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"/>
    
    <style>.modal-backdrop{ opacity:0.5 !important; }</style>
</head>
<body>
    <div class="container">
        <div class="col-md-12 mt-5">
            <h2>Codeigniter 3 CRUD</h2>
            <button type="button" data-toggle="modal" data-target="#product_model" class="btn btn-info btn-lg mt-3 mb-3">Add Product</button>  

                <table id="product_data" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>  
                            <th>Title</th>  
                            <th width="5%">Price</th>  
                            <th width="5%">Quanlity</th>
                            <th width="5%">Created_time</th>
                            <th width="5%">Updated_time</th>
                            <th width="5%">Update</th>  
                            <th width="5%">Delete</th>  
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

   
</body>
</html>

<div id="product_model" class="modal">
    <div class="modal-dialog">
    <form method="post" id="product_form">  
        <div class="modal-content">  
                <div class="modal-header">  
                    <h5 class="modal-title">Add product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>  
                <div class="modal-body">  
                    <label>Enter Title</label>  
                    <input type="text" name="title_name" id="title_name" class="form-control" />  
                    <br />  
                    <label>Enter Price</label>  
                    <input type="text" name="price_name" id="price_name" class="form-control" />  
                    <br />  
                    <label>Enter Quantity</label>  
                    <input type="text" name="quantity_name" id="quantity_name" class="form-control" />
                    <div id="alert-msg" class="pt-2"></div>  
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-primary" id="add_product_btn">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>  
        </div>  
    </form>  
    </div>
</div>
<div id="product_edit_model" class="modal">
    <div class="modal-dialog">
    <form method="post" id="product_edit_form">  
        <div class="modal-content">  
                <div class="modal-header">  
                    <h5 class="modal-title">Edit product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>  
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id" />  
                    <label>Enter Title</label>  
                    <input type="text" name="title_name_edit" id="title_name_edit" class="form-control" />  
                    <br />  
                    <label>Enter Price</label>  
                    <input type="text" name="price_name_edit" id="price_name_edit" class="form-control" />  
                    <br />  
                    <label>Enter Quantity</label>  
                    <input type="text" name="quantity_name_edit" id="quantity_name_edit" class="form-control" /> 
                    <div id="alert-msg-edit" class="pt-2"></div>   
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-primary" id="save_product_btn">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>  
        </div>  
    </form>  
    </div>
</div>
<script>
    $(document).ready(function() {
        var dataTable = $('#product_data').DataTable({
            "ajax": {
                url:"<?php echo base_url('Productcontroller/fetch_product');?>",
                type: "POST",
            },

        });
        $('#add_product_btn').on('click',function(){
            $.ajax({  
                url: "<?php echo base_url('Productcontroller/add_product');?>",  
                method: 'POST',  
                data: new FormData(document.getElementById('product_form')),  
                contentType: false,  
                processData: false,  
                success: function(data) {
                    if(data != '') {
                        $('#alert-msg').html('<div class="alert alert-danger">' + data + '</div>');
                    }else{
                        $('#product_model').modal('hide');  

                        $('#product_model').find('form')[0].reset();
                        $('#alert-msg').html('');
                        dataTable.ajax.reload();  
                    }
                   
                }  
            });  
        });
        $('#save_product_btn').on('click',function(){
            $.ajax({  
                url: "<?php echo base_url('Productcontroller/update_product');?>",  
                method: 'POST',  
                data: new FormData(document.getElementById('product_edit_form')),  
                contentType: false,  
                processData: false,  
                success: function(data) {  
                    if(data != '') {
                        $('#alert-msg-edit').html('<div class="alert alert-danger">' + data + '</div>');
                    }else{
                        $('#product_edit_model').find('form')[0].reset();
                        $('#alert-msg-edit').html('');
                        $('#product_edit_model').modal('hide');  
                        dataTable.ajax.reload();
                    } 
                }  
            });  
        });
        
    });
    function editProduct(productId) {
        $('#product_edit_model').modal('show');
        $.ajax({  
            url: "<?php echo base_url('Productcontroller/getDataProduct');?>",  
            method: 'POST',  
            data: {productId:productId},
            dataType: "json",
            success: function(data) {  
                $('#product_id').val(data.id);
                $('#title_name_edit').val(data.title);
                $('#price_name_edit').val(data.price);
                $('#quantity_name_edit').val(data.quantity);
            }  
        });  
    }
    function deleteProduct(productId) {

       if(confirm('Confirm delete product ID '+productId+' ?')) {
            $.ajax({  
                url: "<?php echo base_url('Productcontroller/delete_product');?>",  
                method: 'POST',  
                data: {productId:productId},
                dataType: "json",
                success: function(data) {
                    $('#product_data').DataTable().ajax.reload();
                }  
            });
       }
    }
</script>