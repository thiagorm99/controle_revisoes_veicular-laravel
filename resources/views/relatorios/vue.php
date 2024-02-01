<!DOCTYPE html>
<html>

<head>
  <title>Gráficos</title>
  <style>

  </style>
</head>

<body>
  <div id="app"></div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link href="https://getbootstrap.com/docs/4.6/examples/dashboard/dashboard.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css" rel="stylesheet">


  <script>
    var base_uri = 'http://127.0.0.1:8000';
    //var base_uri = 'https://41ff-177-101-45-179.ngrok-free.app';
    const app = Vue.createApp({
      template: `
      <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Gráficos</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>
      <div class="container-fluid">
        <div class="row">
          <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
              <ul class="nav flex-column">
                <li class="nav-item">
                <a href="#" class="nav-link active" v-on:click="getChartData('${base_uri}/relatorios/veiculos/total_veiculos_marca', 'Total veículo marca', 10)">
                  Total veículo marca
                </a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link active" v-on:click="getChartData('${base_uri}/relatorios/veiculos/total_veiculos_sexo', 'Total veículo sexo', 10)">
                  Total veículo sexo
                </a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link active" v-on:click="getChartData('${base_uri}/relatorios/revicoes/qtd_revisao_marca', 'Quantidade revisão marcas', 10)">
                  Quantidade revisão marcas
                </a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link active" v-on:click="getChartData('${base_uri}/relatorios/revicoes/qtd_revisao_pessoa', 'Quantidade revisão pessoa', 10)">
                  Quantidade revisão pessoa
                </a>
                </li>
              </ul>
            </div>
          </nav>

          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
          <canvas id="myChart" width="90" height="40"></canvas>
          </main>
          
        </div>
      </div>
      `,
      data() {
        return {
          x: null,
          y: null,
        }
      },
      methods: {
        getChartData(uri, title, maxv) {
          $.get(uri)
            .done((value) => {
              var ctx = document.getElementById('myChart').getContext('2d');
              var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: JSON.parse(value.x),
                  datasets: [{
                    data: JSON.parse(value.y),
                    backgroundColor: "gold",
                    borderWidth: 1
                  }]
                },
                options: {
                  tooltips: {enabled: false},
                  hover: {mode: null},
                  legend: {
                    display: false
                  },
                  scales: {
                    yAxes: [{
                      ticks: {
                        min: 0,
                        max: maxv,
                      }
                    }],
                  },
                  title: {
                    display: true,
                    text: title
                  }
                }
              });
            });
        }
      }

    })
    app.mount('#app')
  </script>

</body>

</html>