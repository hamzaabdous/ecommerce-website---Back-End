<?php

namespace App\Libs;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{

    public function uploadOne(&$uploadedFile, $folder = null, $filename = null, $disk = 'public')
    {
        if(!$uploadedFile instanceof UploadedFile){
            return ['relative_path'=> null,'file_name' => null];
        }

        $name = !is_null($filename) ? $filename : Str::random(25) . '.' . $uploadedFile->getClientOriginalExtension();

        $file = $uploadedFile->storeAs($folder, $name, $disk);

        return ['relative_path' => $file, 'file_name' => $name];
    }

    public function deleteOne($folder, $filename = null, $disk = 'public'){
        if(!empty($filename)) {
            if(Storage::disk($disk)->exists($folder.DIRECTORY_SEPARATOR.$filename)) {
                Storage::disk($disk)->delete($folder.DIRECTORY_SEPARATOR.$filename);
            }
        } else {
            Storage::disk($disk)->deleteDirectory($folder);
        }

    }
}
