<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    public function getList(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.list',['loaitin'=>$loaitin]);
    }

    public function getEdit($id){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.edit',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postEdit(Request $request,$id){
        $this->validate($request,
            ['Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai'=>'required'],
            ['Ten.required'=>'Ban chua nhap ten loai tin',
                'Ten.unique'=>'Ten loai tin da ton tai',
                'Ten.min'=>'Ten loai tin co do dai tu 1-100',
                'Ten.max'=>'Ten loai tin co do dai tu 1-100',
                'TheLoai.required'=>'Ban chua chon the loai'
            ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/edit/'.$id)->with('thongbao','Sua thanh cong');
    }

    public function getDelete($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/list')->with('thongbao','Bạn đã xóa thành công');
    }

    public function getAdd(){
        $theloai=TheLoai::all();
        return view('admin.loaitin.add',['theloai'=>$theloai]);
    }

    public function postAdd(Request $request, $id){
        $this->validate($request,
            ['Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai'=>'required'],
            ['Ten.required'=>'Ban chua nhap ten loai tin',
                'Ten.unique'=>'Ten loai tin da ton tai',
                'Ten.min'=>'Ten loai tin co do dai tu 1-100',
                'Ten.max'=>'Ten loai tin co do dai tu 1-100',
                'TheLoai.required'=>'Ban chua chon the loai'
            ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/add'.$id)->with('thongbao','Ban da them thanh cong');
    }
}
