<?php $this->load->view('partials/header'); ?>
<?php $this->load->view('partials/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Product</li>
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
                        <?php echo form_open_multipart('product/store'); ?>
                        <div class="card-header">Create Product</div>
                        <div class="card-body">
                            <?php
                                if(!empty($this->session->flashdata('inputs'))){
                                    $inputs = $this->session->flashdata('inputs');
                                } else {
                                    $inputs = [];
                                }
                                $errors = $this->session->flashdata('errors');
                                if(!empty($errors)){
                            ?>
                                <!-- Munculkan pesan error -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">
                                            <ul>
                                                <?php foreach($errors as $error){ ?>
                                                <li><?php echo $error; ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo form_label('Category'); ?>
                                        <?php echo form_dropdown('category_id', $set_category, $inputs['category_id'], ['class' => 'form-control']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Name'); ?>
                                        <?php echo form_input('product_name', $inputs['product_name'], ['class' => 'form-control', 'placeholder' => 'Enter Product Name']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Price'); ?>
                                        <?php echo form_input('product_price', $inputs['product_price'], ['class' => 'form-control', 'placeholder' => 'Enter Product Price']); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo form_label('SKU'); ?>
                                        <?php echo form_input('product_sku', $inputs['product_sku'], ['class' => 'form-control', 'placeholder' => 'Enter Product Sku']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Status'); ?>
                                        <?php echo form_dropdown('product_status', ['' => 'Pilih Status', 'Active' => 'Active', 'Inactive' => 'Inactive'], $inputs['product_status'], ['class' => 'form-control']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Image'); ?>
                                        <?php echo form_upload('product_image', ['class' => 'form-control']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Description'); ?>
                                <?php echo form_textarea('product_description', $inputs['product_description'], ['class' => 'form-control', 'placeholder' => 'Enter Product Description']); ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info">Back</a>
                            <button class="btn btn-primary float-right" type="submit">Save</button>
                        </div>
                        <?php echo form_close(); ?>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('partials/footer'); ?>