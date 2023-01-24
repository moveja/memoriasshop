<script>
    document.addEventListener('livewire:load', function() {
        var options = {
          series: [
            parseFloat(@this.top5Data[0]['total']),
            parseFloat(@this.top5Data[1]['total']),
            parseFloat(@this.top5Data[2]['total']),
            parseFloat(@this.top5Data[3]['total']),
            parseFloat(@this.top5Data[4]['total'])
          ],
          chart: {
          type: 'donut',
          height: 394
        },
        labels: [
            @this.top5Data[0]['product'],
            @this.top5Data[1]['product'],
            @this.top5Data[2]['product'],
            @this.top5Data[3]['product'],
            @this.top5Data[4]['product']
        ],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chartTop5"), options);
        chart.render();
    
    //--------------------------------------------------------------------------------//
    //                      WEEK    SALES                                             //
    //--------------------------------------------------------------------------------//



    var optionsArea = {
          series: [{
          name: 'Ventas del dia',
          data: [
            parseFloat(@this.weekSales_Data[0]),
            parseFloat(@this.weekSales_Data[1]),
            parseFloat(@this.weekSales_Data[2]),
            parseFloat(@this.weekSales_Data[3]),
            parseFloat(@this.weekSales_Data[4]),
            parseFloat(@this.weekSales_Data[5]),
            parseFloat(@this.weekSales_Data[6])
          ]
        }],
          chart: {
          height: 380,
          type: 'area'
        },
        dataLabels: {
          enabled: true,
          formatter: function(val) {
            return '$' + val
          },
          offsetY: -5,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories: ['Lunes','Martes','Miercoles','Jueves','Viernes','Sábado','Domingo']
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };

        var areaChart = new ApexCharts(document.querySelector("#areaChart"), optionsArea);
        areaChart.render();


        //------------------------------------------------------------------//
        //------------------------------------------------------------------//

        var optionsMonth = {
          series: [{
          name: 'Ventas por mes',
          data: @this.salesByMonth_Data
        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return "$" + parseFloat(val).toFixed(2);
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return "$" + val;
            }
          }
        
        },
        title: {
          text: totalYearSales(),
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chartMonth = new ApexCharts(document.querySelector("#chartMonth"), optionsMonth);
        chartMonth.render();

        function totalYearSales(){
            var total = 0
            @this.salesByMonth_Data.forEach(item => {
                total += parseFloat(item)
            })
            return 'Total: $' + total.toFixed(2)
        } 


    })
</script>