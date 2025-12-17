@extends('layouts.app')

@section('content')
    <h2>Danh sách sinh viên</h2>

    {{-- Form thêm sinh viên --}}
    <form action="{{ route('sinhvien.store') }}" method="POST">
        @csrf
        Tên sinh viên: <input type="text" name="ten_sinh_vien" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Thêm</button>
    </form>


    <hr>

    {{-- Bảng danh sách sinh viên --}}
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sinh viên</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($danhSachSV as $sv)
                <tr>
                    <td>{{ $sv->id }}</td>
                    <td>{{ $sv->ten_sinh_vien }}</td>
                    <td>{{ $sv->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
