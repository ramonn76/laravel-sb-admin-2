<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

class BillController extends Controller
{
    public function createForm(){
        return view('file-upload');
      }
      public function fileUpload(Request $req){
            $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            ]);
            $billModel = new Bill();
            if($req->file()) {
                $fileName = time().'_'.$req->file->getClientOriginalName();
                $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
                $billModel->file_path = '/storage/' . $filePath;
                $billModel->save();
                return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
            }
       }
}
