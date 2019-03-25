<?php

namespace App\Http\Controllers;

use App\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function getList(){
        $slide = Slide::all();
        return view('admin.slide.list',['slide'=>$slide]);
    }

    public function getEdit($id){
        $slide = Slide::find($id);
        return view('admin.slide.edit',['slide'=>$slide]);
    }
    public function postEdit(Request $request,$id){
        $slide = Slide::find($id);
        $this->validate($request,
            [
                'Ten'=>'required',
                'NoiDung' => 'required',
                'link' => 'required',
                'Hinh' => 'required'
            ],
            [
                'Ten.required'=>'Ban chua nhap ten',
                'NoiDung.required'=>'Ban chua nhap noi dung',
                'link.required'=>'Ban chua dien link',
                'Hinh.required'=>'Ban chua chon hinh'

            ]);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if ($request->has('link'))
            $slide->link = $request->link;
        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/slide/edit')->with('loi','bạn chỉ có thể chọn file có đuôi jpg, png. jpeg');
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }
        else
        {
            $slide ->Hinh = "";
        }
        $slide->save();
        return redirect('admin/slide/edit/'.$id)->with('thongbao','edit thanh cong');

    }

    public function getDelete($id){
        $slide = Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/list')->with('thongbao','Success Deleted');
    }

    public function getAdd(){
        return view('admin.slide.add');
    }

    public function postAdd(Request $request){
        $this->validate($request,
            [
                'Ten'=>'required',
                'NoiDung' => 'required',
                'link' => 'required',
                'Hinh' => 'required'
            ],
            [
                'Ten.required'=>'Ban chua nhap ten',
                'NoiDung.required'=>'Ban chua nhap noi dung',
                'link.required'=>'Ban chua dien link',
                'Hinh.required'=>'Ban chua chon hinh'

            ]);
        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if ($request->has('link'))
            $slide->link = $request->link;
        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/slide/edit')->with('loi','bạn chỉ có thể chọn file có đuôi jpg, png. jpeg');
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("upload/slide/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }
        else
        {
            $slide ->Hinh = "";
        }
        $slide->save();
        return redirect('admin/slide/add')->with('thongbao','them thanh cong');
    }
}
