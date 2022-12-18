<?php
namespace App\Traits;

use App\Models\Product;
use App\Models\Proposal;
use App\Models\JobRequest;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Model;


/**
 * モデルのインスタンスからreference_typeを返すメソッド
 * 
 * @param \App\Models
 * 
 * @return string
 */
trait GetReferenceTypeTrait
{
    public function getReferenceType(Model $instance)
    {
        if($instance instanceof Proposal){
            $reference_type = 'App\Models\Proposal';
        } elseif ($instance instanceof UserProfile){
            $reference_type = 'App\Models\UserProfile';
        } elseif($instance instanceof Product){
            $reference_type = 'App\Models\Product';
        } elseif ($instance instanceof JobRequest){
            $reference_type = 'App\Models\JobRequest';
        }
        
        return $reference_type;
    }
}