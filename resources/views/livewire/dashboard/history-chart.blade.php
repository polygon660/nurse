<div>
    {{-- <form>
        <input type="date" wire:model="yearstart">
        <input type="date" wire:model="toyear">
    </form> --}}
    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    <div class="container">
        <div class="row">
            <div class="col text-end">นักเรียน/นักศึกษาทั้งหมด {{ $count_std }} ครั้ง</div>
            <div class="col  text-center">บุคลากร {{ $count_teacher }} ครั้ง</div>
            <div class="col text-start">บุคคลภายนอก {{ $count_guest }} ครั้ง</div>
        </div>
    </div>
</div>
@push('script')
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        // var label = {{ $date }};
        // var data1 = {{ $student }};
        // var data2 = {{ $teacher }};
        // var data3 = {{ $guest }};

        $(function() {



            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true
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
                },
                // title: {
                //     display: true,
                //     text: 'Chart.js Line Chart'
                // }
            }


            var areaChartData = {
                labels: {!! $date !!},

                datasets: [{
                        label: 'student',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: true,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: {{ $student }}
                    },
                    {
                        label: 'teacher',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: true,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: {{ $teacher }}
                    },
                    {
                        label: 'guest',
                        backgroundColor: 'rgba(251, 14, 144, 1)',
                        borderColor: 'rgba(251, 14, 144, 1)',
                        pointRadius: true,
                        pointColor: 'rgba(251, 14, 144, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(251, 14, 14, 1)',
                        data: {{ $guest }}
                    },
                ]
            }
            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartData.datasets[2].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            })



        })
    </script>
@endpush
