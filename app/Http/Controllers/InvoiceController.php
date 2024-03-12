<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\VideoWatch;
use App\Models\Order;
use Session;
use PDF;
use Config;

class InvoiceController extends Controller
{
    //download invoice
    public function invoice_download($id)
    {
        if(Session::has('currency_code')){
            $currency_code = Session::get('currency_code');
        }
        else{
            $currency_code = Currency::findOrFail(get_setting('system_default_currency'))->code;
        }
        $language_code = Session::get('locale', Config::get('app.locale'));

        if(Language::where('code', $language_code)->first()->rtl == 1){
            $direction = 'rtl';
            $text_align = 'right';
            $not_text_align = 'left';
        }else{
            $direction = 'ltr';
            $text_align = 'left';
            $not_text_align = 'right';            
        }

        if($currency_code == 'BDT' || $language_code == 'bd'){
            // bengali font
            $font_family = "'Hind Siliguri','sans-serif'";
        }elseif($currency_code == 'KHR' || $language_code == 'kh'){
            // khmer font
            $font_family = "'Hanuman','sans-serif'";
        }elseif($currency_code == 'AMD'){
            // Armenia font
            $font_family = "'arnamu','sans-serif'";
        // }elseif($currency_code == 'ILS'){
        //     // Israeli font
        //     $font_family = "'Varela Round','sans-serif'";
        }elseif($currency_code == 'AED' || $currency_code == 'EGP' || $language_code == 'sa' || $currency_code == 'IQD' || $language_code == 'ir' || $language_code == 'om' || $currency_code == 'ROM' || $currency_code == 'SDG' || $currency_code == 'ILS'){
            // middle east/arabic/Israeli font
            $font_family = "'Baloo Bhaijaan 2','sans-serif'";
        }elseif($currency_code == 'THB'){
            // thai font
            $font_family = "'Kanit','sans-serif'";
        }else{
            // general for all
            $font_family = "'Roboto','sans-serif'";
        }
        
        // $config = ['instanceConfigurator' => function($mpdf) {
        //     $mpdf->showImageErrors = true;
        // }];
        // mpdf config will be used in 4th params of loadview

        $config = [];

        $order = Order::findOrFail($id);
        return PDF::loadView('backend.invoices.invoice',[
            'order' => $order,
            'font_family' => $font_family,
            'direction' => $direction,
            'text_align' => $text_align,
            'not_text_align' => $not_text_align
        ], [], $config)->download('order-'.$order->code.'.pdf');
    }
    public function videopdf_download(Request $request)
    {
        
        
        if(!empty( $request->start_date) AND !empty($request->end_date)){
        $videos= VideoWatch::where('video_id',$request->video_id)->whereBetween('created_at', [$request->start_date.' 00:00:00',$request->end_date.' 23:59:59'])->get();
        }
        else{
        $videos= VideoWatch::where('video_id','=',$request->video_id)->get(); 
        }
        
        // return $videos;
        $config = [];
            $direction = 'ltr';
            $text_align = 'left';
            $font_family = "'Roboto','sans-serif'";
            $not_text_align = 'right'; 
        $pdf=PDF::loadView('backend.invoices.videoinvoice',[
            'videos' => $videos,
            'font_family' => $font_family,
            'direction' => $direction,
            'text_align' => $text_align,
            'not_text_align' => $not_text_align
        ], [], $config);
        
        $fileName =  time().'watchhistory'. '.pdf' ;
        $pdf->save(public_path() . '/' . $fileName);
        $pdf = public_path($fileName);
        return response()->download($pdf);
    }
}
