@extends('home.layouts.master')
@section('content')

    <div class="col-sm-12">
        <div class="box">
            <div class="box-body">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> StarServer
                                <small class="pull-right">Date: {{date_format($date->created_at,'d/m/Y H:i')}}</small>
                            </h2>
                        </div><!-- /.col -->
                    </div>


                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Product</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allBasket as $basket)
                                <tr>
                                    <td>{{$basket->count}}</td>
                                    <td>{{$basket->menu_name}}</td>
                                    <td>&#163; {{StarLib::sumWithCount($basket->price,$basket->count)}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">

                        </div>
                        <div class="col-xs-6">
                            <p class="lead">Amount Due {{date_format($date->created_at,'d/m/Y H:i')}}</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>$250.30</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (9.3%)</th>
                                        <td>$10.34</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping:</th>
                                        <td>$5.80</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>$265.24</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a href="/print" class="btn btn-success btn-lg pull-right"><i class="fa fa-credit-card"></i> Print Basket</a>
                            <a href="/" class="btn btn-danger btn-lg pull-right" style="margin-right: 5px;"><i class="fa fa-arrow-left"></i> Cancel</a>
                        </div>
                    </div>
                </section><!-- /.content -->
            </div>
        </div>
    </div>



@endsection