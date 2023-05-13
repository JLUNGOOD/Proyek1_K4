<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class FileService
{
    public function generateUniqueFileName(UploadedFile $file, $judul = null): string
    {
        $fileName = $judul !== null ? Str::slug($judul) : 'unknown';
        $extension = $file->getClientOriginalExtension();
        return $fileName . '_' . uniqid() . '.' . $extension;
    }
}
