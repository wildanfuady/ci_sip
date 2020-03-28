<?php $this->load->view('partials/header'); ?>
<?php $this->load->view('partials/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            List All Product
                            <a href="<?php echo base_url('product/create'); ?>" class="btn btn-primary btn-sm float-right">Tambah Data</a>
                        </div>
                        <div class="card-body">

                            <?php if($this->session->flashdata('success')){ ?>
                                <div id="alert-msg" class="alert alert-success alert-dismissible">
                                    <button class="close" type="button" data-dismiss="alert" area-hidden="true">x</button>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php } ?>

                            <?php if($this->session->flashdata('info')){ ?>
                                <div id="alert-msg" class="alert alert-info alert-dismissible">
                                    <button class="close" type="button" data-dismiss="alert" area-hidden="true">x</button>
                                    <?php echo $this->session->flashdata('info'); ?>
                                </div>
                            <?php } ?>

                            <?php if($this->session->flashdata('warning')){ ?>
                                <div id="alert-msg" class="alert alert-warning alert-dismissible">
                                    <button class="close" type="button" data-dismiss="alert" area-hidden="true">x</button>
                                    <?php echo $this->session->flashdata('warning'); ?>
                                </div>
                            <?php } ?>

                            <?php if($this->session->flashdata('error')){ ?>
                                <div id="alert-msg" class="alert alert-danger alert-dismissible">
                                    <button class="close" type="button" data-dismiss="alert" area-hidden="true">x</button>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php } ?>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo form_label('Category'); ?>
                                        <?php echo form_dropdown('category_id', $set_category, $category, ['class' => 'form-control', 'id' => 'category_id']); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo form_label('Keyword'); ?>
                                        <?php echo form_input('keyword', $keyword, ['class' => 'form-control', 'placeholder' => 'Enter keyword ...', 'id' => 'keyword']); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>SKU</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($products as $key => $data){ ?>
                                        <tr>
                                            <td><?php echo ++$nomor; ?></td>
                                            <td><?php echo $data['category_name']; ?></td>
                                            <td><?php echo $data['product_name']; ?></td>
                                            <td><?php echo $data['product_price']; ?></td>
                                            <td><?php echo $data['product_sku']; ?></td>
                                            <td><?php echo $data['product_status']; ?></td>
                                            <td>
                                                <img src="<?php echo base_url('uploads/'.$data['product_image']); ?>" alt="" class="img-fluid" width="100">
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <!-- detail -->
                                                    <a href="<?php echo base_url('product/show/'.$data['product_id']); ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                    <!-- edit -->
                                                    <a href="<?php echo base_url('product/edit/'.$data['product_id']); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                    <!-- delete -->
                                                    <a href="<?php echo base_url('product/delete/'.$data['product_id']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
    $(document).ready(function(){

        $("#category_id").change(function(){
            filter();
        });
        $("#keyword").keypress(function(event){
            if(event.keyCode == 13){ // enter
                filter();
            }
        });

        var filter = function(){
            var cat_id = $("#category_id").val();
            var keyword = $("#keyword").val();

            window.location.replace("<?php echo base_url().'product/index'; ?>?category=" + cat_id + "&keyword=" +keyword);
        }
    });
</script>
<?php $this->load->view('partials/footer'); ?>