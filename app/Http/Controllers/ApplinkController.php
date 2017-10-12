<?php

namespace App\Http\Controllers;

use App\Applink;

class ApplinkController extends Controller
{
    public function getAllAppLinks()
    {
        $app_link  = Applink::orderBy('id','desc')->get();
        return response(['data' => $app_link],200);
    }

    public function addAppLink()
    {
        $exploded = explode(',', request('image'));
        $decoded = base64_decode($exploded[1]);
        if (str_contains($exploded[0], 'jpeg'))
        {
            $extension = 'jpg';
        } else
            $extension = 'png';
        $file_name = time() . '.' . $extension;

        $path = public_path('/uploads/app-link-images/' . $file_name);
        file_put_contents($path, $decoded);

        Applink::create([
            'image' =>  $file_name,
            'title' => request('title'),
            'description' => request('description'),
            'uri' => request('uri')
        ]);
        return response(['message' => 'App link uploaded successfully'],200);
    }

    public function updateAppLink($id)
    {
        $app_link = Applink::find($id);
        $app_link->image = request('image');
        $app_link->title = request('title');
        $app_link->description = request('description');
        $app_link->save();
        return response(['message' => 'App link updated'],200);
    }

    public function destroyAppLink($id)
    {
        $app_link = Applink::find($id);
        $app_link->delete();
        return response(['message' => 'App link deleted!'],200);
    }
}
