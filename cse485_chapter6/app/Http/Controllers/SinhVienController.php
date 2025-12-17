<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien; 

class SinhVienController extends Controller
{
    //
    public function index(){
        // TODO 11: Dùng Eloquent ::all() để lấy toàn bộ sinh viên
        $danhSachSV = SinhVien::all(); 

        //12: Trả về 1 view 'sinhvien.list' và truyền $danhSachSV
         return view('sinhvien.list', compact('danhSachSV')); 
    }

    public function store(Request $request){
        // TODO 13: Lấy toàn bộ dữ liệu từ form
         $data = $request->all(); 


    //TODO 14: Dùng Eloquent ::create() để lưu vào CSDL
    // (Lưu ý: tên input trong form phải khớp với $fillable và tên cột)
        SinhVien::create($data); 

        // TODO 15: Chuyển hướng về trang danh sách
        return redirect()->route('sinhvien.index'); 
    }
}
