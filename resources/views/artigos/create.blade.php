    @extends('layouts.app')

    @section('content')
        <!DOCTYPE html>
        <html lang="pt-BR">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Adicionar Artigo | Marketplace</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                @media (min-width: 1024px) {
                    .form-container {
                        min-width: 800px;
                    }

                    .form-grid {
                        display: grid;
                        grid-template-columns: 1fr 300px;
                        gap: 2rem;
                    }

                    .image-preview-container {
                        height: 100%;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                    }
                }
            </style>
        </head>

        <body class="flex items-center justify-center min-h-screen p-4 bg-gray-100">
            <div class="w-full overflow-hidden bg-white rounded-lg shadow-md form-container">
                <h1 class="py-6 text-3xl font-bold text-center text-blue-600">Vender um Artigo</h1>

                <!-- Formulário -->
                <form method="POST" action="{{ route('artigos.store') }}" enctype="multipart/form-data" class="p-6 form-grid">
                    @csrf

                    <div class="space-y-4">
                        <!-- Nome -->
                        <div>
                            <label class="block font-semibold text-gray-700">Nome:</label>
                            <input type="text" name="nome" required
                                class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" value="{{ old('nome') }}">
                            @error('nome')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Descrição -->
                        <div>
                            <label class="block font-semibold text-gray-700">Descrição:</label>
                            <textarea name="descricao" required rows="4" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">{{ old('descricao') }}</textarea>
                            @error('descricao')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <!-- Preço -->
                            <div>
                                <label class="block font-semibold text-gray-700">Preço (€):</label>
                                <input type="number" step="0.01" name="preco" required
                                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300"
                                    value="{{ old('preco') }}">
                                @error('preco')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Marca -->
                            <div>
                                <label class="block font-semibold text-gray-700">Marca:</label>
                                <select name="marca" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
                                    <option value="Nike" {{ old('marca') == 'Nike' ? 'selected' : '' }}>Nike</option>
                                    <option value="Adidas" {{ old('marca') == 'Adidas' ? 'selected' : '' }}>Adidas</option>
                                    <option value="Puma" {{ old('marca') == 'Puma' ? 'selected' : '' }}>Puma</option>
                                    <option value="Reebok" {{ old('marca') == 'Reebok' ? 'selected' : '' }}>Reebok</option>
                                    <option value="Outros" {{ old('marca') == 'Outros' ? 'selected' : '' }}>Outros</option>
                                </select>
                                @error('marca')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">


                            <!-- Categoria -->
                            <div class="relative">
                                <label class="block font-semibold text-gray-700">Categoria:</label>
                                <div onclick="toggleDropdown('categoriaDropdown')"
                                    class="flex items-center justify-between w-full p-2 bg-white border rounded-md cursor-pointer">
                                    <span
                                        id="selectedCategories">{{ old('categoria') ? old('categoria') : 'Selecione a categoria' }}</span>
                                    <span>▼</span>
                                </div>
                                <div id="categoriaDropdown"
                                    class="absolute z-10 hidden w-full mt-2 bg-white border rounded-md shadow-md">
                                    <div class="p-2 space-y-2">
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="categoria" value="Casacos"
                                                class="form-radio categoria-option"
                                                {{ old('categoria') == 'Casacos' ? 'checked' : '' }}
                                                onchange="updateSelectedCategory('Casacos'); updateTamanhoOptions('Casacos')">
                                            <span>Casacos</span>
                                        </label>
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="categoria" value="Camisolas"
                                                class="form-radio categoria-option"
                                                {{ old('categoria') == 'Camisolas' ? 'checked' : '' }}
                                                onchange="updateSelectedCategory('Camisolas'); updateTamanhoOptions('Camisolas')">
                                            <span>Camisolas</span>
                                        </label>
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="categoria" value="Calças e Calções"
                                                class="form-radio categoria-option"
                                                {{ old('categoria') == 'Calças e Calções' ? 'checked' : '' }}
                                                onchange="updateSelectedCategory('Calças e Calções'); updateTamanhoOptions('Calças e Calções')">
                                            <span>Calças e Calções</span>
                                        </label>
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="categoria" value="Tops e T-shirts"
                                                class="form-radio categoria-option"
                                                {{ old('categoria') == 'Tops e T-shirts' ? 'checked' : '' }}
                                                onchange="updateSelectedCategory('Tops e T-shirts'); updateTamanhoOptions('Tops e T-shirts')">
                                            <span>Tops e T-shirts</span>
                                        </label>
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="categoria" value="Sapatilhas"
                                                class="form-radio categoria-option"
                                                {{ old('categoria') == 'Sapatilhas' ? 'checked' : '' }}
                                                onchange="updateSelectedCategory('Sapatilhas'); updateTamanhoOptions('Sapatilhas')">
                                            <span>Sapatilhas</span>
                                        </label>
                                    </div>
                                </div>
                                @error('categoria')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Gênero -->
                            <div>
                                <label class="block font-semibold text-gray-700">Gênero:</label>
                                <select name="genero" id="genero"
                                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300"
                                    onchange="updateGeneroRedirect()">
                                    <option value="Homem" {{ old('genero') == 'Homem' ? 'selected' : '' }}>Homem</option>
                                    <option value="Mulher" {{ old('genero') == 'Mulher' ? 'selected' : '' }}>Mulher</option>
                                    <option value="Criança" {{ old('genero') == 'Criança' ? 'selected' : '' }}>Criança</option>
                                </select>
                                @error('genero')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        
                        
                        <!-- Estado -->
                        <div>
                            <label class="block font-semibold text-gray-700">Estado:</label>
                            <select name="estado" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
                                <option value="Novo" {{ old('estado') == 'Novo' ? 'selected' : '' }}>Novo</option>
                                <option value="Usado" {{ old('estado') == 'Usado' ? 'selected' : '' }}>Usado</option>
                                <option value="Semi-novo" {{ old('estado') == 'Semi-novo' ? 'selected' : '' }}>Semi-novo
                                </option>
                            </select>
                            @error('estado')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <!-- Tamanho (Dinâmico) -->
                        <div id="tamanhoContainer" class="{{ old('categoria') ? '' : 'hidden' }}">
                            <label class="block font-semibold text-gray-700">Tamanho:</label>
                            <select id="tamanho" name="tamanho"
                                class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
                                <option value="" disabled selected>Selecione o tamanho</option>
                                @if (old('categoria') &&
                                        in_array(old('categoria'), ['Casacos', 'Camisolas', 'Calças e Calções', 'Tops e T-shirts']))
                                    @foreach (['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                        <option value="{{ $size }}" {{ old('tamanho') == $size ? 'selected' : '' }}>
                                            {{ $size }}</option>
                                    @endforeach
                                @elseif(old('categoria') == 'Sapatilhas')
                                    @for ($i = 36; $i <= 46; $i += 0.5)
                                        <option value="{{ $i }}" {{ old('tamanho') == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                @endif
                            </select>
                            @error('tamanho')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Cor -->
                        <div class="relative">
                            <label class="block font-semibold text-gray-700">Cores:</label>
                            <div onclick="toggleDropdown('corDropdown')"
                                class="flex items-center justify-between w-full p-2 bg-white border rounded-md cursor-pointer">
                                <span id="selectedColors">
                                    @if (old('cores'))
                                        {{ implode(', ', (array) old('cores')) }}
                                    @else
                                        Selecione as cores
                                    @endif
                                </span>
                                <span>▼</span>
                            </div>
                            <div id="corDropdown"
                                class="absolute z-10 hidden w-full mt-2 bg-white border rounded-md shadow-md">
                                <div class="p-2 space-y-2">
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="cores[]" value="Preto" class="form-checkbox"
                                            {{ is_array(old('cores')) && in_array('Relógios', old('cores')) ? 'checked' : '' }}
                                            onchange="updateSelectedColors()">
                                        <span>Preto</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="cores[]" value="Branco" class="form-checkbox"
                                            {{ is_array(old('cores')) && in_array('Óculos de Sol', old('cores')) ? 'checked' : '' }}
                                            onchange="updateSelectedColors()">
                                        <span>Branco</span>
                                    </label>
                                </div>
                            </div>
                            @error('cores')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
            </div>

            <!-- Upload de Imagem (lado direito) -->
            <div class="image-preview-container">
                <label for="imagem" class="flex flex-col items-center cursor-pointer">
                    <div
                        class="relative flex items-center justify-center w-full h-64 overflow-hidden bg-gray-100 border-2 border-gray-300 border-dashed rounded-lg md:h-80">
                        <img id="imagePreview" src="https://via.placeholder.com/400" alt="Pré-visualização da imagem"
                            class="absolute inset-0 hidden object-contain w-full h-full">
                        <div id="imagePlaceholder" class="p-4 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="block mt-2 font-medium text-gray-600">Clique para adicionar imagem</span>
                            <span class="block text-sm text-gray-500">Tamanho recomendado: 800x800px</span>
                        </div>
                    </div>
                    <input type="file" id="imagem" name="imagem" accept="image/*" class="hidden"
                        onchange="previewImage(event)">
                </label>
                    @error('imagem')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                 @enderror
            
            
                 <!-- Adicione este campo hidden antes do botão de submit -->
                 <input type="hidden" name="redirect_to" id="redirect_to" value="">

                    <!-- Botão de Submissão -->
                     <div class="col-span-2">
                    <button type="submit"
                    class="w-full py-3 font-medium text-white transition bg-blue-600 rounded-md hover:bg-blue-700">
                    Adicionar Artigo
                    </button>
                    </div>
                    </form>
                </div>
            </div>

            <!-- Scripts -->
            <script>
                // Inicializa o dropdown de categoria se já tiver um valor selecionado
                document.addEventListener('DOMContentLoaded', function() {
                    const categoria = "{{ old('categoria') }}";
                    if (categoria) {
                        updateSelectedCategory(categoria);
                        updateTamanhoOptions(categoria);
                    }

                    // Atualiza cores selecionadas
                    updateSelectedColors();
                });

                function toggleDropdown(id) {
                    document.getElementById(id).classList.toggle('hidden');
                }

                // Fechar dropdowns ao clicar fora
                document.addEventListener('click', function(event) {
                    if (!event.target.closest('.relative')) {
                        document.getElementById('categoriaDropdown').classList.add('hidden');
                        document.getElementById('corDropdown').classList.add('hidden');
                    }
                });

                function updateSelectedCategory(categoria) {
                    document.getElementById('selectedCategories').textContent = categoria;
                }

                function updateSelectedColors() {
                    const checkboxes = document.querySelectorAll('input[name="cores[]"]:checked');
                    const selectedColors = Array.from(checkboxes).map(cb => cb.nextElementSibling.textContent).join(', ');
                    document.getElementById('selectedColors').textContent = selectedColors || 'Selecione as cores';
                }

                function updateTamanhoOptions(categoria) {
                    const tamanhoContainer = document.getElementById("tamanhoContainer");
                    const tamanhoSelect = document.getElementById("tamanho");

                    // Limpa as opções anteriores, mantendo apenas a primeira opção
                    while (tamanhoSelect.options.length > 1) {
                        tamanhoSelect.remove(1);
                    }

                    // Mostra o container de tamanhos
                    tamanhoContainer.classList.remove('hidden');

                    // Adiciona os tamanhos específicos para cada categoria
                    if (['Casacos', 'Camisolas', 'Calças e Calções', 'Tops e T-shirts'].includes(categoria)) {
                        const tamanhos = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
                        tamanhos.forEach(tamanho => {
                            const option = new Option(tamanho, tamanho);
                            tamanhoSelect.add(option);
                        });
                    } else if (categoria === 'Sapatilhas') {
                        // Gera tamanhos de 36 a 46
                        for (let i = 36; i <= 46; i += 0.5) {
                            const option = new Option(i.toString(), i.toString());
                            tamanhoSelect.add(option);
                        }
                    } else {
                        // Para outras categorias sem tamanho específico
                        tamanhoContainer.classList.add('hidden');
                    }
                }

                // Preview da imagem
                function previewImage(event) {
                    const input = event.target;
                    const preview = document.getElementById('imagePreview');
                    const placeholder = document.getElementById('imagePlaceholder');

                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                            placeholder.classList.add('hidden');
                        }
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        preview.src = '';
                        preview.classList.add('hidden');
                        placeholder.classList.remove('hidden');
                    }
                }
            </script>
        </body>

        </html>
    @endsection
