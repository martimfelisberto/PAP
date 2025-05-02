<x-kaira-layout>
    <div class="container py-5">
        @isset($artigo)
            <div class="row">
                <!-- Imagem do produto -->
                <div class="col-md-6">
                    @if($artigo->imagem)
                        <img src="{{ asset('storage/' . $artigo->imagem) }}" 
                             alt="{{ $artigo->nome }}" 
                             class="img-fluid rounded">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" 
                             style="height: 400px;">
                            <span class="text-muted">Sem imagem</span>
                        </div>
                    @endif
                </div>
                
                <!-- Detalhes do produto -->
                <div class="col-md-6">
                    <h1 class="mb-3">{{ $artigo->nome }}</h1>
                    <p class="text-success h4 mb-4">R$ {{ number_format($artigo->preco, 2, ',', '.') }}</p>
                    
                    <div class="mb-4">
                        <p><strong>Marca:</strong> {{ $artigo->marca }}</p>
                        <p><strong>Categoria:</strong> {{ $artigo->categoria }}</p>
                        <p><strong>Descrição:</strong></p>
                        <p>{{ $artigo->descricao }}</p>
                    </div>
                    
                    <!-- Formulário do carrinho -->
                    <form action="{{ route('carrinho.adicionar') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $artigo->id }}">
                        
                        <div class="row align-items-center">
                            <div class="col-md-3 mb-3 mb-md-0">
                                <label for="quantidade" class="form-label">Quantidade:</label>
                                <input type="number" name="quantidade" value="1" min="1" 
                                       class="form-control" id="quantidade">
                            </div>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-primary w-100 py-3">
                                    <i class="bi bi-cart-plus"></i> Adicionar ao Carrinho
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-danger">
                Order não encontrado ou não disponível.
            </div>
        @endisset
    </div>
</x-kaira-layout>