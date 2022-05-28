<link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">

<style type="text/css">
    body {
        position: relative;
        margin-top: 60px;
        background: #f2f2f2;
    }

    .payment {
        border: 1px solid #f2f2f2;
        height: 280px;
        border-radius: 20px;
        background: #fff;
    }

    .payment_header {
        background: rgb(16, 216, 16);
        padding: 20px;
        border-radius: 20px 20px 0px 0px;

    }

    .check {
        margin: 0px auto;
        width: 50px;
        height: 50px;
        border-radius: 100%;
        background: #fff;
        text-align: center;
    }

    .check i {
        vertical-align: middle;
        line-height: 50px;
        font-size: 30px;
    }

    .content {
        text-align: center;
    }

    .content h1 {
        font-size: 25px;
        padding-top: 25px;
    }

    .content a {
        width: 200px;
        height: 35px;
        color: #fff;
        border-radius: 30px;
        padding: 5px 10px;
        background: rgb(16, 216, 16);
        transition: all ease-in-out 0.3s;
    }

    .content a:hover {
        text-decoration: none;
        background: #000;
    }

</style>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto mt-5">
            <div class="payment">
                <div class="payment_header">
                    <div class="check"><i class="lni lni-checkmark" aria-hidden="true"></i></div>
                </div>
                <div class="content">
                    <h1>Payment Successfully Completed !</h1>

                    <a href="{{ route('user.login') }}">Login</a>
                </div>

            </div>
        </div>
    </div>
</div>

@if (session()->has('pay-u-payment-success'))
    <script>
        window.open('{{ Url('/') }}' + '/storage/invoice/' + {{ session('pay-u-payment-success') }});
    </script>
@endif
