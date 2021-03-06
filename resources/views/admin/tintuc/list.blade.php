@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>Danh sách</small>
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
                    <th>Tiêu đề</th>
                    <th>Summarry</th>
                    <th>Thể loại</th>
                    <th>Loại tin</th>
                    <th>Lượt xem</th>
                    <th>Nổi bật</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tintuc as $tt)
                <tr class="odd gradeX" align="center">
                    <td>{{$tt->id}}</td>
                    <td>
                        <p>{{$tt->TieuDe}}</p>
                        <img width="100px" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                    </td>
                    <td>{{$tt->TomTat}}</td>
                    <td>{{$tt->loaitin->theloai->Ten}}</td>
                    <td>{{$tt->loaitin->Ten}}</td>
                    <td>{{$tt->SoLuotXem}}</td>
                    <td>
                        @if($tt->NoiBat == 0)
                            {{'Không'}}
                        @else {{'Có'}}
                        @endif

                    </td>

                    <td class="center"><i class="far fa-trash-alt"></i><a href="admin/tintuc/delete/{{$tt->id}}">Delete</a></td>
                    <td class="center"><i class="fas fa-pencil-alt"></i> <a href="admin/tintuc/edit/{{$tt->id}}">Edit</a></td>
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