@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại Tin
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
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
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>ID thể loại</th>
                    <th>Tên không dấu</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loaitin as $lt)
                    <tr class="odd gradeX" align="center">
                        <td>{{$lt->id}}</td>
                        <td>{{$lt->Ten}}</td>
                        <td>{{$lt->idTheLoai}}</td>
                        <td>{{$lt->TenKhongDau}}</td>
                        <td class="center"><i class="far fa-trash-alt"></i><a href="admin/loaitin/delete/{{$lt->id}}"> Delete</a></td>
                        <td class="center"><i class="fas fa-pencil-alt"></i> <a href="admin/loaitin/edit/{{$lt->id}}">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection