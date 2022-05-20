<?php

namespace App\Models;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad_Image extends Model
{
    use HasFactory;
    protected $casts = [
        'labels' => 'array',
    ];

    public function ad(){
        return $this->belongsTo(Ad::class);
    }

    static public function getUrlByFilePath($filePath, $w = null, $h = null){
        
        if(!$w && !$h){
            return Storage::url($filePath);
        }
        
        $path = dirname($filePath);
        $filename = basename($filePath);

        $file = "{$path}/crop{$w}x{$h}_{$filename}";

        return Storage::url($file);
    }

    public function getUrl($w = null, $h = null){
        
        return Ad_Image::getUrlByFilePath($this->file, $w, $h);
    }
}