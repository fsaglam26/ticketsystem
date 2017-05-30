@extends('layouts.app')

@section('content')
<div class ='container'>
        <div class='panel panel-default'>
            <div class = 'panel-heading'><b>Yeni Ticket Gönder</b></div>
            <br/>
            <div class=" = 'panel-body">
                
                <form class="form-horizontal" action="{{url('/kaydet')}}" method="post">
                    {{csrf_field()}}

                    <div class="panel panel-default col-md-8 col-md-offset-2">
                        <div class = 'panel-heading'><b>Önem Derecesi</b></div>
                        <div class="panel-body">
                            <label class="radio"><input type="radio" name="onemtx" value="Düşük">Düşük</label>
                            <label class="radio"><input type="radio" name="onemtx" value="Orta">Orta</label>
                            <label class="radio"><input type="radio" name="onemtx" value="Yüksek">Yüksek</label>
                            <label class="radio"><input type="radio" name="onemtx" value="Çok Yüksek">Çok Yüksek</label>
                        </div>
                    </div>

                    <div class="panel panel-default col-md-8 col-md-offset-2">
                        <div class = 'panel-heading'><b>Kategori Seçiniz</b></div>
                        <div class="panel-body">                                            
                            @foreach($kategori_list as $key => $value)
                                <div class="col-md-5 ">
                                <input type="checkbox" name="kategoritx[]" value="{{ $value }}" > {{ $value }}<br>
                                </div>
                            @endforeach  
                        </div>
                   </div><br>

                   <input type="hidden" name="kullaniciidtx" value={{ Auth::user()->id}}>
                   
                    <div class="form-group">
                        <label class="col-md-4 col-md-offset-1">Başlık</label>
                        <div class="col-md-4">
                            <input type="text" name="basliktx" class="form-control">
                        </div>
                    </div>
                                       
                    <div class="form-group">
                    <label class="col-md-4 col-md-offset-1" for="aciklamatx">Açıklama:</label>
                        <textarea rows="6" cols="80" name="aciklamatx"></textarea>
                    </div>                  

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-5">
                            <input type="submit" name="kaydet" class="btn btn-primary" value="Gönder">
                        </div>
                    </div>

                    <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Gönderilmiş Ticketlar </div>

                <div class="panel-body">
                    
                    <table class="table table-bordered">
                        <tr>
                        	<th>Gönderilme Tarihi</th>
                            <th>Kategori</th>
                            <th>Başlık</th>
                            <th>Açıklama</th>
                            <th>Gelen Cevap</th>
                            <th>Durumu</th>
                            <th>Cevabı Onayla/Reddet</th>
                        </tr>
                        @foreach($ticket_liste as $ticket)                          
                        <tr>
                        	<td>{{$ticket->created_at}}</td>
                            <td>{{$ticket->kategori}}</td>
                            <td>{{$ticket->baslik}}</td>
                            <td>{{$ticket->aciklama}}</td>
                            <td>{{$ticket->cevaplar}}</td>
                            <td>{{$ticket->okundu}}</td>
                            <td><a href="{{url('/cvponayla/'.$ticket->id)}}">Onayla</a>-<a href="{{url('/cvpreddet/'.$ticket->id)}}">Reddet</a></td>
                            
                        </tr>
                        @endforeach 
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

                </form>
                
            </div>
        </div>
    </div>
@endsection
