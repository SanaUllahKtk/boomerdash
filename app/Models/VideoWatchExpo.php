<?php

namespace App\Models;

use App\Models\VideoWatch;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VideoWatchExpo implements FromCollection, WithMapping, WithHeadings
{   
        /**
        * @return \Illuminate\Support\Collection
        */
       
    
        protected $from_date;
        protected $id;
        protected $to_date;
    
        function __construct($from_date,$to_date,$id) {
                $this->from_date = $from_date;
                $this->to_date = $to_date;
                $this->id = $id;
        }
    public function collection()
    {
        if(!empty( $this->to_date) AND !empty($this->from_date)){
        return VideoWatch::where('video_id',$this->id)->whereBetween('created_at', [$this->from_date.' 00:00:00',$this->to_date.' 23:59:59'])->get();
        }
        else{
        return VideoWatch::where('video_id',$this->id)->get();
        }
    }

    public function headings(): array
    {
        return [
            'Video Name',
            'User Name',
            'Country',
            'State',
            'City',
            'Postal Code',
            'Date',
        ];
    }

    /**
    * @var VideoWatch $videoWatch
    */
    public function map($videoWatch): array
    {   
        
        // $name = '';
        // $videoname = '';
        // $country ='';
        // $state = '';
        // $city = '';
        // $postal_code = '';
        $date=date("d M Y", strtotime($videoWatch->created_at));
            $user=User::where('id',$videoWatch->user_id)->first();
            $video=Video::where('id',$videoWatch->video_id)->first();
            $name = $user->name;
            $postal_code = $user->postal_code;
            
            $states=State::where('id',$user->state)->first();
            $countrys=Country::where('id',$user->country)->first();
            $citys=City::where('id',$user->city)->first();
            
            $videoname= $video->name;
            
            if(!empty($states->name)){
               $state= $states->name;
            }else{
               $state= '';
            }
            if(!empty($countrys->name)){
               $country= $countrys->name;
            }else{
               $country= '';
            }
            if(!empty($citys->name)){
               $city= $citys->name;
            }else{
               $city= '';
            }
    
        return [
        $videoname,
        $name,
        $city,
        $state,
        $country,
        $postal_code,
        $date
        ];
    }
}
