<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait FileUploadTrait
{
    public function fileUpload($file, $location, $oldFile = null)
    {

        if ($file) {

            $currentDate = Carbon::now()->toDateString();

            $pre = $currentDate.'-'.uniqid();

            $file_name = $pre.'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $ext = strtolower($file->getClientOriginalExtension());

            $file_full_name = $file_name.'.'.$ext;

            if (! file_exists($location)) {
                mkdir($location, 0777, true);
            }

            $upload_path = $location.'/';

            $file_url = $upload_path.$file_full_name;

            if (isset($oldFile)) {
                $this->unlink($oldFile);
            }

            $file->move($upload_path, $file_full_name);

            return $file_url;
        }
    }

    public function unlink($oldFile = null)
    {
        if ($oldFile && file_exists(public_path($oldFile))) {
            unlink($oldFile);
        }
    }
}
