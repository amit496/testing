<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/frotend-stylist-form-common-all.css">
    <link rel="stylesheet" href="public/css/frotend-stylist-form-common.css">
    <link rel="stylesheet" href="public/css/app.css">
        <style>
    .rb-text-box {
        position: absolute;
        left: 35%;
        top: 30%;
        transform: translate(-35%, -30%);
    }

    .sending_message {
        margin-top: 5%;
        text-align: left;
    }


    .header {
        display: none;
    }

    .back_btn_md a {
        text-decoration: none;
        color: #212121;
        font-weight: 600;
        /* display: block; */
    }
    .order_details_button a {
        text-decoration: none;
        color: #212121;
        font-weight: 600;
        display: block;
    }
</style>
</head>
<body>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 pt-5">
                    <div class="row rb-text-box">
                        <p class="lead sending_message"><b>Thank you for your order. </b></p>
                        <p class="lead sending_message">We'll get packing and get your order to you as soon as possible!</p>
                        <div class="link d-flex">
                            <a class="btn btn-default flat  order_details_button" style="width: 225px;" href="{{ route('order.detail', $order) }}">VIEW ORDER</a>
                            <a class="btn btn-default flat  order_details_button" style="width: 225px;" href="{{ url('stylist/customer/info') }}">DASHBOARD</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="rb-bg-img">
                        <img src="public/images/stylist/questions/section/2121222.jpg" width="100%">
                    </div>
                </div>
            </div><!-- /.row -->
        </div> <!-- /.container -->
    </section>
</body>
</html>
