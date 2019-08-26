<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ImagesController extends Controller
{
    public function index()
    {
        $disk = Storage::disk('s3');
        $files = $disk->files('/');
        return view('images.index', ['files' => $files]);
    }
    public function create()
    {
        return view('images.create');
    }
    public function store(Request $request)
    {
        $params = $request->validate([
            'image' => 'required|file|image|max:4000',
        ]);
        $file = $params['image'];
        $fileContents = file_get_contents($file->getRealPath());
        $disk = Storage::disk('s3');
        $disk->put($file->hashName(), $fileContents, 'public');
        return redirect()->action('ImagesController@index');
    }
    public function show($filename)
    {
        $disk = Storage::disk('s3');
        try {
            $contents = $disk->get($filename);
            $mimeType = $disk->mimeType($filename);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 404);
        }
        return response($contents)->header('Content-Type', $mimeType);
    }
    public function destroy($filename)
    {
        $disk = Storage::disk('s3');
        $disk->delete($filename);
        return redirect()->action('ImagesController@index');
    }
}