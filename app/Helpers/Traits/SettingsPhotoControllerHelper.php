<?php

namespace App\Helpers\Traits;

use App\Models\User;

trait SettingsPhotoControllerHelper
{
    /**
     * @param string $image
     * @param object $file_name
     * @return void
     */
    public function saveFileToStorage($image, $file_name): void
    {
        $path_slug = date('Y') . '/' . date('n');
        $path = storage_path("app/public/users/$path_slug");

        if (!\File::exists($path)) {
            \File::makeDirectory($path, 0777, true);
        }

        $img = \Image::make($image);
        $img->resize(300, null, function ($constrait) {
            $constrait->aspectRatio();
        });
        $img->save("$path/$file_name");
    }

    /**
     * @param string $file_name
     * @return void
     */
    public function saveFileNameToDB($file_name = ''): void
    {
        $path_slug = date('Y') . '/' . date('n');
        $user = User::find(user()->id);

        if (empty($file_name)) {
            $user->image = 'default.jpg';
        } else {
            $user->image = "$path_slug/$file_name";
        }
        $user->save();
    }

    /**
     * @param string $file
     * @param string $foder
     * @return void
     */
    public function deleteOldFileFromStorage(string $file, string $folder): void
    {
        if ($file !== 'default.jpg') {
            \Storage::delete("public/$folder/$file");
        }
    }
}