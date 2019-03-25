@extends('admin.layout.index')
@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Edit</small>
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
                <form action="admin/slide/edit/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Tên slide</label>
                        <input class="form-control" name="Ten" value="{{$slide->Ten}}" placeholder="Nhập tên slide" />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <p><img width="300px" src="upload/slide/{{$slide->Hinh}}" alt="">
                        </p>
                        <input type="file" name="Hinh" value="{{$slide->Hinh}}" >
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <input class="form-control" name="NoiDung" value="{{$slide->NoiDung}}" placeholder="Please Enter Category Order" />
                    </div>
                    <div class="form-group">
                        <label>link</label>
                        <input class="form-control" name="link" value="{{$slide->link}}" placeholder="Please Enter Category Keywords" />
                    </div>
                    <button type="submit" class="btn btn-primary">Confirm Edit</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
    @endsection