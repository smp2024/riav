<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\EFDmail;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getHome()
    {
        /** Primera sección **/
        $carrousels = DB::table('carousels')->orderBy('id', 'DESC')->where('status', 1)->where('type', 0)->get();
        /** Segunda sección **/
        $video =  DB::table('sections')->where('slug', 'video')->first();

        /** Tercera sección **/

        /** Cuarta sección **/

        /** quinta sección **/
            $galleryInfo =  DB::table('sections')->where('slug', 'galeria')->first();
            $galleries = DB::table('carousels')->orderBy('id', 'DESC')->where('status', 1)->where('type', 1)->get();

        $data = [
                    'carrousels' => $carrousels,
                    'galleries' => $galleries,
                    'galleryInfo' => $galleryInfo,
                    'video' => $video,
                ];

        return view('blog.principal', $data);
    }

    public function getAboutUs($politica)
    {
        $politicas = DB::table('corporate_areas')->orderBy('id', 'DESC')->where('slug', $politica)->get();

        $data = [
                    'politicas' => $politicas

                ];

        return view('blog.sections.politica', $data);
    }

    public function getCategories($category)
    {


        $data = [
                    'section' => $category

                ];

        return view('blog.sections.articles', $data);
    }

    public function pdf_contacto(Request $request)
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'description' => 'required',
        ];

        $messages = [
            'name.required' => 'Se requiere un nombre para enviar correo.',
            'lastname.required' => 'Se requiere un apellido para enviar correo.',
            'email.required' => 'Se requiere un correo electrónico para enviar correo.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        } else {
            // dd($request->all());
            Mail::to('ernesto.mej.cam@gmail.com')->queue(new EFDmail($request->all()));

            return view('emails.send');
        }
    }
}

