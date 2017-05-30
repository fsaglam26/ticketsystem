@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Sayfası </div>
                <div class="panel-body">
                <form class="form-horizontal" action="{{url('/ara')}}" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label class="col-md-3 ">Arama Kriteri:</label>
                        <select class="custom-select col-md-1" name="aramakriteri">
                          <option value="onem">Önem</option>
                          <option value="kategori">Kategori</option>
                          <option value="baslik">Başlık Metni</option>
                          <option value="tarih">Eklenme Tarihi</option>
                        </select>
                    </div><br>


                    <div class="form-group">
                        <label class="col-md-3">Aranacak Kelime:</label>
                        <input id="ara" type="text" name="ara" value="{{ old('name') }}" required autofocus>
                        <input type="submit" name="arabttn" class="btn btn-primary" value="ara"><br><br>
                    </div>
                </form> 
                                    
                <table class="table table-bordered">
                    <tr>
                        <th>Gönderen</th>
                        <th>Tarih</th>
                        <th>Önem Derecesi</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Açıklama</th>
                        <th>Cevaplar</th>
                        <th>Durumu</th>
                        <th>İşlemler</th>
                    </tr>
                    @foreach($ticket_liste as $ticket)                          
                    <tr>
                        <td>{{ $ticket->kimden->name}}--{{ $ticket->kimden->email}}</td>
                        <td>{{$ticket->created_at}}</td>
                        <td>{{$ticket->onem}}</td>
                        <td>{{$ticket->baslik}}</td>
                        <td>{{$ticket->kategori}}</td>
                        <td>{{$ticket->aciklama}}</td>  
                        <td>{{$ticket->cevaplar}}</td>  
                        <td>{{$ticket->okundu}}</td>                   
                        <td><a href="{{url('/ticketcevapla/'.$ticket->id)}}">Cevapla</td>
                    </tr>
                    @endforeach      
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection