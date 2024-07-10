<?php

namespace App\Http\Controllers\Admin;

use App\Article;
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

class CampaignController extends Controller
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
                $products = Article::where('status', '1')->where('module', 'campaña')->orderBy('id', 'DESC')->paginate(20);
                break;
            case '0':
                $products = Article::where('status', '0')->where('module', 'campaña')->orderBy('id', 'DESC')->paginate(20);
                break;
            case 'trash':
                $products = Article::onlyTrashed()->where('module', 'campaña')->orderBy('id', 'DESC')->paginate(20);
                break;

            default:
                # code...
                break;
        }
        $data = ['articles' => $products];
        return view('admin.article.home', $data);

    }


    public function getArticleAdd()
    {
        $cats = Article::where('module', 'campaña')->pluck('name', 'id');
        $data = [
            'cats' => $cats
        ];
        return view('admin.article.add', $data);

    }


    public function postArticleAdd(Request $request)
    {
        $rules = [
    		'name'                              => 'required',
            'file'                              => 'required',
            'body_1'                              => 'required',
        ];

        $messages = [
            'name.required'                     => 'El nombre de la noticia es requerido.',
            'file.required'                     => 'Seleccione una imagen destacada de noticia.',
            'body_1.required'                     => 'La descripción de la noticia es requerida.',
            'date.required'                     => 'La fecha de la noticia es requerida.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();

        else:

            $articleName = Str::slug($request->input('name'));
            $path = '/Campaign/'.$articleName;
            $fileExt = trim($request->file('file')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('file')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $file_absolute = $upload_path.'/'.$path.'/'.$filename;
            $file_url = 'multimedia'.$path.'/t_'.$filename;

            $product = new Article;
            $product->status                = '0';
            $product->module                = 'campaña';
            $product ->name                 = e($request->input('name'));
            $product ->slug                 = Str::slug($request->input('name'));
            $product ->file_path            = $path;
            $product ->file                 = $filename;
            $product ->mobile               = asset($file_url);
            $product ->date                 = e($request->input('date'));
            $product ->body_1               = e($request->input('body_1'));

            if($product->save()):

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

                return redirect('/admin/campaigns/1')->with('message', ' Campaña guardada con éxito.')->with('typealert', 'success');

            endif;

        endif;
    }


    public function getArticleEdit($id)
    {
        $product        = Article::findOrFail($id);
        $galerias        =NGallery::where('article_id', $product->id)->get();

        $data           = [
            'product' => $product,
            'galerias' => $galerias
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
            $product->module                = 'campaña';
            $product ->name                 = e($request->input('name'));
            $product ->slug                 = Str::slug($request->input('name'));
            $product ->video_1                 = e($request->input('video_1'));
            $product ->video_2                 = e($request->input('video_2'));
            $product ->video_3                 = e($request->input('video_3'));
            $product ->video_4                 = e($request->input('video_4'));
            $product ->video_5                 = e($request->input('video_5'));
            $product ->date                 = e($request->input('date'));
            $product ->body_1                 = e($request->input('body_1'));
            $product ->body_2                 = e($request->input('body_2'));
            $product ->body_3                = e($request->input('body_3'));
            $product ->body_4                 = e($request->input('body_4'));
            $product ->body_5                = e($request->input('body_5'));

            if($request->hasFile('file')):

                $articleName = Str::slug($request->input('name'));
                $path = '/Campaign/'.$articleName;
                $fileExt = trim($request->file('file')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('file')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_absolute = $upload_path.'/'.$path.'/'.$filename;
                $file_url = 'multimedia'.$path.'/t_'.$filename;
                $product ->mobile               = asset($file_url);
                $product ->file_path            = $path;
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

                return back()->with('message', ' Campaña actualizada con éxito.')->with('typealert', 'success');

            endif;


        endif;

    }


    public function getArticleDelete($id)
    {
        $product = Article::find( $id);

        if($product->delete()):

            return back()->with('message', ' Campaña enviada con éxito a la papeplera.')->with('typealert', 'success');

        endif;
    }


    public function getArticleRestore($id)
    {
        $product = Article::onlyTrashed()->where('id', $id)->first();
        $product ->deleted_at   = null;

        if ($product->save()):

            return redirect('/admin/campaign/'.$product->id.'/edit')->with('message', ' La campaña se restauro correctamente.')->with('typealert', 'success')->withInput();

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
            if($request->hasFile('file')):
                $article =  DB::table('articles')->orderBy('id', 'DESC')->where('id', $id)->first();
                $path = '/Campaign/'.$article->slug;
                $fileExt = trim($request->file('file')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');

                $name = Str::slug(str_replace($fileExt, '', $request->file('file')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_absolute = $upload_path.'/'.$path.'/'.$filename;

                switch ($gallery):
                    case '1':
                        $g =new NGallery;
                        $g->article_id = $id;
                        $g->after = $gallery;
                        $g->file_path = $path;
                        $g->file_name = $filename;
                        break;
                    case '2':
                        $g =new NGallery;
                        $g->article_id = $id;
                        $g->after = $gallery;
                        $g->file_path = $path;
                        $g->file_name = $filename;
                        break;
                    case '3':
                        $g =new NGallery;
                        $g->article_id = $id;
                        $g->after = $gallery;
                        $g->file_path = $path;
                        $g->file_name = $filename;
                        break;
                    case '4':
                        $g =new NGallery;
                        $g->article_id = $id;
                        $g->after = $gallery;
                        $g->file_path = $path;
                        $g->file_name = $filename;
                        break;
                    case '5':
                        $g =new NGallery;
                        $g->article_id = $id;
                        $g->after = $gallery;
                        $g->file_path = $path;
                        $g->file_name = $filename;
                        break;
                endswitch;

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
