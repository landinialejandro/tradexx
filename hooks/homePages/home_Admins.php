<!-- Main content -->
<!--------------------------
 | Your Page Content Here |
 -------------------------->
<?php
$invoices = sqlValue("SELECT COUNT(`id`) from `Invoice` where `type` = 'Invoice'");
$crm = sqlValue("SELECT COUNT(`id`) from `CRM` where `Type` = 'ORDER'");
$customer = sqlValue("SELECT COUNT(`id`) from `Customers` ");
$trackings = sqlValue("SELECT COUNT(`id`) from `Tracking`");
?>
<div class="row" style="background-color: transparent;">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>
          <span class="counter" data-startcountvalue="<?php echo '0'; ?>" data-endcountvalue="<?php echo $invoices; ?>">
            0
          </span>
        </h3>

        <p>New Orders</p>
      </div>
      <div class="icon">
        <i class="fas fa-shopping-bag"></i>
      </div>
      <a href="Invoice_view.php" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>
          <span class="counter" data-startcountvalue="<?php echo '0'; ?>" data-endcountvalue="<?php echo $crm; ?>">
            0
          </span>
        </h3>

        <p>New CRM Orders</p>
      </div>
      <div class="icon">
        <i class="far fa-comments"></i>
      </div>
      <a href="CRM_view.php" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>
          <span class="counter" data-startcountvalue="<?php echo '0'; ?>" data-endcountvalue="<?php echo $customer; ?>">
            0
          </span>
        </h3>

        <p>Customers</p>
      </div>
      <div class="icon">
      <i class="fas fa-user-check"></i>
      </div>
      <a href="CRM_view.php" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>
          <span class="counter" data-startcountvalue="<?php echo '0'; ?>" data-endcountvalue="<?php echo $trackings; ?>">
            0
          </span>
        </h3>

        <p>Trackings</p>
      </div>
      <div class="icon">
      <i class="far fa-paper-plane"></i>
      </div>
      <a href="CRM_view.php" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>
<div class="row" style="background-color: transparent;">
  <div class="col-md-6">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-pie mr-1"></i>
          Sales
        </h3>
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
            </li>
          </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content p-0">
          <!-- Morris chart - Sales -->
          <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
          </div>
          <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
          </div>
        </div>
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->

  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Latest Orders</h3>
    
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <?php
        $res = sql('SELECT * FROM SQL_view_Sales',$e);
        //var_dump($res);
    
      ?>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Item</th>
                <th>Status</th>
                <th>Employee</th>
              </tr>
            </thead>
            <tbody>
            <?php
            foreach ($res as $key => $value) {
              //var_dump($value);
              ob_start();
              ?>
                <tr>
                  <td><a href="Invoice_view.php?SelectedID=<?php echo $value['id'] ?>"><?php echo $value['id'] ?></a></td>
                  <td><?php echo $value['item'] ?></td>
                  <td>
                    <span class="badge badge-<?php 
                      if ($value['PaymentStatus'] === 'UNPAID') echo 'danger';
                      if ($value['PaymentStatus'] === 'PAID') echo 'success';
                      if ($value['PaymentStatus'] === 'PARTIAL PAYMENT') echo 'warning';
                      ?>"><?php echo $value['PaymentStatus'] ?></span>
                    <span class="badge badge-<?php 
                      if ($value['Status'] === 'CANCELED') echo 'danger';
                      if ($value['Status'] === 'CLOSED') echo 'success';
                      if ($value['Status'] === 'OPEN') echo 'warning';
                      ?>"><?php echo $value['Status'] ?></span>
                    </td>
                  <td><?php echo $value['usrAdd'] ?></td>
                </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <a href="Invoice_view.php?addNew_x=1" class="btn btn-sm btn-info float-left">Place New Order</a>
        <a href="Invoice_view.php" class="btn btn-sm btn-secondary float-right">View All Orders</a>
      </div>
      <!-- /.card-footer -->
    </div>
  </div>
</div>

<div class="row">

</div>
<!-- ChartJS -->
<script src="LAT/adminlte3/plugins/chart.js/Chart.js"></script>
<script>
  $j(function() {
    // here you need to make an ajax to get the array values form a php.
    $j.get("LAT/data-ajax.php", {
        productid: 1
      },
      function(data, textStatus, jqXHR) {
        //console.log("data_ret: " + data);
        data = data.split("_");
        //console.log("data split0: " + data[0]);
        //console.log("data split1: " + data[1]);

        callDrawFunction(data);
      },
      "text"
    );
  });

  function callDrawFunction(data) {
    /* Chart.js Charts */
    // Sales chart
    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
    //$('#revenue-chart').get(0).getContext('2d');

    var salesChartData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
          label: 'Digital Goods',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor: '#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: data[0].split(",")
        },
        {
          label: 'Electronics',
          backgroundColor: 'rgba(210, 214, 222, 1)',
          borderColor: 'rgba(210, 214, 222, 1)',
          pointRadius: false,
          pointColor: 'rgba(210, 214, 222, 1)',
          pointStrokeColor: '#c1c7d1',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: data[1].split(",")
        },
      ]
    }

    var salesChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          }
        }],
        yAxes: [{
          gridLines: {
            display: false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var salesChart = new Chart(salesChartCanvas, {
      type: 'line',
      data: salesChartData,
      options: salesChartOptions
    })

    // Donut Chart
    var pieChartCanvas = $j('#sales-chart-canvas').get(0).getContext('2d')
    var pieData = {
      labels: [
        'Instore Sales',
        'Download Sales',
        'Mail-Order Sales',
      ],
      datasets: [{
        data: [30, 12, 20],
        backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
      }]
    }
    var pieOptions = {
      legend: {
        display: false
      },
      maintainAspectRatio: false,
      responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions
    });
    $j('.counter').visibilityChanged({
      callback: function(element, visible, initialLoad) {
        // do something
      }
    });
  };
</script>