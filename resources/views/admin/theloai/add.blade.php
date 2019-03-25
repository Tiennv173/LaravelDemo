@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
            @endif
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
                <form action="{{'admin/theloai/add'}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input class="form-control" name="name" placeholder="Nhập tên người dùng" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" placeholder="Nhập email" />
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <input class="form-control" name="quyen" placeholder="Nhập level người dùng" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" name="password" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <label>Password Again</label>
                        <input class="form-control" name="passwordagain" placeholder="Nhập tên người dùng" />
                    </div>
                    <button type="submit" class="btn btn-default">Thêm thể loại</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection