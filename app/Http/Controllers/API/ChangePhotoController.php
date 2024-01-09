<?php
namespace App\Http\Controllers\API;

use App\Models\Karyawan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Auth;

class ChangePhotoController extends Controller {

public function changephoto(Request $request,$id) {
        $photos = Karyawan::findOrFail($id);
        $validator = Validator::make($request->all(), [
        'photo' => 'required|image|max:3096|mimes:jpg,jpeg'
        ]);
	    if ($validator->fails()) {
		return response()->json($validator->errors(), 403);
        } else {
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                //$photo->storeAs('public/images/posts', $photo);    
                $extphoto = $request->file('photo')->getClientOriginalExtension();
                $photo_Name = 'Profile_'.$photos->nomor_induk_karyawan.'.'.$extphoto;
                //$photo->storeAs('public/images/posts', $photo->getClientOriginalName());              
                Storage::delete('public/',$photos->photo);
                $filePath = $photo->storeAs('profile', $photo_Name, 'public');
                //File::delete($filePath);
                
                $photos->update(['photo' => $filePath]);
            } else {
                $extphoto = $request->file('photo')->getClientOriginalExtension();
                $photo_Name = 'Profile_'.$photos->nomor_induk_karyawan.'.'.$extphoto;
                //$photo_Name = time() . '_' . $photo->getClientOriginalName();
                $filePath = $photo->storeAs('profile', $photo_Name, 'public');
                $photos->update(['photo' => $filePath]);
            } 
//            $photos->update($request->all());
            //return response()->json($photos->photo, 200);
            return response()->json(['success' => 'Foto Profile berhasil diubah', 
            'Path' => $photos->photo],200);
        }
    }
}
?>
