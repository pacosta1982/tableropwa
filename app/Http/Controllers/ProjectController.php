<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Observacion;
use App\ObservacionFonavis;
use App\Programa;
use App\Departamento;
use App\Estado;
use App\SIG005;
use App\SIG006;
use App\Administracion;
use App\Terreno;
use App\Meta;
use Mapper;
use App\Exports\HistorialExport;
use App\Exports\ProjectExport;
use App\Http\Resources\ProjectResource as ProjectResource;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        $tasks = Estado::paginate(15);
        // Return a collection of $task with pagination
        return TaskResource::collection($tasks);
    }

    public function details()
    {
        $tasks = Project::paginate(20);
        // Return a collection of $task with pagination
        return ProjectResource::collection($tasks);
    }

    public function showproject($id)
    {
        $tasks = Project::where('SEOBId', $id)->get();
        // Return a collection of $task with pagination
        return ProjectResource::collection($tasks);
    }

    public function searchproject(Request $request)
    {
        $projects = Project::query();
        $searchTerm = $request->input('proyname');
        $projects = $projects->where('SEOBProy', 'LIKE', "%{$searchTerm}%");
        $projects = $projects->paginate(20);
        // Return a collection of $task with pagination
        return ProjectResource::collection($projects);
    }

}
