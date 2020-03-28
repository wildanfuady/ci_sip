<?php $this->load->view('partials/header'); ?>
<?php $this->load->view('partials/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detail Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Product</li>
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
                        <div class="card-header">Detail Product</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo form_label('Category'); ?>
                                        <?php echo form_dropdown('category_id', $set_category, $product['category_id'], ['class' => 'form-control', 'disabled' => 'disabled']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Name'); ?>
                                        <?php echo form_input('product_name', $product['product_name'], ['class' => 'form-control', 'placeholder' => 'Enter Product Name', 'readonly' => 'readonly']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Price'); ?>
                                        <?php echo form_input('product_price', $product['product_price'], ['class' => 'form-control', 'placeholder' => 'Enter Product Price', 'readonly' => 'readonly']); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo form_label('SKU'); ?>
                                        <?php echo form_input('product_sku', $product['product_sku'], ['class' => 'form-control', 'placeholder' => 'Enter Product Sku', 'readonly' => 'readonly']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Status'); ?>
                                        <?php echo form_dropdown('product_status', ['' => 'Pilih Status', 'Active' => 'Active', 'Inactive' => 'Inactive'], $product['product_status'], ['class' => 'form-control', 'disabled' => 'disabled']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Image'); ?>
                                        <br>
                                        <img src="<?php echo base_url('uploads/'.$product['product_image']); ?>" alt="" class="img-fluid" width="150">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Description'); ?>
                                <?php echo form_textarea('product_description', $product['product_description'], ['class' => 'form-control', 'placeholder' => 'Enter Product Description', 'readonly' => 'readonly']); ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('partials/footer'); ?>