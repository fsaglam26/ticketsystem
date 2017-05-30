@extends('layouts.app')

@section('content')
<div class ='container'>
	<div class='panel panel-default'>
		<div class = 'panel-heading'><b>Mevcut Kategoriler</b></div>
		<div class=" = 'panel-body">

			

			<table class="table table-bordered">
			<tr>
			<th>Tarih</th>
			<th>Kategori</th>
			<th>İşlemler</th>                       
			</tr>
			@foreach($kategori_tabl as $kategori)                          
			<tr>
			<td>{{$kategori->created_at}}</td>
			<td>{{$kategori->kategoriler}}</td>
			<td><a href="{{url('/kategorisil/'.$kategori->id)}}">Kategoriyi Sil</a></td> 
			</tr>
			@endforeach 
			</table>
		</div>
		<div class="panel-footer">
			<form class="form-horizontal" action="{{url('/kategoriekle')}}" method="post">
					{{csrf_field()}}
			<div class="form-group">
				<label class="col-md-1 ">Yeni Kategori:</label>
				<div class="col-md-3">
					<input type="text" name="yenikategori" class="form-control">					
				</div>
				<div class="col-md-4">
					<input type="submit" name="yeniktg" class="btn btn-primary" value="Ekle">
				</div>
			</div>
			</form>
			<br><br>
		</div>
	</div>
</div>
@endsection
