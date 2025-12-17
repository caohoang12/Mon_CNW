<?php // Xóa dòng này đi, file Blade không bắt đầu bằng <?php ?>
@extends('layouts.app')
@section('content')

 <h2>{{ $page_title }}</h2>
 <p>{{ $page_description }}</p>
 <h3>Danh sách công việc (Lấy từ Controller):</h3>

 <ul>
 @foreach($tasks as $task)
 <li>{{ $task }}</li>
 @endforeach
 </ul> 
@endsection 