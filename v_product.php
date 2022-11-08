<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>List Product</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/jquery.dataTables.css' ?>">
</head>

<body>
    <div class="container">
        <!-- Page Heading -->
        <div class="row">
            <h1 class="page-header">Data
                <small>Product</small>
                <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span>Add Product</a></div>
            </h1>
        </div>
        <div class="row">
            <div id="reload">
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Launch Date</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="show_data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL ADD -->
    <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Add Product</h3>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Product Id</label>
                            <div class="col-xs-9">
                                <input name="id_product" id="id_product" class="form-control" type="text" placeholder="Product Id" style="width:335px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Launch Date</label>
                            <div class="col-xs-9">
                                <input name="launch_date" id="launch_date" class="form-control" type="text" placeholder="Launch Date" style="width:335px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Product Name</label>
                            <div class="col-xs-9">
                                <input name="product_name" id="product_name" class="form-control" type="text" placeholder="Product Name" style="width:335px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Price</label>
                            <div class="col-xs-9">
                                <input name="price" id="price" class="form-control" type="text" placeholder="Price" style="width:335px;" required>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-info" id="btn_simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--END MODAL ADD-->

    <!-- MODAL EDIT -->
    <div class="modal fade" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">Edit Product</h3>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Product Id</label>
                            <div class="col-xs-9">
                                <input name="id_product_edit" id="id_product2" class="form-control" type="text" placeholder="Product Id" style="width:335px;" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Launch Date</label>
                            <div class="col-xs-9">
                                <input name="launch_date_edit" id="launch_date2" class="form-control" type="text" placeholder="Launch Date" style="width:335px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Product Name</label>
                            <div class="col-xs-9">
                                <input name="product_name_edit" id="product_name2" class="form-control" type="text" placeholder="Product Name" style="width:335px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Price</label>
                            <div class="col-xs-9">
                                <input name="price_edit" id="price2" class="form-control" type="text" placeholder="Price" style="width:335px;" required>
                                <input name="idsheet" id="idsheet2" class="form-control" type="hidden" placeholder="Id" style="width:335px;" required>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-info" id="btn_update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--END MODAL EDIT-->

    <!--MODAL HAPUS-->
    <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Product</h4>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">

                        <input type="hidden" name="cellindex" id="textkode" value="">
                        <input type="hidden" name="product_name" id="product_name" value="">
                        <div class="alert alert-warning">
                            <p>Are you sure want to delete this product?</p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn_hapus btn btn-danger" id="btn_hapus">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--END MODAL HAPUS-->

    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.dataTables.js' ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            tampil_data_product(); //pemanggilan fungsi tampil product.

            $('#mydata').dataTable();

            //fungsi tampil product
            function tampil_data_product() {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url() ?>index.php/product/data_product',
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<tr>'+
                              		'<td>'+data[i][0]+'</td>'+
                              		'<td>'+data[i][1]+'</td>'+
                                    '<td>'+data[i][2]+'</td>'+
                                    '<td>'+data[i][3]+'</td>'+
                                    '<td style="text-align:right;">'+
                                        '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'+(i+2)+'">Edit</a>'+' '+
                                        '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="'+(i+2)+','+data[i][2]+'">Delete</a>'+
                                    '</td>'+
                                    '</tr>';
                        }
                        $('#show_data').html(html);
                    }

                });
            }

            //GET UPDATE
            $('#show_data').on('click', '.item_edit', function() {
                var id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('index.php/product/get_product') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                            $('#ModalaEdit').modal('show');
                            $('[name="id_product_edit"]').val(data[0][0]);
                            $('[name="launch_date_edit"]').val(data[0][1]);
                            $('[name="product_name_edit"]').val(data[0][2]);
                            $('[name="price_edit"]').val(data[0][3]);
                            $('[name="idsheet"]').val(id);
                    }
                });
                return false;
            });


            //GET HAPUS
            $('#show_data').on('click', '.item_hapus', function() {
                var id = $(this).attr('data');
                var arr = id.split(",");
                $('#ModalHapus').modal('show');
                $('[name="cellindex"]').val(arr[0]);
                $('[name="product_name"]').val(arr[1]);
            });

            //Simpan Product
            $('#btn_simpan').on('click', function() {
                var id_product = $('#id_product').val();
                var launch_date = $('#launch_date').val();
                var product_name = $('#product_name').val();
                var price = $('#price').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('index.php/product/store_product') ?>",
                    dataType: "JSON",
                    data: {
                        id_product: id_product,
                        launch_date: launch_date,
                        product_name: product_name,
                        price: price
                    },
                    success: function(data) {
                        $('[name="id_product"]').val("");
                        $('[name="launch_date"]').val("");
                        $('[name="product_name"]').val("");
                        $('[name="price"]').val("");
                        $('#ModalaAdd').modal('hide');
                        tampil_data_product();
                    }
                });
                return false;
            });

            //Update Product
            $('#btn_update').on('click', function() {
                var id_product = $('#id_product2').val();
                var launch_date = $('#launch_date2').val();
                var product_name = $('#product_name2').val();
                var price = $('#price2').val();
                var idsheet = $('#idsheet2').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('index.php/product/update_product') ?>",
                    dataType: "JSON",
                    data: {
                        id_product: id_product,
                        launch_date: launch_date,
                        product_name: product_name,
                        price: price,
                        idsheet: idsheet,
                    },
                    success: function(data) {
                        $('[name="id_product_edit"]').val("");
                        $('[name="launch_date_edit"]').val("");
                        $('[name="product_name_edit"]').val("");
                        $('#ModalaEdit').modal('hide');
                        tampil_data_product();
                    }
                });
                return false;
            });

            //Delete Product
            $('#btn_hapus').on('click', function() {
                var cellindex = $('#textkode').val();
                var product_name = $('#product_name').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('index.php/product/delete_product') ?>",
                    dataType: "JSON",
                    data: {
                        cellindex: cellindex,
                        product_name: product_name
                    },
                    success: function(data) {
                        $('#ModalHapus').modal('hide');
                        tampil_data_product();
                    }
                });
                return false;
            });

        });
    </script>
</body>

</html>
