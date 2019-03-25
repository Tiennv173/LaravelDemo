@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>{{$tintuc->TieuDe}}</small>
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
                    <form action="admin/tintuc/edit/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="TheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option
                                    @if($tintuc->loaitin->theloai->id == $tl->id)
                                            {{"selected"}}
                                            @endif
                                            value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name="LoaiTin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option
                                            @if($tintuc->loaitin->id == $lt->id)
                                            {{"selected"}}
                                            @endif
                                            value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}"/>
                        </div>

                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea id="demo" name="TomTat" class="form-control ckeditor" rows="3">{{$tintuc->TomTat}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="demo" name="NoiDung" class="form-control ckeditor" rows="5">{{$tintuc->NoiDung}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <p><img width="200px" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">
                            </p>
                            <input type="file" name="Hinh" >
                        </div>
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0"
                                 @if($tintuc->Noibat == 0)
                                 {{"checked"}}
                                 @endif
                                 type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1"
                                       @if($tintuc->Noibat == 0)
                                       {{"checked"}}
                                       @endif
                                       type="radio">Có
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->

            {{--<div class="row">--}}
                {{--<div class="col-lg-12">--}}
                    {{--<h1 class="page-header">Bình luận--}}
                        {{--<small>Danh sách</small>--}}
                    {{--</h1>--}}
                {{--</div>--}}
                {{--<!-- /.col-lg-12 -->--}}
                {{--@if(count($errors)>0)--}}
                    {{--<div class="alert alert-danger">--}}
                        {{--@foreach($errors->all() as $err)--}}
                            {{--{{$err}}<br>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--@endif--}}
                {{--@if(session('thongbao'))--}}
                    {{--<div class="alert alert-success">--}}
                        {{--{{session('thongbao')}}--}}
                    {{--</div>--}}
                {{--@endif--}}
                {{--<table class="table table-striped table-bordered table-hover" id="dataTables-example">--}}
                    {{--<thead>--}}
                    {{--<tr align="center">--}}
                        {{--<th>ID</th>--}}
                        {{--<th>User</th>--}}
                        {{--<th>Nội dung</th>--}}
                        {{--<th>Ngày đăng</th>--}}
                        {{--<th>Delete</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--@foreach($tintuc->comment as $cm)--}}
                        {{--<tr class="odd gradeX" align="center">--}}
                            {{--<td>{{$cm->id}}</td>--}}
                            {{--<td>{{$cm->user->name}}</td>--}}
                            {{--<td>{{$cm->NoiDung}}</td>--}}
                            {{--<td>{{$cm->created_at}}</td>--}}
                            {{--<td class="center"><i class="far fa-trash-alt"></i><a href="admin/comment/delete/{{$cm->id}}">Delete</a></td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
            {{--end row--}}
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->


@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $("#TheLoai").change(function () {
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function (data) {
                    $("#LoaiTin").html(data)
                })
            })
        })
    </script>
@endsection