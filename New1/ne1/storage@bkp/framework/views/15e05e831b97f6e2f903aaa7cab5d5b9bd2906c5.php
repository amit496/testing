<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<script src="<?php echo e(mix("js/chartjs.js"), false); ?>" charset=utf-8></script>

<script type="text/javascript">
    var salesCtx;
    var generate;
    ;(function ($, window, document) {
        // var sorter = $('#sortable').rowSorter({
        var startDate;
        var endDate;
        var jsonData = '<?php echo json_encode($chartDataArray);?>';
        var chartData =  JSON.parse(jsonData);
        var chartFormatData = chartDataFormat(chartData);
         salesCtx = document.getElementById('salesReport').getContext('2d');
         generate = new Chart(salesCtx, chartFormatData);

        //let dataString = "fromDate=&toDate=";
        //dateToDateSearch(dataString);
        $(document).ready(function () {
            $('#daterangepicker').daterangepicker(
                {
                    startDate: moment().subtract('days', 6),
                    endDate: moment(),
                    showDropdowns: false,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 30,
                    timePicker12Hour: false,
                    ranges: {
                        '<?php echo e(trans('app.today'), false); ?>': [moment(), moment()],
                        '<?php echo e(trans('app.yesterday'), false); ?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '<?php echo e(trans('app.last_7_days'), false); ?>': [moment().subtract(6, 'days'), moment()],
                        '<?php echo e(trans('app.last_30_day'), false); ?>': [moment().subtract(29, 'days'), moment()],
                        '<?php echo e(trans('app.this_month'), false); ?>': [moment().startOf('month'), moment()],
                        '<?php echo e(trans('app.last_month'), false); ?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        '<?php echo e(trans('app.last_12_month'), false); ?>': [moment().startOf('month').subtract(12, 'month'), moment().endOf('month')],
                        '<?php echo e(trans('app.this_year'), false); ?>': [moment().startOf('year'), moment()],
                        '<?php echo e(trans('app.last_year'), false); ?>': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                    },
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    cancelClass: 'btn-small',
                    format: 'DD/MM/YYYY',
                    separator: ' to ',
                },
                function (start, end) {
                    //console.log("Callback has been called!");
                    $('#daterangepicker span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
                    $('#getFromDate').val(start.format('YYYY-MM-DD'));
                    $('#getToDate').val(end.format('YYYY-MM-DD'));

                    startDate = start.format('YYYY-MM-DD');
                    endDate = end.format('YYYY-MM-DD');
                    //Filter Variable Values
                    let customer = $('#customerId').val();
                    let shop = $('#shopId').val();
                    let orderNumber = $('#orderNumber').val();
                    let orderStatus = $('#orderStatus').val();
                    //console.log(window.location.hostname)
                    let dataString = "customerId=" + customer + "&shopId=" + shop + "&orderNumber=" + orderNumber +
                        "&orderStatus=" + orderStatus + "&fromDate=" + startDate + "&toDate=" + endDate;
                    //Data Table Reset After Ajax:
                    dataTableResetting(dataString);
                    //Get Chart Data Via Ajax:
                    let ajaxUrl = '<?php echo e(route('admin.sales.getMoreForChart'), false); ?>';
                    $.ajax({
                        url:ajaxUrl+'/?'+dataString,
                        contentType: 'application/json',
                        success:function (response){
                            generate.clear();
                            generate.destroy();
                            //console.log(generate);
                            chartFormatData = chartDataFormat(response.data);
                            //generate.update(salesCtx, chartFormatData)
                            generate = new Chart(salesCtx, chartFormatData);
                            ///addData(generate, chartFormatData);
                        }
                    });
                }
            );
            //Set the initial state of the picker label
            $('#daterangepicker span').html(moment().subtract('days', 7).format('D MMMM YYYY') + ' - ' + moment().format('D MMMM YYYY'));
            $('#getFromDate').val(moment().subtract('days', 7).format('YYYY-MM-DD'));
            $('#getToDate').val(moment().format('YYYY-MM-DD'));


            /*Chart to Image Download*/
            /*document.getElementById("downloadOrder").addEventListener('click', function(){
                /!*Get image of canvas element*!/
                var url_base64jp = document.getElementById("salesReport").toDataURL("image/jpg");
                /!*get download button (tag: <a></a>) *!/
                var a =  document.getElementById("downloadOrder");
                /!*insert chart image url to download button (tag: <a></a>) *!/
                a.href = url_base64jp;
            });*/


        });
        ///Calling Chart Function to manipulate:

    }(window.jQuery, window, document));

    ///Searching and Manipulating DataTable Data:
    function dataTableResetting(dataString)
    {
        var table = $('.table-no-sort');
        if ($.fn.dataTable.isDataTable(table)) {
            table.DataTable().destroy();
            //table.clear();
        }
        let url = '<?php echo e(route('admin.sales.getMore'), false); ?>';

        table.DataTable({
            "responsive": true,
            "iDisplayLength": <?php echo e(getPaginationValue(), false); ?>,
            "ajax": url + '/?' + dataString,
            "columns": [
                {
                    'data': 'date',
                    'name': 'date',
                    'orderable': true,
                    'searchable': true,
                    'exportable': true,
                    'printable': true
                },{
                    'data': 'delivery_date',
                    'name': 'delivery_date',
                    'orderable': true,
                    'searchable': true,
                    'exportable': true,
                    'printable': true
                },{
                    'data': 'order_number',
                    'name': 'order_number',
                    'orderable': true,
                    'searchable': true,
                    'exportable': true,
                    'printable': true
                },{
                    'data': 'customer',
                    'name': 'customer',
                    'orderable': true,
                    'searchable': true,
                    'exportable': true,
                    'printable': true
                },{
                    'data': 'shop',
                    'name': 'shop',
                    'orderable': true,
                    'searchable': true,
                    'exportable': true,
                    'printable': true
                },{
                    'data': 'quantity',
                    'name': 'quantity',
                    'orderable': true,
                    'searchable': true,
                    'exportable': true,
                    'printable': true
                },{
                    'data': null,
                    'render' : function (data) {
                        return Number(data.grand_total);
                    },
                    'name': 'total',
                    'orderable': true,
                    'searchable': true,
                    'exportable': true,
                    'printable': true
                },
            ],
            "oLanguage": {
                "sInfo": "_START_ to _END_ of _TOTAL_ entries",
                "sLengthMenu": "Show _MENU_",
                "sSearch": "",
                "sEmptyTable": "No data found!",
                "oPaginate": {
                    "sNext": '<i class="fa fa-hand-o-right"></i>',
                    "sPrevious": '<i class="fa fa-hand-o-left"></i>',
                },
            },
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [-1]
            }],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    }

    //This function Will Return Data Configuration:
    function chartDataFormat(chartData)
    {
        let chartCount = chartData.length;
        let labelData = [];
        let awaitingDelivery = [];
        let awaitingPayment = [];
        let canceled = [];
        let paymentError = [];
        let returned = [];
        let fulfilled = [];
        let confirmed = [];
        let delivered = [];
        let disputed = [];

        for(let i = 0; i < chartData.length; i++){
            labelData.push( chartData[i].date);if(i < chartCount -1 ){','}
            awaitingDelivery.push( chartData[i].awaiting_delivery);if(i < chartCount -1 ){','}
            canceled.push( chartData[i].canceled);if(i < chartCount -1 ){','}
            paymentError.push( chartData[i].payment_error);if(i < chartCount -1 ){','}
            returned.push( chartData[i].returned);if(i < chartCount -1 ){','}
            fulfilled.push( chartData[i].fulfilled);if(i < chartCount -1 ){','}
            confirmed.push( chartData[i].confirmed);if(i < chartCount -1 ){','}
            delivered.push( chartData[i].delivered);if(i < chartCount -1 ){','}
            disputed.push( chartData[i].disputed);if(i < chartCount -1 ){','}
            awaitingPayment.push( chartData[i].awaiting_payment);if(i < chartCount -1 ){','}
        }
        //console.log(labelData)
        let saleReport = {
            type: 'bar',
            data: {
                labels: labelData,
                datasets: [
                    {
                        label: 'Awaiting Delivery',
                        fill: false,
                        backgroundColor: "#d238aa",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(232,105,90,0.8)",
                        hoverBorderColor: "orange",
                        data:awaitingDelivery,
                    },{
                        label: 'Awaiting Payment',
                        fill: false,
                        backgroundColor: "#FFA500",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(23,105,90,0.8)",
                        hoverBorderColor: "orange",
                        data:awaitingPayment,
                    },{
                        label: 'Canceled',
                        fill: false,
                        backgroundColor: "#FFFF00",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(232,105,90,0.8)",
                        hoverBorderColor: "orange",
                        data: canceled,
                    },{
                        label: 'Payment Error',
                        fill: false,
                        backgroundColor: "#fb5a2a",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(232,105,90,0.8)",
                        hoverBorderColor: "orange",
                        data: paymentError,
                    },{
                        label: 'Returned',
                        fill: false,
                        backgroundColor: "#353535",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(232,105,90,0.8)",
                        hoverBorderColor: "orange",
                        data: returned,
                    },{
                        label: 'Fulfilled',
                        fill: false,
                        backgroundColor: "#337ab7",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(232,105,90,0.8)",
                        hoverBorderColor: "orange",
                        data: fulfilled,
                    },{
                        label: 'Confirmed',
                        fill: false,
                        backgroundColor: "#00c0ef",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(232,105,90,0.8)",
                        hoverBorderColor: "orange",
                        data: confirmed,
                    },{
                        label: 'Delivered',
                        fill: false,
                        backgroundColor: "#00a65a",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(232,105,90,0.8)",
                        hoverBorderColor: "orange",
                        data: delivered,
                    },{
                        label: 'Disputed',
                        fill: false,
                        backgroundColor: "#da1a07",
                        borderWidth: 1,
                        hoverBackgroundColor: "rgba(232,105,90,0.8)",
                        hoverBorderColor: "orange",
                        data: disputed,
                    }
                ]
            },
            options: {
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        fontSize:18
                    },
                },
                hoverBackgroundColor:true,
                responsive: true,
                title: {
                    display: true,
                    text: 'Sales History',
                    fontSize: 20
                },
                tooltips: {
                    mode: 'index',
                    intersect: true,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    x: {
                        display: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Days'
                        }
                    },
                    y: {
                        display: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }
                }
            }
        };

        return saleReport;
    }

    function ajaxFire(ajaxUrl, params,  handleData)
    {
        $.ajax({
            url:ajaxUrl+'/?'+params,
            method:'get',
            contentType: 'application/json',
            success:function (response){
                handleData(response.data);
            }
        });
    }

    //Clear All Filter:
    function clearAllFilter()
    {
         $("#customerId").select2("val", "");
         $('#shopId').select2("val", "");
         $('#orderNumber').val("");
         $('#orderStatus').val("");
         $('#paymentStatus').val("");
    }

    function fireEventOnFilter(str)
    {
        let chartUrl = '<?php echo e(route('admin.sales.getMoreForChart'), false); ?>';
        let dataUrl = '<?php echo e(route('admin.sales.getMore'), false); ?>';
        let customer =  $('#customerId').val();
        let shop =  $('#shopId').val();
        let orderNumber =  $('#orderNumber').val();
        let orderStatus =  $('#orderStatus').val();
        let paymentStatus =  $('#paymentStatus').val();
        let fromDate = $('#getFromDate').val();
        let toDate = $('#getToDate').val();

        let dataString = "&paymentStatus=" +paymentStatus +"&customerId=" +customer + "&shopId=" + shop +
            "&orderNumber=" +orderNumber+ "&orderStatus=" +orderStatus+ "&fromDate=" +fromDate+ "&toDate="+ toDate;

         dataTableResetting(dataString);

         ajaxFire(chartUrl, dataString, function (output){
             generate.clear();
             generate.destroy();
             //console.log(generate);
            let  chartFormatData = chartDataFormat(output);
             //generate.update(salesCtx, chartFormatData)
             generate = new Chart(salesCtx, chartFormatData);
         });
    }
</script><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/plugins/report-orders.blade.php ENDPATH**/ ?>