<?php $this->load->view('partials/header'); ?>
<?php $this->load->view('partials/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
    foreach($grafik as $data){
      $month[] = $data['month'];
      $total[] = $data['total'];
    }
    ?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Sales Graph</div>
                        <div class="card-body">
                          <canvas id="sales_graph" height="70%" width="100%"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Latest Transaction</div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Date</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($latest_transactions as $key => $data){ ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $data['product_name']; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($data['trx_date'])); ?></td>
                                        <td><?php echo "Rp. ".number_format($data['trx_price']); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script>
var mychart = document.getElementById("sales_graph").getContext('2d'); // 2 dimessi
var area_chart = new Chart(mychart, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($month); ?>,
    datasets: [
      {
        label: "Grafik Penjualan",
        data: <?php echo json_encode($total); ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 253, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 255, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 253, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 255, 255, 1)',
          'rgba(255, 159, 64, 1)',
        ],
        borderWidth: 1
      }
    ]
  },
  options: {
    scales: {
      yAxes: [
        {
          ticks: {
            beginZero: true
          }
        }
      ]
    }
  }
});
</script>
<?php $this->load->view('partials/footer'); ?>