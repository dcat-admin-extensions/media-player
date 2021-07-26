<?php

namespace Abovesky\DcatAdmin\MediaPlayer;

use Illuminate\Support\Facades\Storage;

class MediaPlayer
{
    public static function getValidUrl($path, $server = '')
    {
        if (empty($path)) {
            $url = '';
        } elseif (url()->isValidUrl($path)) {
            $url = $path;
        } elseif ($server) {
            $url = rtrim($server, '/') . '/' . ltrim($path, '/');
        } else {
            $disk = config('admin.upload.disk');

            if (config("filesystems.disks.{$disk}")) {
                $url = Storage::disk($disk)->url($path);
            } else {
                $url = '';
            }
        }

        return $url;
    }
}
