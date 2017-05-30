@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Ticket Cevap Gönder </div>
                <div class="panel-body">
                <form class="form-horizontal" action="{{url('/ticketcevapekle/')}}" method="post">
                    {{csrf_field()}}

                    <input type="hidden" name="hiddenvar" value="{{ $id }}">
                    <div class="form-group">
                    <label class="col-md-2" for="aciklamatx">Cevap yazınız:</label>
                        <textarea rows="6" cols="80" name="ticvptext"></textarea>
                     
                        <input type="submit" name="cvpgnd" class="btn btn-primary" value="Gönder"><br><br>
                    </div>
                </form> 
                                    
                    
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection