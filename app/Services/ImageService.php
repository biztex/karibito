<?php


namespace App\Services;

use Illuminate\Support\Str;

/**
 * Intervention Imageの導入方法
 * > composer require intervention/image
 *
 * Class ImageService
 * @package App\Services
 */
class ImageService
{
    /**
     * 画像をリサイズして保存する
     * @param $image_file
     * @param $resize_width
     * @param $folder_path
     * @return mixed
     */
    public function resizeImage($image_file, $resize_width, $folder_path)
    {
        // 画像を読み込む
        $image = \Image::make($image_file);

        // EXIFのOrientationによって回転させる
        $image->orientate();

        // リサイズする
        $resized_image = $image->resize($resize_width, null,
            function ($constraint) {
                // 縦横比を保持したままにする
                $constraint->aspectRatio();
                // 小さい画像は大きくしない
                $constraint->upsize();
            }
        );

        // ファイルの拡張子取得
        $ext = $this->getImageExtension($resized_image);
        // 保存するファイルパス
        $file_path = $this->getFilePath($folder_path, $ext);
        // storageまでのパスを取得
        $storage_file_path = storage_path('app/public/');

        \Storage::makeDirectory('public/' . $folder_path . 's');
        \Storage::makeDirectory('public/original/'. $folder_path . 's');

        // 圧縮後のものをStorageに保存
        $resized_image->save($storage_file_path . $file_path);
        // 圧縮前のものをStorageに保存
        \Image::make($image_file)->save($storage_file_path . 'original/'. $file_path);

        return $file_path;
    }



    /**
     * ファイルの拡張子取得
     * @param $resize_image
     * @return string $ext;
     */
    private function getImageExtension($resized_image): string
    {
        $ext = '';
        if ($resized_image->mime() === 'image/png') {
            $ext = '.png';
        } elseif($resized_image->mime() === 'image/jpeg') {
            $ext = '.jpg';
        }
        return $ext;
    }

    /**
     * 保存するファイルパス
     * @param $path :ファイルパス
     * @param $ext :拡張子
     * @return string
     */
    private function getFilePath($path, $ext)
    {
        return $path . 's/' . Str::random(50) . $ext;
    }
}
