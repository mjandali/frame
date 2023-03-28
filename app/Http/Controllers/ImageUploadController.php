<?php
namespace App\Http\Controllers;

use Intervention\Image\Facades\Image As Image;
use App\Models\Upload;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{


    public function show($id) {
        $image = Upload::where('id', $id)->first();

        return view('show')->with('image', $image);
    }

    //Upload the chosen image
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Rename the image
        $imageName = time().'.'.$request->image->extension();

        //Move image to public folder (public/images)
        $request->image->move(public_path('images'), $imageName);

        // Store image name in DATABASE
        Upload::create([
            'url' => $imageName,
            'user_id' => auth()->user()->id
        ]);

        $image = Upload::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->first();

        return redirect()->back()
            ->with('message','Image has been successfully uploaded.')
            ->with('image',$imageName)
            ->with('image', $image);
    }


    //Merge image with frame
    public function convert($id) {
        $data = Upload::where('id', $id)->first();
        $url = $data->url;
        $image = public_path("images/$url");

        $img = Image::make($image);
        $watermark = Image::make('images/Appbakers.png');

        //Getting image size
        $height = Image::make($img)->height();
        $width = Image::make($img)->width();

        //Resize the frame
        $watermark->resize($width, $height)->save(public_path('images/watermark.png'));

        //Merge two images
        $img->insert(public_path('images/watermark.png'), 'top-left', 0, 0);

        //Give a new name to the new image
        $img->save(public_path("images/$url"));
        return view('preview')
        ->with('data', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $url = Upload::where('id', $id)->pluck('url')->first();
        $download = public_path('images/' . $url);
        $date = now();

        //download details
        $headers = ['Content-Type: image.png'];
        $name = "download-$date-$url";

        return response()->download($download, $name, $headers);

    }

    //Delete image from database and media folder
    public function destroy($id)
    {
        $previous = URL::previous();
        $contains = Str::contains($previous, 'show');

        $image = Upload::where('id', $id)->first();
        $file = public_path('images/' . $image->url);

        Upload::where('id', $id)->delete();
        if(File::exists($file)) {
            File::delete($file);
        }

        /*
        ** Check where to redirect after deleting
        ** depending on where the request came from
        */
        if ($contains) {
            return redirect('/bibliotheek');
        } else
        {
            return redirect('/');
        }
    }

}
