<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;

class TinTucController extends Controller
{
    public function getList(){
        $tintuc = TinTuc::orderBY('id')->get();
        return view('admin.tintuc.list',['tintuc'=>$tintuc]);
    }

    public function getEdit($id){
//        $comment = Comment::all();
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view('admin.tintuc.edit',['tintuc'=>$tintuc,'theloai'=>$theloai,
            'loaitin'=>$loaitin]);
    }
    public function postEdit(Request $request,$id){
        $tintuc = TinTuc::find($id);
        $this->validate($request,
            [
                'LoaiTin'=>'required',
                'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required'
            ],
            [
                'LoaiTin.required'=>'Bạn chưa chọn loại tin',
                'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
                'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 kí tự',
                'TieuDe.unique'=>'Tiêu đề đã tồn tại',
                'TomTat.required'=>'Bạn chưa tóm tắt',
                'NoiDung.required'=>'Bạn chưa nhập nội dung'
            ]);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;

        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/tintuc/edit')->with('loi','bạn chỉ có thể chọn file có đuôi jpg, png. jpeg');
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
        $tintuc->save();
        redirect('admin/tintuc/edit/'.$id)->with('thongbao','Edit thanh cong');
    }

    public function getDelete($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/list')->with('thongbao','Success Deleted');
    }

    public function getAdd(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.add',['theloai'=>$theloai,
            'loaitin'=>$loaitin]);
    }

    public function postAdd(Request $request){
        $this->validate($request,
            [
                'LoaiTin'=>'required',
                'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required'
            ],
            [
                'LoaiTin.required'=>'Bạn chưa chọn loại tin',
                'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
                'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 kí tự',
                'TieuDe.unique'=>'Tiêu đề đã tồn tại',
                'TomTat.required'=>'Bạn chưa tóm tắt',
                'NoiDung.required'=>'Bạn chưa nhập nội dung'
            ]);
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
        $tintuc->NoiBat = $request->NoiBat;

        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/tintuc/add')->with('loi','bạn chỉ có thể chọn file có đuôi jpg, png. jpeg');
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/tintuc/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }
        else {
            $tintuc->Hinh = "";
        }
        $tintuc->save();

        return redirect('admin/tintuc/add')->with('thongbao','Thêm tin thành công');
    }
}
