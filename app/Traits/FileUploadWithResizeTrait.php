<?php

namespace App\Traits;

use Illuminate\Support\Carbon;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
trait FileUploadWithResizeTrait
{
      public static function upload($file, $location, $updateFile = false, $isImage = true, $width = 1200, $height = 630)
    {
        if ($file) {
            // Generate a unique file name
            $currentDate = Carbon::now()->toDateString();
            $pre = $currentDate.'-'.substr(uniqid(), 7, 10);
            $file_name = $pre.'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            // Ensure the location directory exists
            if (! file_exists($location)) {
                mkdir($location, 0777, true);
            }

            if ($isImage) {
                // Image processing with Intervention Image
                $imgDriver = new ImageManager(new Driver);
                $image = $imgDriver->read($file);
                $image->cover($width, $height)->sharpen(10);
                $image->toWebp(100);

                $file_full_name = $file_name.'.webp';
                $file_path = $location.'/'.$file_full_name;

                // Delete old file if it exists
                if ($updateFile && file_exists(public_path($updateFile))) {
                    unlink(public_path($updateFile));
                }

                // Save the processed image
                $image->save($file_path); // Save using Intervention Image

                return $file_path;
            } else {
                // Generic file upload
                $ext = strtolower($file->getClientOriginalExtension());
                $file_full_name = $file_name.'.'.$ext;
                $file_path = $location.'/'.$file_full_name;

                // Delete old file if it exists
                if ($updateFile && file_exists(public_path($updateFile))) {
                    unlink(public_path($updateFile));
                }

                // Store the uploaded file directly
                $file->save($file_path); // Save using Intervention Image

                return $file_path;
            }
        }

        return null;
    }

    public static function delete($file)
    {
        if (file_exists(public_path($file))) {
            unlink(public_path($file));
        }
    }
}
