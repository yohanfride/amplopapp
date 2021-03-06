



<?php include("header.php") ?>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="align-items-center">
                        <h3 class="card-title text-center">
                            Grafik Rekapitulasi Penerimaan Amplop - <?= ($opt == 'umat')?'[Berdasarkan Jumlah Umat]':'Berdasrkan Jumlah Amplop'; ?>
                            <?php if($wil){ ?>
                              <span class="text-primary"> Wilayah <?= $wilayah->wilayah; ?> [<?= $wilayah->kode_wilayah; ?>]  </span> 
                            <?php } ?>
                        </h3>
                        <h3 class="card-title text-center" style="font-size: 16px;">Data per Tanggal : <b class="text-primary"><?= date('d - m - Y')?></b> </h3>
                    </div>
                    <!-- <div class="mb-2 mt-2">
                        <canvas id="myChart"></canvas>
                    </div> -->
                    <?php for($i=0; $i<count($list); $i++ ){ ?>
                    <div class="mb-2 mt-2">
                        <canvas id="myChart<?= $i; ?>"></canvas>
                    </div>
                    <?php } ?>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>


<?php include("footer.php") ?>
<script src="<?= base_url()?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- JS Libraies -->
<script src="<?= base_url()?>assets/node_modules/chart.js/dist/Chart.min.js"></script>

<script type="text/javascript">
    
    function chartjs_init(id, labels,data1,data2){
        var ctx = document.getElementById(id).getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: ['Amplop Telah Diterima'],
              data: data1,
              borderWidth: 2,
              backgroundColor: '#6777ef',
              borderColor: '#6777ef',
              borderWidth: 2.5,
              pointBackgroundColor: '#ffffff',
              pointRadius: 4
            },{
              label: ['Amplop Belum Diterima'],
              data: data2,
              borderWidth: 2,
              backgroundColor: '#fc544b',
              borderColor: '#fc544b',
              borderWidth: 2.5,
              pointBackgroundColor: '#ffffff',
              pointRadius: 4
            }]
          },
          options: {
            legend: {
              display: true
            },
            scales: {
              yAxes: [{
                gridLines: {
                  drawBorder: false,
                  color: '#f2f2f2',
                },
                ticks: {
                  beginAtZero: true,
                  max:<?= $max?>,
                  callback: function(value, index, values) {
                      if(parseInt(value) >= 1000){
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                      } else {
                        return value;
                      }
                    }
                }
              }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return  Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                            return i > 0 && c !== "," && (a.length - i) % 3 === 0 ? "." + c : c;
                        });
                    }
                }
            },
            "animation": {
                "duration": 1,
              "onComplete": function() {
                var chartInstance = this.chart,
                  ctx = chartInstance.ctx;
 
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';
 
                this.data.datasets.forEach(function(dataset, i) {
                  var meta = chartInstance.controller.getDatasetMeta(i);
                  meta.data.forEach(function(bar, index) {
                    var data = dataset.data[index];
                    data = Number(data).toFixed(0).replace(/./g, function(c, i, a) {
                            return i > 0 && c !== "," && (a.length - i) % 3 === 0 ? "." + c : c;
                        });
                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                  });
                });
              }
            },

          }
        });        
    }

    $(document).ready(function() {
        <?php for($i=0; $i<count($list); $i++ ){ ?>
            chartjs_init("myChart<?= $i?>",["<?= implode('","', $list[$i]) ?>"],[<?= implode(',', $item_terhitung[$i]) ?>],[<?= implode(',', $item_belum_terhitung[$i]) ?>]);
        <?php } ?>
        setTimeout(function(){ 
          window.print(); 
          setTimeout(window.close, 0);
        },1000);
    } );
</script>
