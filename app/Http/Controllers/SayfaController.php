<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Ticket;
use App\Http\Models\Kategori;
use Validator;
use Auth;
use App\User;
class SayfaController extends Controller
{   
    public function postCevapekle(Request $request){
        
        $kontrol = Validator::make($request->all(),array(
            'ticvptext'=>'required'          
            ));
        if ($kontrol->fails()) {
            return redirect()->to('/')->withErrors($kontrol)->withInput();
        }else{
            $ticvptext=$request->input('ticvptext');
            $cvp_id = $_POST['hiddenvar'];
            
            
            $cvpadd = Ticket::find($cvp_id);
            $cvpadd -> cevaplar = $ticvptext;
            $cvpadd -> okundu = 'onay bekleniyor ya da henüz cevap verilmedi';
            $cvpadd -> save();
            return redirect()->route('adminhome');
        }
        
    }

    public function postAra(Request $request){
        

        $kontrol = Validator::make($request->all(),array(
            'aramakriteri'=>'required',
            'ara'=>'required',
            ));
        if ($kontrol->fails()) {
            return redirect()->to('/')->withErrors($kontrol)->withInput();
        }else{
            
            
            $aramakriteri=$request->input('aramakriteri');
            $ara=$request->input('ara');
            switch ($aramakriteri) {
                
                case 'kategori':
                    $sorgu = Ticket::where('kategori', 'LIKE', '%' . $ara . '%')->get();   
                    return view('adminhome',array('ticket_liste'=>$sorgu));
                break;
                
                case 'baslik':
                    $sorgu = Ticket::where('baslik', 'LIKE', '%' . $ara . '%')->get();   
                    return view('adminhome',array('ticket_liste'=>$sorgu));
                break;

                case 'onem':
                    $sorgu = Ticket::where('onem', 'LIKE', '%' . $ara . '%')->get();   
                    return view('adminhome',array('ticket_liste'=>$sorgu));
                break;

                case 'tarih':
                    $sorgu = Ticket::where('created_at', 'LIKE', '%' . $ara . '%')->get();   
                    return view('adminhome',array('ticket_liste'=>$sorgu));
                break;
            }   
        }


    }
    public function getKategorisil($id=0){
        if ($id!=0) {
            $kategorisil = Kategori::where('id','=',$id)->delete();
            if ($kategorisil) {
                return redirect()->route('kategori');
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
    public function getYetkiliyap($id=0){
        if ($id!=0) {
            
	        $user_yetkili_yap = User::find($id);
	        $user_yetkili_yap->role = 'admin';
	        $user_yetkili_yap->save();
	        $user_all = User::all();
	        return view('yetkiver',array('user_all'=>$user_all));
        }
    }
    public function getYetkial($id=0){
        if ($id!=0) {
            
	        $user_yetkili_yap = User::find($id);
	        $user_yetkili_yap->role = 'user';
	        $user_yetkili_yap->save();
	        $user_all = User::all();
	        return view('yetkiver',array('user_all'=>$user_all));
        }
    }

    public function getCvponayla($id=0){
        if ($id!=0) {
            
            $ticket_cvp_onay = Ticket::find($id);
            $ticket_cvp_onay->okundu = 'onaylandı';
            $ticket_cvp_onay->save();           
            return redirect()->route('userhome');
        }
    }

    public function getCvpreddet($id=0){
        if ($id!=0) {
            
            $ticket_cvp_onay = Ticket::find($id);
            $ticket_cvp_onay->okundu = 'reddedildi';
            $ticket_cvp_onay->save();           
            return redirect()->route('userhome');
        }
    }

    public function postKategoriekle(Request $request){
    	$kontrol = Validator::make($request->all(),array(
    		'yenikategori'=>'required'   		
    		));
    	if ($kontrol->fails()) {
    		return redirect()->to('/')->withErrors($kontrol)->withInput();
    	}else{
    		$yenikategori=$request->input('yenikategori');
    		
    		$kaydet = Kategori::create(array(
    			'kategoriler'=>$yenikategori   			
    			));
    		if ($kaydet) {                
                return redirect()->route('kategori');
    		}
    	}
    	
    }

    public function postKaydet(Request $request){
              
    	$kontrol = Validator::make($request->all(),array(
    		
    		'ticketidtx'=>'numeric',
    		'kategoritx'=>'required',
    		'basliktx'=>'required',
    		'onemtx'=>'required',
    		'aciklamatx'=>'required',

    		));
    	if ($kontrol->fails()) {
    		return redirect()->to('/')->withErrors($kontrol)->withInput();
    	}else{

    		$kullaniciidtx=$_POST['kullaniciidtx'];
    		$kategoritx=$request->input('kategoritx');
    		$basliktx=$request->input('basliktx');
    		$onemtx=$request->input('onemtx');
    		$aciklamatx=$request->input('aciklamatx');

            
            $kategoriler = implode(',', $_POST['kategoritx']);
            

    		$kaydet = Ticket::create(array(
    			'kullanici_id'=>$kullaniciidtx,
    			'kategori'=>$kategoriler,
    			'baslik'=>$basliktx,
    			'onem'=>$onemtx,
    			'aciklama'=>$aciklamatx,
    			'okundu'=>'onay bekleniyor ya da henüz cevap verilmedi', 
                'cevaplar'=>'',               
    			));

    		if ($kaydet) {
                
                $kategori_tabl = Kategori::all();
				$kategori_list = array();

		    	foreach ($kategori_tabl as $kategori) {
		    		$kategori_list[]=$kategori->kategoriler;
		    	}

		    	$user_id =  Auth::user()->id;
		        $ticketlar = Ticket::whereRaw('kullanici_id=?',array($user_id))->get();
		    	return view('userhome',array('ticket_liste'=>$ticketlar,'kategori_list'=>$kategori_list));
    		}
    	}
    }
}
