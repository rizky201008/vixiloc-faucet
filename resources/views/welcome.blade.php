@extends('templates.index')
@section('content')
    <section style="padding: 10px;">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <img src="https://i.ibb.co/DkNS6y3/vixiloc-ads.png" alt="ads" class="w-100">
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 10px">
        <div class="container">
            <div class="row cols-2">
                <div class="col-md-6 mb-2">
                    <div class="card text-center">
                        <div class="card-header">Feyorra</div>
                        <div class="card-body">
                            <h5 class="card-title">Claim Feyorra Every 5 Minutes</h5>
                            <p class="card-text">Direct payment to faucetpay.io</p>
                            <a href="/feyorra.html" class="btn btn-primary">Claim Now</a>
                        </div>
                        <div class="card-footer text-muted d-flex align-items-center justify-content-center gap-2">Balance
                            <img src="https://cdn.iconscout.com/icon/premium/png-512-thumb/cryptocurrency-wallet-2684408-2228074.png?f=avif&w=30"
                                alt="" />9000.00000000</div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="card text-center">
                        <div class="card-header">Tron</div>
                        <div class="card-body">
                            <h5 class="card-title">Claim Tron Every 5 Minutes</h5>
                            <p class="card-text">Direct payment to faucetpay.io</p>
                            <a href="/tron.html" class="btn btn-primary">Claim Now</a>
                        </div>
                        <div class="card-footer text-muted d-flex align-items-center justify-content-center gap-2">
                            Balance
                            <img src="https://cdn.iconscout.com/icon/premium/png-512-thumb/cryptocurrency-wallet-2684408-2228074.png?f=avif&w=30"
                                alt="" />100.00000000
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
