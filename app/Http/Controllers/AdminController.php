<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getDetails()
    {
        $total_projects = Project::count();
        $users = User::count();
        $projects_completed = Project::where('state_id',1)->count();
        $projects_incomplete = Project::where('state_id',2)->count();

        return response(['data' => [ 'total_projects' => $total_projects, 'total_users' => $users, 'projects_completed' => $projects_completed, 'projects_incompleted' => $projects_incomplete
        ]],200);
    }

    public function getAllUsers()
    {
        $users = User::all();
        return response(['data'=> $users],200);
    }
}
