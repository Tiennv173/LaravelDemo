@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Hình</th>
                    <th>Nội dung</th>
                    <th>Link</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($slide as $sl)
                <tr class="odd gradeX" align="center">
                    <td>{{$sl->id}}</td>
                    <td>{{$sl->Ten}}</td>
                    <td>
                        <img width="300px" src="upload/slide/{{$sl->Hinh}}" alt="">
                    </td>
                    <td>{{$sl->NoiDung}}</td>
                    <td>{{$sl->link}}</td>
                    <td class="center"><i class="far fa-trash-alt"></i><a href="admin/slide/delete/{{$sl->id}}"> Delete</a></td>
                    <td class="center"><i class="fas fa-pencil-alt"></i> <a href="admin/slide/edit/{{$sl->id}}">Edit</a></td>
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