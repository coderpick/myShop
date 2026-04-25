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
            $absoluteLocation = public_path($location);
            if (! file_exists($absoluteLocation)) {
                mkdir($absoluteLocation, 0777, true);
            }

            if ($isImage) {
                // Image processing with Intervention Image v4
                $manager = new ImageManager(new Driver());
                $image = $manager->decode($file);
                
                // Process image
                $image->cover($width, $height)->sharpen(10);

                $file_full_name = $file_name.'.webp';
                $file_path = $location.'/'.$file_full_name;
                $absolute_path = public_path($file_path);

                // Delete old file if it exists
                if ($updateFile && file_exists(public_path($updateFile))) {
                    unlink(public_path($updateFile));
                }

                // Save the processed image (v4 save() detects format from extension)
                $image->save($absolute_path);

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
                $file->move(public_path($location), $file_full_name);

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
