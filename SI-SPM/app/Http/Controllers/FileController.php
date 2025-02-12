<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',  // Bisa disesuaikan dengan tipe file yang diinginkan
        ]);

        // Menyimpan file ke dalam storage
        $path = $request->file('file')->store('documents');  // folder 'documents' di storage

        // Menyimpan path ke database (opsional)
        // File::create(['path' => $path]);

        return back()->with('success', 'Dokumen berhasil diupload!');
    }
}
