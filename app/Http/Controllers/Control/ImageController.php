<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageController extends Controller
{

    public function show(Request $request)
    {
        $path = $request->get('path');
        if (!Storage::disk('public')->exists($path)) {
            throw new NotFoundHttpException();
        }

        return response(Storage::disk('public')->get($path))->header(
            'Content-Type',
            'image/png'
        );
    }

}
