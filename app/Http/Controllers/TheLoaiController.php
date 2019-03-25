<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getList(){
        $theloai = TheLoai::all();
        return view('admin.theloai.list',['theloai'=>$theloai]);
    }

    public function getEdit($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.edit',['theloai'=>$theloai]);
    }
    public function postEdit(Request $request,$id){
        $theloai = TheLoai::find($id);
        $this->validate($request,
            [
                'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'Ten.required'=>'bạn chưa nhập tên thể loại',
                'Ten.unique'=>'Thể loại đã bị trùng',
                'Ten.min'=>'Tên thể loại phải có độ dài từ 3-100 kí tự',
                'Ten.max'=>'Tên thể loại phải có độ dài từ 3-100 kí tự',
            ]);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/edit/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getDelete($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/list')->with('thongbao','Bạn đã xóa thành công');
    }

    public function getAdd(){
        return view('admin.theloai.add');
    }

    public function postAdd(Request $request){
        $this->validate($request,
            [
                'Ten'=>'required|min:3|max:100'
            ],
            [
                'Ten.required'=>'bạn chưa nhập tên thể loại',
                'Ten.min'=>'Tên thể loại phải có độ dài từ 3-100 kí tự',
                'Ten.max'=>'Tên thể loại phải có độ dài từ 3-100 kí tự',
            ]);
        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        echo changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/add')->with('thongbao','Them thanh cong');
    }

}
