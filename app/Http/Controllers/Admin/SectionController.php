<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    public function postGallerySection(Request $request, $slug)
    {
        $gallery = Section::where('slug', $slug)->first();
        $c = Section::findOrFail($gallery->id);
        $c ->description                       = e($request->input('description'));
        $c->save();
        return redirect('/admin/gallery')->with('message', ' Galería actualizada con éxito.')->with('typealert', 'success');
    }

    //////// Video //////////////////////



    public function getHomeVideo()
    {
        $vid = Section::orderBy('name', 'ASC')->where('slug', 'video')->first();
        $cats = Section::orderBy('name', 'ASC')->where('slug', 'video')->get();

        $video = count($cats);
        //dd( $video);
        $data = [
            'cats_' => $vid,
            'cats' => $cats,
            'video' => $video
        ];
        return view('admin.video.home', $data);

    }

    public function postVideoAdd(Request $request)
    {
        $rules = [

         //   'file'                              => 'required|image|mimes:jpg,png,jpeg|max:1000|dimensions:min_width=1920,min_height=1080,max_width=1920,max_height=1080'

        ];

        $messages = [
            'file.required'                     => 'Seleccione una imagen destacada un carousel.',
            'file.image'                        => 'El archivo no es una imagen.',
            'file.dimensions'                   => 'Se requiere una imagen de dimesiones 1920px x 1080px',
            'file.max'                          => 'La imagen pesa más de 1Mb',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');

        else:


            $c = new Section;
            $c ->name                       = 'video';
            $c ->slug                       = 'video';
            $c ->description                = e($request->input('description'));

            if($c->save()):

                return back()->with('message', ' Video guardado con éxito.')->with('typealert', 'success');

            endif;

        endif;

    }

    public function getVideoEdit($id)
    {

        $cat                = Section::find( $id);
        $data               = ['cat' => $cat];
        return view('admin.video.edit', $data);
    }

    public function postVideoEdit(Request $request, $id)
    {

            $rules = [

                //'file'                              => 'required|image|mimes:jpg,png,jpeg|max:1000|dimensions:min_width=1920,min_height=1080,max_width=1920,max_height=1080'

            ];


            $messages = [
                'file.required'                     => 'Seleccione una imagen destacada un carousel.',
                'file.image'                        => 'El archivo no es una imagen.',
                'file.dimensions'                   => 'Se requiere una imagen de dimesiones 1920px x 1080px',
                'file.max'                          => 'La imagen pesa más de 1Mb',
            ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();

        else:

            $c = Section::findOrFail( $id);
            $c ->description                = e($request->input('description'));

            if($c->save()):

                return redirect('/admin/carousels')->with('message', ' Video guardado con éxito.')->with('typealert', 'success');

            endif;

        endif;

    }

    public function getVideoDelete($id)
    {
        $c = Section::find( $id);

        if($c->delete()):

            return back()->with('message', ' Video elminado con éxito.')->with('typealert', 'success');

        endif;
    }

}
