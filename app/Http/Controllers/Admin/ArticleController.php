<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Description;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;
use App\NGallery;
use App\Section;

class ArticleController extends Controller
{
    public function __Construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('isadmin');
    }

    public function getHome($status)
    {

        switch ($status) {

            case '1':
                $products = Article::where('status', '1')->where('module', 'articulos')->orderBy('id', 'DESC')->paginate(20);
                break;
            case '0':
                $products = Article::where('status', '0')->where('module', 'articulos')->orderBy('id', 'DESC')->paginate(20);
                break;
            case 'trash':
                $products = Article::onlyTrashed()->where('module', 'articulos')->orderBy('id', 'DESC')->paginate(20);
                break;

            default:
                # code...
                break;
        }
        $data = ['articulos' => $products];
        return view('admin.article.home', $data);

    }


    public function getArticleAdd()
    {
        $cats = Article::where('module', 'articulos')->pluck('name', 'id');
        $data = [
            'cats' => $cats
        ];
        return view('admin.article.add', $data);

    }


    public function postArticleAdd(Request $request)
    {
        $input = $request->all();
        $input['slug']= Str::slug($request->input('name'));
        $product    = Article::where('slug', $input['slug'])->first();
        if ($product == null) {
            $rules = [
                'name'                              => 'required',
                'file'                              => 'required',
                'date'                              => 'required',
                'slug'                              => 'slug|unique:articles,slug',
            ];

            $messages = [
                'name.required'                     => 'El nombre de la noticia es requerido.',
                'file.required'                     => 'Seleccione una imagen destacada de noticia.',
                'date.required'                     => 'La fecha del artículo es requerida.',
                'slug.unique'                        => 'El artículo ya se encuentra registrado',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()):

                return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();

            else:

                $s = Str::slug($request->input('name'));
                $path_ = '/Article';
                $path = '/Article/'.$s;
                $fileExt = trim($request->file('file')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('file')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;

                $file_url = 'multimedia'.$path.'/t_'.$filename;


                $file_absolute = $upload_path.'/'.$path.'/'.$filename;

                $product = new Article;
                $product->status                = '0';
                $product->module                = 'articulos';
                $product ->name                 = e($request->input('name'));
                $product ->slug                 = Str::slug($request->input('name'));
                $product ->file_path            = $path_;
                $product ->file                 = $filename;
                $product ->mobile               = asset($file_url);
                $product ->date                 = e($request->input('date'));
                $product ->sections               = e($request->input('sections'));

                if($product->save()):

                    $p = Article::where('slug', $s)->first();
                    $s = e($request->input('sections'));

                    for ($i=0; $i <= $s; $i++) {
                        $content = new Description();
                        $content->article_id            = $p->id;
                        $content->type                  = 'description';
                        $content ->section              = $i;
                        $content->save();

                        $content = new Description();
                        $content->article_id            = $p->id;
                        $content->type                  = 'video';
                        $content ->section              = $i;
                        $content->save();
                    }

                    if($request->hasFile('file')):
                        $fl = $request->file->storeAs($path,$filename, 'uploads');
                        $imagT = Image::make($file_absolute);
                        $imagT->resize(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $imagW = Image::make($file_absolute);
                        $imagW->resize(1920, 1080, function($constraint){
                            $constraint->upsize();
                        });
                        $imagT->save($upload_path.'/'.$path.'/t_'.$filename);
                        $imagW->save($upload_path.'/'.$path.'/'.$filename);
                    endif;

                    return redirect('/admin/articulos/1')->with('message', ' Artículo guardado con éxito.')->with('typealert', 'success');

                endif;

            endif;
        }else {
            $rules = [
                'name'                              => 'required',
                'file'                              => 'required',
                'date'                              => 'required',
                'slug'                              => 'required|slug|unique:articles,slug',
            ];
             $messages = [
                'slug.required'                     => 'El artículo ya se encuentra registrado',
                'slug.unique'                        => 'El artículo ya se encuentra registrado',
            ];
            $validator ='El artículo ya se encuentra registrado';
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();

        }

    }


    public function getArticleEdit($id)
    {
        $product        = Article::findOrFail($id);
        $galerias        =NGallery::where('article_id', $product->id)->get();
        $descriptions       = Description::where('article_id', $product->id)->where('type', 'description')->get();
        $videos       = Description::where('article_id', $product->id)->where('type', 'video')->get();
        $data  = [
            'product' => $product,
            'galerias' => $galerias,
            'descriptions' => $descriptions,
            'videos' => $videos
        ];

        return view('admin.article.edit', $data);
    }


    public function postArticleEdit(Request $request, $id)
    {
        $rules = [
    		'name'                              => 'required'
        ];

        $messages = [
            'name.required'                     => 'El nombre del producto es requerido.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();

        else:

            $product                        = Article::findOrFail( $id);
            $imagepp                        = $product->file_path;
            $imagep                         = $product->file;
            $product->status                = e($request->input('status'));
            $product->module                = 'articulos';
            $product ->name                 = e($request->input('name'));
            $product ->slug                 = Str::slug($request->input('name'));

            $product ->date                 = e($request->input('date'));

            $contacto =  request([

                'description'

            ]);

            foreach($contacto as $clave=> $valor){
                for($i=0;$i<count($contacto[$clave]);$i++){
                    $descriptions = Description::where('article_id', $product->id)->where('type', 'description')->where('section', $i)->first();
                    //dd($descriptions);
                    if ($descriptions == null) {
                        $content = new Description();
                        $content->article_id                = $product->id;
                        $content->type                  = 'description';
                        $content ->section                 = $i;
                        $content ->content                 =$contacto[$clave][$i];
                        $content->save();
                    }else {
                        $descriptions ->content                 =$contacto[$clave][$i];
                        $descriptions->save();
                    }
                }
            }



            $contacto =  request([

                'video'

            ]);

            foreach($contacto as $clave=> $valor){
                for($i=0;$i<count($contacto[$clave]);$i++){
                    $descriptions = Description::where('article_id', $product->id)->where('type', 'video')->where('section', $i)->first();
                    //dd($descriptions);
                    if ($descriptions == null) {
                        $content = new Description();
                        $content->article_id                = $product->id;
                        $content->type                  = 'video';
                        $content ->section                 = $i;
                        $content ->content                 =$contacto[$clave][$i];
                        $content->save();
                    }else {
                        $descriptions ->content                 =$contacto[$clave][$i];
                        $descriptions->save();
                    }
                }
            }


            if($request->hasFile('file')):

                $s = Str::slug($request->input('name'));
                $path_ = '/Article';
                $path = '/Article/'.$s;
                $fileExt = trim($request->file('file')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('file')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_absolute = $upload_path.'/'.$path.'/'.$filename;
                $file_url = 'multimedia'.$path.'/t_'.$filename;
                $product ->mobile               = asset($file_url);
                $product ->file_path            = $path_;
                $product ->file                 = $filename;

            endif;

            if($product->save()):

                if($request->hasFile('file')):
                    $fl = $request->file->storeAs($path, $filename, 'uploads');
                    $imag = Image::make($file_absolute, function($constraint){
                        $constraint->upsize();
                    });
                    $imag->resize(320, 200, function($constraint){
                        $constraint->upsize();
                    });
                    $imag->save($upload_path.'/'.$path.'/t_'.$filename);
                    Storage::disk('uploads')->delete('/'.$imagepp.'/'.$imagep);
                    Storage::disk('uploads')->delete('/'.$imagepp.'/t_'.$imagep);
                endif;

                return back()->with('message', ' Artículo actualizado con éxito.')->with('typealert', 'success');

            endif;


        endif;

    }


    public function getArticleDelete($id)
    {
        $product = Article::find( $id);

        if($product->delete()):

            return back()->with('message', ' Artículo enviado con éxito a la papeplera.')->with('typealert', 'success');

        endif;
    }


    public function getArticleRestore($id)
    {
        $product = Article::onlyTrashed()->where('id', $id)->first();
        $product ->deleted_at   = null;

        if ($product->save()):

            return redirect('/admin/articulos/'.$product->id.'/edit')->with('message', ' El artículo se restauro correctamente.')->with('typealert', 'success')->withInput();

        endif;

    }

    public function postArticleGalleryAdd($id, $gallery, Request $request)
    {

        $rules = [
    		'file'                        => 'required',
        ];

        $messages = [
            'file.required'               => 'Seleccione una imagen.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();

        else:
            //dd($gallery);
            $p = Article::find( $id);

            for ($i=0; $i <= $p->sections ; $i++) {

                if($request->hasFile('file')):
                    $article =  DB::table('articles')->orderBy('id', 'DESC')->where('id', $id)->first();
                    $path = '/Article/'.$article->slug;
                    $fileExt = trim($request->file('file')->getClientOriginalExtension());
                    $upload_path = Config::get('filesystems.disks.uploads.root');

                    $name = Str::slug(str_replace($fileExt, '', $request->file('file')->getClientOriginalName()));

                    $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                    $file_absolute = $upload_path.'/'.$path.'/'.$filename;


                    $g =new NGallery;
                    $g->article_id = $id;
                    $g->after = $gallery;
                    $g->file_path = $path;
                    $g->file_name = $filename;


                    if($g->save()):

                        if($request->hasFile('file')):
                            $fl = $request->file->storeAs($path, $filename, 'uploads');
                            $imagT = Image::make($file_absolute);
                            $imagT->resize(256, 256, function($constraint){
                                $constraint->upsize();
                            });
                            $imagW = Image::make($file_absolute);
                            $imagW->resize(1920, 1080, function($constraint){
                                $constraint->upsize();
                            });
                            $imagT->save($upload_path.'/'.$path.'/t_'.$filename);
                            $imagW->save($upload_path.'/'.$path.'/'.$filename);
                        endif;

                        return back()->with('message', ' Archivo multimedia guardado con éxito.')->with('typealert', 'success')->withInput();

                    endif;
                endif;
            }

        endif;

    }

    public function getArticleGalleryDelete($id, $gid)
    {
        $g = NGallery::findOrFail( $gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');

        if($g->article_id != $id):

            return back()->with('message', 'La imagen no se puede eliminar.')->with('typealert', 'danger')->withInput();

        else:

            if($g->delete()):

                Storage::disk('uploads')->delete('/'.$path.'/'.$file);
                Storage::disk('uploads')->delete('/'.$path.'/t_'.$file);
                return back()->with('message', 'Imagen borrada con éxito.')->with('typealert', 'success')->withInput();

            endif;

        endif;
    }

    public function postArticleSearch (Request $request)
    {

        $rules = [
    		'search'                              => 'required'
        ];

        $messages = [
            'search.required'                     => 'Se requiere infomacion para buscar.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();

        else:

            $products = Article::where('name', 'LIKE', '%'.$request->input('search').'%')->where('status', $request->input('status'))->orderBy('id', 'DESC')->get();


            $data = ['article' => $products];
            return view('admin.article.search', $data);

        endif;
    }

}
