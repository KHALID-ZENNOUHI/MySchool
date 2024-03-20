<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
        /** home dashboard */
        public function index()
        {
            return view('dashboard.home');
        }
    
        /** profile user */
        public function userProfile()
        {
            return view('dashboard.profile');
        }
    
        /** teacher dashboard */
        public function teacherDashboardIndex()
        {
            return view('dashboard.teacher_dashboard');
        }
    
        /** student dashboard */
        public function studentDashboardIndex()
        {
            return view('dashboard.student_dashboard');
        }
}
