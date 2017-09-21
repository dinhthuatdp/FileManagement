<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

/**
 * Description of DBController
 *
 * @author Admin
 */
class DBController {
    
    public $conn = null;
    
    public function __construct() {
        
        if (is_null($this->conn)) {

            $this->conn = DB::connection('mysql');
        }
        return $this->conn;
    }
}
