<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);

        if (Auth::check()) {
            view()->share('nguoidung',Auth::user());
        }
    }

    function trangchu(){
        return view('pages.trangchu');
    }

    function lienhe(){
        return view('pages.lienhe');
    }

    function loaitin($id) {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    function tintuc($id) {
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }

    function getdangnhap(){
        return view('pages.dangnhap');
    }

    function postdangnhap(Request $request)  {
        $this->validate($request,
            ['email'=>'required',
                'password'=>'required|min:3|max:32'],
            [
                'email.required'=>'Ban chua dang nhap',
                'password.required'=>'Ban chua nhap password',
                'password.min'=>'Password ngan',
                'password.max'=>'Password qua dai',
            ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('trangchu');
        }
        else
            return redirect('dangnhap')->with('thongbao','Dang nhap that bai');
    }

    function getdangxuat(){
        Auth::logout();
        return view('dangnhap');
    }
}
