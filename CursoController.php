<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurso;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{

    public function index(){
        //llamo a la modelo Curso
        //all muestra todos los registros
        //paginate los muestra de forma paginada mostrando 15 registos
        $cursos = Curso::paginate();
        return view('curso.index', compact('cursos'));
    }

    public function create(){
        return view('curso.create');
    }

    //insertar registros
    public function store(StoreCurso $request, Curso $curso){ 
        $curso->create($request->all());
        return redirect()->route('curso.index', $curso);
    }

    public function show(Curso $curso){
        return view('curso.show', compact('curso'));
    }

    public function edit(Curso $curso){
        return view('curso.edit', compact('curso'));
    }

    public function update(StoreCurso $request, Curso $curso){
        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|unique:cursos,'.$curso->id,
            'description' => 'required'
        ]);
        $curso->update($request->all());
        return redirect()->route('curso.index');
    }

    public function destroy(Request $request, Curso $curso){
        $curso->delete();
        return redirect()->route('curso.index');
    }

}
