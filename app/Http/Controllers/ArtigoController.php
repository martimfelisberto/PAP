<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artigo;



class ArtigoController extends Controller
{
    public function show($id)
    {
        $artigo = Artigo::findOrFail($id); // Busca o artigo pelo ID
        return view('produtos.detalhes', compact('artigo')); // Passa para a view
    }

    // No ProdutoController.php
    public function index(Request $request)
    {
        $query = Artigo::query();

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('preco_min')) {
            $query->where('preco', '>=', $request->preco_min);
        }

        if ($request->filled('preco_max')) {
            $query->where('preco', '<=', $request->preco_max);
        }

        $genero = $request->genero;

        $query = Artigo::query();

        if ($genero) {
            $query->where('genero', $genero);
        }

        $artigos = $query->latest()->get();

        return view('artigos.index', compact('artigos', 'genero'));

    }

    // Método para mostrar o formulário de criação
    public function create()
    {
        return view('artigos.create');
    }
    public function homem($tipo = null)
    {
        $query = Artigo::where('genero', 'homem');
        
        if ($tipo) {
            $query->where('tipo', $tipo);
        }
        
        $artigos = $query->latest()->paginate(12);
        
        
    }
    
    public function mulher($tipo = null)
    {
        $query = Artigo::where('genero', 'mulher');
        
        if ($tipo) {
            $query->where('tipo', $tipo);
        }
        
        $artigos = $query->latest()->paginate(12);
     
    }
    
    public function crianca($tipo = null)
    {
        $query = Artigo::where('genero', 'crianca');
        
        if ($tipo) {
            $query->where('tipo', $tipo);
        }
        
        $artigos = $query->latest()->paginate(12);
        
       
    }
    
    public function produtosPorGenero($genero)
{
    $validGeneros = ['homem', 'mulher', 'crianca', 'unissex'];
    
    if (!in_array($genero, $validGeneros)) {
        abort(404);
    }

    $produtos = Artigo::where('genero', $genero)->get();
    return view('artigos.index', compact('produtos', 'genero'));

}


    public function store(Request $request)
    {
        $validated = $request->validate([
       
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'marca' => 'required|string|max:100',
            'categoria' => 'required|string|max:100',
            'genero' => 'required|string|in:Homem,Mulher,Criança',
            'estado' => 'required|string|in:Novo,Usado,Semi-novo',
            'tamanho' => 'nullable|string',
            'cores' => 'nullable|array',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



        // Processar upload da imagem
        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('public/artigos');
            $validated['imagem'] = str_replace('public/', 'storage/', $path);
        }

        // Converter array de cores para string
        if (isset($validated['cores'])) {
            $validated['cores'] = implode(', ', $validated['cores']);
        }


        Artigo::create($validated);
        
        return redirect()->route('artigos.index', ['genero' => $request->genero])
        ->with('success', 'Artigo criado com sucesso!');

        

    }
}