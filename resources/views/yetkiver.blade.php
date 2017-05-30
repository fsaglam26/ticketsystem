@extends('layouts.app')

@section('content')
<div class ='container'>
    <div class="panel panel-default col-md-10">
        <div class="panel-heading"><b>KAYITLI KULLANICILAR</b></div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th>Kullanıcı Adı</th>
                    <th>Email</th>
                    <th>Yetki</th>
                    <th>İşlemler</th>
                </tr>
                @foreach($user_all as $userss)                          
                <tr>
                    <td>{{ $userss->name}}</td>
                    <td>{{ $userss->email}}</td>
                    <td>{{ $userss->role}}</td>  
                    <td><a href="{{url('/yetkiliyap/'.$userss->id)}}">yetkili yap</a>-/-<a href="{{url('/yetkial/'.$userss->id)}}">yetki al</a></td>                           
                </tr>
                @endforeach 
            </table>
        </div>
    </div>
</div>

@endsection