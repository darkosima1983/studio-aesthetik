<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 

trait ImageUploadTrait
{
   public function uploadImageWebp($file, $folder)
    {
        $filename = Str::random(20) . '.webp';
        $path = $folder . '/' . $filename;

        // Direktno pravimo manager bez Facade-a
        $manager = new ImageManager(new Driver());
        $img = $manager->read($file);
        
        $img->scale(width: 800); 

        Storage::disk('public')->put($path, (string) $img->toWebp(80));

        return $path;
    }

    public function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}