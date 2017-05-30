<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Models\Ticket;
use App\Http\Models\Cevaplar;
use App\Http\Models\Kategori;
use Auth;

class PageController extends Controller
{	
	public function getIndex()
    {   
        $user =  Auth::user();
        $kullanicituru = $user->role;

        if ($kullanicituru=='user') {

           return redirect()->route('userhome');

        }elseif ($kullanicituru=='admin') {
            
            return redirect()->route('adminhome');
        } 
    }

    public function getAdminhome(){
        
    	$ticketlar_all = Ticket::all();
    	return view('adminhome',array('ticket_liste'=>$ticketlar_all));
    }
    public function getTicketcevapla($id){
        
        return view('ticketcevapla',array('id'=>$id));
    }

    public function getDeneme(){
        $ticketlar_all = Ticket::all();
        return view('deneme',array('ticket_liste'=>$ticketlar_all));
    }


    public function getAdminkategori(){
    	$kategori_tabl = Kategori::all();
    	return view('adminkategori',array('kategori_tabl'=>$kategori_tabl));
    }

    public function getUserhome(){
    	
		$kategori_tabl = Kategori::all();
		$kategori_list = array();
    	foreach ($kategori_tabl as $kategori) {
    		$kategori_list[]=$kategori->kategoriler;
    	}

    	$user_id =  Auth::user()->id;
        $ticketlar = Ticket::whereRaw('kullanici_id=?',array($user_id))->get();
    	return view('userhome',array('ticket_liste'=>$ticketlar,'kategori_list'=>$kategori_list));
    }
    public function getYetkiver()
    {   
    	$user_all = User::all();
        return view('yetkiver',array('user_all'=>$user_all));
                
    }

}
