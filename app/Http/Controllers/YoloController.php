<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of YoloController
 *
 * @author Admin
 */
use \App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class YoloController extends Controller {

    public $conn = null;

    //put your code here
    public static function show() {
        return "Yolo!!";
    }

    public function __constructor() {

        var_dump('YoloController constructor'); exit();
    }

    public function getAllUsers() {
        try {
            //$this->conn = new DBController();
            $users = DB::table("users")->get(); //->table('users')->get();
        } catch (\Exception $e) {

            return "error " . $e->getMessage();
        }

        return $users;
    }

    public $folder = "C:\Users\Admin\Desktop\Test";

    public function checkSessionLogin() {

        if (is_null(session()->get('sessionLogin')) || !session()->exists('sessionLogin')) {

            return view('login');
        }
    }

    public function upload(Request $request) {

        $this->checkSessionLogin();

        $fileList = $request->file('files');
        foreach ($fileList as $file) {

            $selectedOption = $request->input('m_major');
            $m_majorType = explode('|', $selectedOption)[0];
            $m_majorId = explode('|', $selectedOption)[1];

            $this->folder = storage_path('/').\Illuminate\Support\Facades\Storage::disk('local')->url($m_majorType);
            
            if (!File::exists($this->folder)) {
                File::makeDirectory($this->folder);
            }
            if ($this->copyFile($this->folder, $file)) {
                DB::table('filestore')->insert(
                        ['name' => $file->getClientOriginalName()
                            , 'name_gen' => str_replace("tmp", $file->getClientOriginalExtension(), $file->getFileName())
                            , 'update_date' => \Carbon\Carbon::now()->toDateTimeString()
                            , 'major_id' => $m_majorId
                            , 'user_id' => session()->get('sessionLogin')[1]]
                );
            }
        }

        $items = $this->getM_MajorFile();
        return view('welcome', compact('id', 'items'));
    }
    
    public function copyFile($folder, $file) {
        $name_gen = str_replace("tmp", $file->getClientOriginalExtension(), $file->getFileName());
        if (!File::exists($name_gen)) {

            return $file->move($folder, $name_gen);
        } else {

            $this->copyFile($folder, $file);
        }
    }

    public function getM_MajorFile() {
        $dbController = new DBController();
        return DB::table("m_majortype")->get(['id', 'name']);
    }

    public function getM_MajorFileByName($name) {

        return $this->getM_MajorFile()->where("name", $name);
    }

    private $_file = null;
        
    public function getAllFile(Request $request)
    {
        $this->checkSessionLogin();

        $files = DB::table('filestore')
                        ->join('m_majortype', 'filestore.major_id', '=', 'm_majortype.id')
                        ->join('users', 'filestore.user_id', '=', 'users.id')
                        ->get(['filestore.id'
                            , 'filestore.major_id'
                            , 'filestore.name as file_name'
                            , 'filestore.name_gen'
                            , 'filestore.update_date'
                            , 'filestore.user_id'
                            , 'm_majortype.name as major_name'
                            , 'users.user_name']
                        )->sortBy('update_date');
        
        $_files = $files;
        // Get current page form url e.x. &page=1
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();
 
        // Create a new Laravel collection from the array data
        $itemCollection = collect($_files);
 
        // Define how many items we want to be visible in each page
        $perPage = 5;
 
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // Create our paginator and pass it to the view
        $paginatedItems= new \Illuminate\Pagination\LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
 
        // set url path for generted links
        $paginatedItems->setPath($request->url());
 
        return view('files', ['files' => $paginatedItems,'numberPerPage' => 3]);
    }
    
    public function sortByFileName($id) {
        var_dump($id);
        
    }

}
