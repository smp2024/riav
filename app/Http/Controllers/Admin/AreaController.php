<?php

namespace App\Http\Controllers\Admin;

use App\Area;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;

class AreaController extends Controller
{
    public function __Construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome()
    {
        $areas = Area::orderBy('orden', 'ASC')->get();
        $areasCount = count($areas);
        
        $data = [
            'areas_' => $areas,
            'areasCount' => $areasCount
        ];

        return view('admin.areas.home', $data);

    }

    public function postAreaAdd(Request $request)
    {
        $rules = [

            'file'                              => 'required|image|mimes:jpg,png,jpeg|max:6144'

        ];

        $messages = [
            'file.required'                     => 'Seleccione una imagen destacada para el modulo.',
            'file.image'                        => 'El archivo no es una imagen.',          
            'file.max'                          => 'La imagen pesa más de 6Mb',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger');

        else:

            $path = '/Areas';
            $fileExt = trim($request->file('file')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('file')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $file_absolute = $upload_path.'/'.$path.'/'.$filename;

            $a = new Area;
            $a ->name           = e($request->input('name'));
            $a ->slug           = Str::slug($request->input('name'));
            $a ->file_path                  = $path;
            $a ->file                       = $filename;
            if($a->save()):

                if($request->hasFile('file')):
                    $fl = $request->file->storeAs($path, $filename, 'uploads');
                    $imagT = Image::make($file_absolute);
                    $imagT->resize(256, 256, function($aonstraint){
                        $aonstraint->upsize();
                    });
                    $imagW = Image::make($file_absolute);
                    $imagW->resize(500, 500, function($aonstraint){
                        $aonstraint->upsize();
                    });
                    $imagT->save($upload_path.'/'.$path.'/t_'.$filename);
                    $imagW->save($upload_path.'/'.$path.'/'.$filename);
                endif;

                return back()->with('message', ' Area guardada con éxito.')->with('typealert', 'success');

            endif;

        endif;

    }

    public function getAreaEdit($id)
    {

        $area                = Area::find( $id);
        $data               = [
            'area' => $area
        ];
        return view('admin.areas.edit', $data);
    }

    public function postAreaEdit(Request $request, $id)
    {
        if($request->hasFile('file')):
            $rules = [

                'file'                          => 'required|image|mimes:jpg,png,jpeg|max:6144'

            ];
        else:
            $rules = [];
        endif;


        $messages = [

            'file.required'                     => 'Seleccione una imagen destacada un carousel.',
            'file.image'                        => 'El archivo no es una imagen.',
            'file.max'                          => 'La imagen pesa más de 6Mb',
     
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();

        else:

            $a = Area::findOrFail( $id);
            $a ->name           = e($request->input('name'));
            $a ->slug           = Str::slug($request->input('name'));
            $a ->status         = $request->input('status');
            $a ->orden         = $request->input('orden');
            if($request->hasFile('file')):

                $path           = '/Areas';
                $fileExt        = trim($request->file('file')->getClientOriginalExtension());
                $upload_path    = Config::get('filesystems.disks.uploads.root');
                $name           = Str::slug(str_replace($fileExt, '', $request->file('file')->getClientOriginalName()));
                $filename       = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_absolute  = $upload_path.'/'.$path.'/'.$filename;
                $a ->file_path  = $path;
                $a ->file       = $filename;           

            endif;

            if($a->save()):

                if($request->hasFile('file')):
                    $fl = $request->file->storeAs($path, $filename, 'uploads');
                    $imagT = Image::make($file_absolute);
                    $imagT->resize(256, 256, function($aonstraint){
                        $aonstraint->upsize();
                    });
                    $imagW = Image::make($file_absolute);
                    $imagW->resize(500, 500, function($aonstraint){
                        $aonstraint->upsize();
                    });
                    $imagT->save($upload_path.'/'.$path.'/t_'.$filename);
                    $imagW->save($upload_path.'/'.$path.'/'.$filename);

                endif;
                
                return redirect('/admin/areas')->with('message', ' Area actualizada con éxito.')->with('typealert', 'success');

            endif;

        endif;

    }

    public function getAreaDelete($id)
    {
        $a = Area::find( $id);

        if($a->delete()):

            return back()->with('message', ' Area elminada con éxito.')->with('typealert', 'success');

        endif;
    }

}

