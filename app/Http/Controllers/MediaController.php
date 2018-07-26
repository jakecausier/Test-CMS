<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use App\Content;
use App\Folder;

class MediaController extends Controller
{
    public function uploadFile(Request $request)
    {

        $this->validate($request, [
            'file' => 'required|mimetypes:image/jpeg,image/png,image/gif'
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $path = hash('sha256', time());
        $disk = 'uploads';

        if (Storage::disk($disk)->put($path.'/'.$filename, File::get($file))) {
            $input['name'] = $filename;
            $input['content'] = $path;
            $input['type'] = 'media';
            $input['meta'] = [];
            $input['meta']['disk'] = $disk;
            $input['meta']['mime'] = $file->getClientMimeType();
            $input['meta']['size'] = $file->getClientSize();

            $file = Folder::first()->content()->create($input);

            return response()->json([
                'success' => true,
                'id' => $file->id
            ], 200);
        }

        return response()->json([
            'success' => false
        ], 500);
    }

    public function index()
    {
        $folders = Folder::with('content')->get();
        return view('media.index', compact('folders'));
    }

    public function create()
    {
        return view('media.create');
    }
}
