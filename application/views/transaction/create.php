<?php $this->load->view('partials/header'); ?>
<?php $this->load->view('partials/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Import Transaction</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Import Transaction</li>
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
                        <?php echo form_open_multipart('transaction/import'); ?>
                        <div class="card-header">Import Transaction</div>
                        <div class="card-body">
                            <div class="form-group">
                                <?php echo form_label('File Excel'); ?>
                                <?php echo form_upload('trx_file', ['class' => 'form-control']); ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo base_url('transaction'); ?>" class="btn btn-outline-info">Back</a>
                            <button class="btn btn-primary float-right" type="submit">Import</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('partials/footer'); ?>