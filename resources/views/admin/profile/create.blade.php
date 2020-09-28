{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'ニュースの新規作成')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h1>プロフ作成フォーマット</h1>
                <h2>1.氏名</h2>
                <h2>2.性別</h2>    
                <h2>3.趣味</h2>
                <h2>4.自己紹介欄</h2>
    
            <h6>　　　　　　　　　以下に記載をお願いします！！！</h6>

            <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">

@if (count($errors) > 0)
    <ul>
        @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
        @endforeach
    </ul>
@endif
<div class="form-group row">
    <label class="col-md-2" for="title">氏名</label>
    <div class="col-md-10">
        <input type="text" class="form-control" name="shimei" value="{{ old('shimei') }}">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2" for="title">性別</label>
    <div class="col-md-10">
        <input type="text" class="form-control" name="gender" value="{{ old('gender') }}">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2" for="title">趣味</label>
    <div class="col-md-10">
        <input type="text" class="form-control" name="syumi" value="{{ old('syumi') }}">
    </div>
</div>




<div class="form-group row">
    <label class="col-md-2" for="body">自己紹介欄</label>
    <div class="col-md-10">
        <textarea class="form-control" name="jikosyoukai" rows="20">{{ old('jikosyoukai') }}</textarea>
    </div>
</div>

{{ csrf_field() }}
<input type="submit" class="btn btn-primary" value="更新">
</form>





            </div>
       
        </div>
    </div>
@endsection