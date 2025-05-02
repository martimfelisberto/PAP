@php 
use App\Models\Artigo; // Ensure the Artigo class exists in this namespace
@endphp
<x-kaira-layout>


    @php

        // Filtros
        $categoria = request('categoria', 'todos');
        $ordenacao = request('ordenar', 'padrao');

        // Consulta base
        $query = Artigo::query();

        // Aplicar filtros
        if ($categoria !== 'todos') {
            $query->where('categoria', $categoria);
        }

        // Aplicar ordenação
        switch ($ordenacao) {
            case 'preco-asc':
                $query->orderBy('preco', 'asc');
                break;
            case 'preco-desc':
                $query->orderBy('preco', 'desc');
                break;
            case 'nome-asc':
                $query->orderBy('nome', 'asc');
                break;
            case 'nome-desc':
                $query->orderBy('nome', 'desc');
                break;
            default:
                $query->latest();
        }

        $artigos = $query->paginate(12); // Paginação com 12 itens por página
    @endphp

    <div class="container px-4 mx-auto">
        <h1 class="my-4 text-2xl font-bold">Artigos para
            @if (request()->genero == 'homem')
                Home,
            @elseif(request()->genero == 'mulher')
                Mulher
            @elseif(request()->genero == 'crianca')
                Criança
            @endif
        </h1>

       
    </div>

    <section class="py-5 product-section">
        <div class="container">
            <!-- Filtros e ordenação -->
            <div class="mb-4 row">
                
                <div class="col-md-6 text-end">
                    <div class="dropdown d-inline-block me-2">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Filtrar por Categoria
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item" href="?categoria=todos">Todos</a></li>
                            <li><a class="dropdown-item" href="?categoria=homem">Homem</a></li>
                            <li><a class="dropdown-item" href="?categoria=mulher">Mulher</a></li>
                            <li><a class="dropdown-item" href="?categoria=crianca">Criança</a></li>
                        </ul>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Ordenar por
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item" href="?ordenar=preco-asc">Preço: Menor para Maior</a></li>
                            <li><a class="dropdown-item" href="?ordenar=preco-desc">Preço: Maior para Menor</a></li>
                            <li><a class="dropdown-item" href="?ordenar=nome-asc">Nome: A-Z</a></li>
                            <li><a class="dropdown-item" href="?ordenar=nome-desc">Nome: Z-A</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Listagem de produtos -->
            <div class="row">
                @foreach ($artigos as $artigo)
                    <div class="mb-4 col-lg-3 col-md-4 col-sm-6">
                        <div class="card h-100 product-card">
                            @if ($artigo->destaque)
                                <span class="top-0 m-2 badge bg-danger position-absolute start-0">Destaque</span>
                            @endif

                            <!-- Imagem do produto -->
                            <img src="{{ $artigo->imagem ? asset('storage/artigos/' . $artigo->imagem) : asset('images/placeholder.jpg') }}"
                                class="card-img-top" alt="{{ $artigo->nome }}">

                            <div class="card-body">
                                <!-- Nome e preço -->
                                <h5 class="card-title">{{ $artigo->nome }}</h5>
                                <p class="card-text text-success fw-bold">EUR€
                                    {{ number_format($artigo->preco, 2, ',', '.') }}</p>
                                <p class="text-muted">{{ $artigo->marca }} - {{ $artigo->categoria }}</p>

                                <!-- Ações -->
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('produtos.detalhes', ['id' => $artigo->id]) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        Ver Detalhes
                                    </a>
                                    <form action="{{ route('carrinho.adicionar') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $artigo->id }}">
                                        <input type="hidden" name="quantidade" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="bi bi-cart-plus"></i> Adicionar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginação -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    @if ($artigos->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Anterior</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $artigos->previousPageUrl() }}">Anterior</a>
                        </li>
                    @endif

                    @foreach ($artigos->getUrlRange(1, $artigos->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $artigos->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($artigos->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $artigos->nextPageUrl() }}">Próxima</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Próxima</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </section>
</x-kaira-layout>