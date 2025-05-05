<x-kaira-layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <header class="bg-white dark:bg-gray-800 shadow-lg">
            <div class="max-w-7xl mx-auto py-6 px-5 sm:px-7 lg:px-9">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h2>
            </div>
        </header>

        <main class="py-6">
            <div class="max-w-7xl mx-auto px-5 sm:px-7 lg:px-9">
                <!-- Container Principal -->
                <div class="grid lg:grid-cols-2 gap-6"> <!-- Grid de 2 colunas em telas grandes -->
                    <!-- Coluna Esquerda - Estatísticas -->
                    <div class="grid grid-cols-1 gap-6"> <!-- Grid vertical -->
                        <!-- Total Users -->
                        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-500 rounded-lg p-4">
                                        
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Total Users</h4>
                                        <div class="mt-2 text-4xl font-bold text-gray-900 dark:text-white">
                                            {{ $stats['total_users'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Artigos -->
                        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-500 rounded-lg p-4">
                                        
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Total Artigos</h4>
                                        <div class="mt-2 text-4xl font-bold text-gray-900 dark:text-white">
                                            {{ $stats['total_orders'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue -->
                        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-purple-500 rounded-lg p-4">
                                        
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Revenue</h4>
                                        <div class="mt-2 text-4xl font-bold text-gray-900 dark:text-white">
                                            €{{ number_format($stats['total_revenue'], 2) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coluna Direita - Recent Artigos -->
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl h-fit"> <!-- Altura automática -->
                        <div class="p-6">
                            <h4 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Recent Artigos</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-5 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Artigo ID</th>
                                            <th class="px-5 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                                            <th class="px-5 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                            <th class="px-5 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                            <th class="px-5 py-4 text-left text-sm font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($recent_orders as $artigo)
                                            <tr>
                                                <td class="px-5 py-4 whitespace-nowrap text-base text-gray-900 dark:text-white">
                                                    #{{ $artigo->id }}
                                                </td>
                                                <td class="px-5 py-4 whitespace-nowrap text-base text-gray-900 dark:text-white">
                                                    {{ $artigo->user->name }}
                                                </td>
                                                <td class="px-5 py-4 whitespace-nowrap">
                                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-lg
                                                        {{ $artigo->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                                           ($artigo->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                        {{ ucfirst($artigo->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-5 py-4 whitespace-nowrap text-base text-gray-900 dark:text-white">
                                                    €{{ number_format($artigo->total_amount, 2) }}
                                                </td>
                                                <td class="px-5 py-4 whitespace-nowrap text-base text-gray-900 dark:text-white">
                                                    {{ $artigo->created_at->format('d/m/Y H:i') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-5 py-4 text-center text-gray-500 dark:text-gray-400 text-lg">
                                                    No artigos found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-kaira-layout>