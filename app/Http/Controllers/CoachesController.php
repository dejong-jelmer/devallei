<?php 

namespace App\Http\Controllers;

use App\Models\Coach;

/**
 * Class CoachesController
 * @package App\Http\Controllers
 */

class CoachesController
{
    /**
     * GET /coaches
     * @return  array
     */
    
    public function index()
    {
        return Coach::all(); 
    }
}