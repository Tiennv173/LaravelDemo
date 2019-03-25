@extends('layout.index')
@section('content')
    <div class="container">

        <!-- slider -->
        @include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                        <h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
                    </div>

                    <div class="panel-body">
                        <!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>

                        <div class="break"></div>
                        <h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                        <p>FIL lab tầng 6 thư viện Tạ Quang Bửu, Đại học Bách Khoa Hà Nội </p>

                        <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                        <p>90-92 Lê Thị Riêng, Quận 1, Bến Thành, HCM </p>

                        <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                        <p>90-92 Lê Thị Riêng, Quận 1, Bến Thành, HCM </p>



                        <br><br>
                        <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!4m12!1m6!3m5!1s0x3135ac76e3624a59:0x4f3ae5ee12bfcc19!2zVGjGsCB2aeG7h24gVOG6oSBRdWFuZyBC4butdQ!8m2!3d21.0044432!4d105.8440747!3m4!1s0x3135ac76e3624a59:0x4f3ae5ee12bfcc19!8m2!3d21.0044432!4d105.8440747" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection