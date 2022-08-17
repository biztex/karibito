<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProductYoutubeLink extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getIframeURLAttribute()
    {
        $youtube_link = $this->youtube_link;
        if (strpos($youtube_link, "watch") != false) {
            $video_id = substr($youtube_link, (strpos($youtube_link, "=")+1));
        } else {
            $video_id = substr($youtube_link, (strpos($youtube_link, "youtu.be/")+9));;
        }
        $iframe_url = 'https://www.youtube.com/embed/' . $video_id;
        return $iframe_url;
    }
}
