<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getList(){
        $user = User::all();
        return view('admin.user.list',['user'=>$user]);
    }

    public function getEdit($id){
        $user = User::all();
        return view('admin.user.edit',['user'=>$user]);
    }
    public function postEdit(Request $request,$id){

    }

    public function getDelete($id){

    }

    public function getAdd(){
        return view('admin.user.add');
    }

    public function postAdd(Request $request){
        $this->validate($request,
            ['name'=>'required|min:3|max:100',
            'email'=>'required|email|unique:user,email',
            'password'=>'required|min:8|max:32',
                'passwordAgain'=>'required|same:password',
            ],
            ['name.required'=>'Ban chua nhap ten ',
                'email.unique'=>'email da ton tai',
                'email.required'=>'ban chua nhap dung dinh dang email',
                'name.min'=>'Ten loai tin co do dai tu 1-100',
                'name.max'=>'Ten loai tin co do dai tu 1-100',
                'password.required'=>'Ban chua nhap mat khau',
                'password.min'=>'mat khau qua ngan',
                'password.max'=>'mat khau dai',
                'passwordAgain.required'=>'Ban chua xac nhan mat khau',
                'passwordAgain.same'=>'Mat khau khong khop'
            ]);
        $user = new User;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;
        $user->email = $request->email;
        $user->save();

        return redirect('admin/user/add')->with('thongbao','them thanh cong');
    }

    public function getdangnhapAdmin(){
        return view('admin.login');
    }

    public function postdangnhapAdmin(Request $request) {
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
            return redirect('admin/theloai/list');
        }
        else
            return redirect('admin/dangnhap')->with('thongbao','Dang nhap that bai');
    }

    public function getdangxuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
