<x-app-layout>
    <x-slot name="header">
        <h2 class="dashboard__header">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="dashboard__section">
        <div class="dashboard__container">
            <div class="dashboard__stats">
                <!-- Gestión de Productos -->
                <div class="dashboard__stat">
                    <div class="dashboard__stat-content">
                        <h3 class="dashboard__stat-title">Productos</h3>
                        <p class="dashboard__stat-desc">Gestiona el catálogo de productos de la tienda.</p>
                        <a href="{{ route('admin.products.index') }}"
                            class="dashboard__stat-link dashboard__stat-link--blue">
                            Administrar Productos
                        </a>
                    </div>
                </div>

                <!-- Gestión de Categorías -->
                <div class="dashboard__stat">
                    <div class="dashboard__stat-content">
                        <h3 class="dashboard__stat-title">Categorías</h3>
                        <p class="dashboard__stat-desc">Organiza tus productos en categorías.</p>
                        <a href="{{ route('admin.categories.index') }}"
                            class="dashboard__stat-link dashboard__stat-link--green">
                            Administrar Categorías
                        </a>
                    </div>
                </div>

                <!-- Gestión de Subcategorías -->
                <div class="dashboard__stat">
                    <div class="dashboard__stat-content">
                        <h3 class="dashboard__stat-title">Subcategorías</h3>
                        <p class="dashboard__stat-desc">Gestiona las subcategorías asociadas a cada categoría.</p>
                        <a href="{{ route('admin.subcategories.index') }}"
                            class="dashboard__stat-link dashboard__stat-link--yellow">
                            Administrar Subcategorías
                        </a>
                    </div>
                </div>

                <!-- Gestión de Pedidos -->
                <div class="dashboard__stat">
                    <div class="dashboard__stat-content">
                        <h3 class="dashboard__stat-title">Pedidos</h3>
                        <p class="dashboard__stat-desc">Gestiona los pedidos de tus clientes.</p>
                        <a href="{{ route('admin.orders.index') }}"
                            class="dashboard__stat-link dashboard__stat-link--purple">
                            Administrar Pedidos
                        </a>
                    </div>
                </div>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="dashboard__stats-grid">
                <div class="dashboard__table">
                    <div class="dashboard__stat">
                        <div class="dashboard__stat-icon dashboard__stat-icon--blue">
                            <svg class="dashboard__table-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <div class="dashboard__stat-content">
                            <dl>
                                <dt class="dashboard__table-title">Ingresos Totales</dt>
                                <dd class="dashboard__table-desc">{{ number_format($totalRevenue ?? 0, 2) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="dashboard__table">
                    <div class="dashboard__stat">
                        <div class="dashboard__stat-icon dashboard__stat-icon--green">
                            <svg class="dashboard__table-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z" />
                            </svg>
                        </div>
                        <div class="dashboard__stat-content">
                            <dl>
                                <dt class="dashboard__table-title">Tasa de Conversión</dt>
                                <dd class="dashboard__table-desc">{{ $conversionRate !== null ? $conversionRate . '%' : 'N/D' }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="dashboard__table">
                    <div class="dashboard__stat">
                        <div class="dashboard__stat-icon dashboard__stat-icon--red">
                            <svg class="dashboard__table-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div class="dashboard__stat-content">
                            <dl>
                                <dt class="dashboard__table-title">Tasa de Abandono Carrito</dt>
                                <dd class="dashboard__table-desc">{{ $cartAbandonmentRate !== null ? $cartAbandonmentRate . '%' : 'N/D' }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ventas por producto (top 10) -->
            <div class="dashboard__table-container">
                <div class="dashboard__table-header">
                    <h3 class="dashboard__table-title">Ventas por Producto</h3>
                    <ul class="dashboard__table-list">
                        @forelse($salesByProduct as $item)
                            <li class="dashboard__table-row">
                                <span class="dashboard__table-cell">{{ $item->product ? $item->product->name : 'Producto #' . $item->product_id }}</span>
                                <span class="dashboard__table-desc">{{ $item->total }}</span>
                            </li>
                        @empty
                            <li>No hay datos.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Ventas por Región -->
            <div class="dashboard__table-container">
                <div class="dashboard__table-header">
                    <h3 class="dashboard__table-title">Ventas por Región</h3>
                    <ul class="dashboard__table-list">
                        @forelse($salesByRegion as $region)
                            <li class="dashboard__table-row">
                                <span class="dashboard__table-cell">{{ $region->region ?? 'Sin región' }}</span>
                                <span class="dashboard__table-desc">{{ $region->total }}</span>
                            </li>
                        @empty
                            <li>No hay datos.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- MÉTRICAS DE MARKETING (GOOGLE ANALYTICS) -->
        <div class="dashboard__section">
            <h2 class="dashboard__title">Métricas de Marketing</h2>
            <div class="dashboard__stats">
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__table-title">Tráfico del sitio web (últimos 30 días)</div>
                        <div class="dashboard__table-desc">
                            @if($trafficSummary !== null)
                                {{ number_format($trafficSummary) }} sesiones
                            @else
                                <span class="dashboard__stat-icon--blue-fill">Conecta Google Analytics para ver esta métrica</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__table-title">Fuentes de tráfico (últimos 30 días)</div>
                        @if($trafficSources !== null)
                            <ul class="dashboard__table-list">
                                @foreach($trafficSources as $source => $count)
                                    <li class="dashboard__table-row">
                                        <span>{{ $source }}</span>
                                        <span class="dashboard__table-desc">{{ number_format($count) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="dashboard__stat-icon--blue-fill">Conecta Google Analytics para ver esta métrica</span>
                        @endif
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__table-title">Tasa de Clics (CTR)</div>
                        <div class="dashboard__table-desc">
                            @if($ctr !== null)
                                {{ $ctr }}%
                            @else
                                <span class="dashboard__stat-icon--blue-fill">No disponible o sin datos</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FILTROS Y PERSONALIZACIÓN -->
        <div class="dashboard__section">
            <div class="dashboard__filter-container">
                <button id="toggleDarkMode" type="button" class="dashboard__filter-button">Modo Oscuro</button>
                <form class="dashboard__filter-form" method="GET" action="">
                    <label for="dateRange" class="dashboard__filter-label">Rango de fechas:</label>
                    <select id="dateRange" name="dateRange" class="dashboard__filter-select">
                        <option value="7">Últimos 7 días</option>
                        <option value="30" selected>Últimos 30 días</option>
                        <option value="90">Últimos 90 días</option>
                    </select>
                    <label for="deviceFilter" class="dashboard__filter-label">Dispositivo:</label>
                    <select id="deviceFilter" name="deviceFilter" class="dashboard__filter-select">
                        <option value="all">Todos</option>
                        @if($devices)
                            @foreach(array_keys($devices) as $device)
                                <option value="{{ $device }}">{{ ucfirst($device) }}</option>
                            @endforeach
                        @endif
                    </select>
                    <button type="submit" class="dashboard__filter-button">Aplicar</button>
                </form>
            </div>

        <!-- MÉTRICAS DE RENDIMIENTO DEL SITIO WEB -->
        <div class="dashboard__section--performance" data-metric-section="performance">
            <h2 class="dashboard__title dashboard__section-title">Métricas de Rendimiento del Sitio Web</h2>
            <div class="dashboard__stats">
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__subtitle">Velocidad de carga promedio</div>
                        <canvas id="chartPageLoad" height="80" data-chart-pageload="{{ $averagePageLoadTime ?? 0 }}"></canvas>
                        <canvas id="trendPageLoad" height="60" class="dashboard__stat-label"></canvas>
                        <div class="dashboard__highlight-lg">{{ $averagePageLoadTime ? number_format($averagePageLoadTime, 2) . ' s' : 'N/D' }}</div>
                        <table class="dashboard__table-full dashboard__table-sm">
                            <tr><td class="dashboard__table-strong">Valor actual</td><td>{{ $averagePageLoadTime ? number_format($averagePageLoadTime, 2).' s' : 'N/D' }}</td></tr>
                        </table>
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__subtitle">Tasa de rebote</div>
                        <canvas id="chartBounceRate" height="80" data-chart-bouncerate="{{ $bounceRate ?? 0 }}"></canvas>
                        <canvas id="trendBounceRate" height="60" class="dashboard__stat-label"></canvas>
                        <div class="dashboard__highlight-lg">{{ $bounceRate ? number_format($bounceRate, 2) . ' %' : 'N/D' }}</div>
                        <table class="dashboard__table-full dashboard__table-sm">
                            <tr><td class="dashboard__table-strong">Valor actual</td><td>{{ $bounceRate ? number_format($bounceRate, 2).' %' : 'N/D' }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="dashboard__stats">
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__subtitle">Tiempo promedio en el sitio</div>
                        <div class="dashboard__highlight-lg">
                            @if($averageSessionDuration)
                                @php
                                    $minutes = floor($averageSessionDuration / 60);
                                    $seconds = $averageSessionDuration % 60;
                                @endphp
                                {{ $minutes }}m {{ $seconds }}s
                            @else
                                N/D
                            @endif
                        </div>
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__subtitle">Dispositivos</div>
                        <script>
                            window.devicesData = @json($devices);
                        </script>
                        <canvas id="pieDevices" height="120" class="dashboard__stat-desc"></canvas>
                        <!-- Aquí puedes guardar preferencias de usuario y actualizar los gráficos con AJAX -->
                        <ul class="dashboard__table-list">
                            @if($devices)
                                @foreach($devices as $device => $count)
                                    <li class="flex dashboard__table-row--between dashboard__table-item">
                                        <span>{{ ucfirst($device) }}</span>
                                        <span class="dashboard__table-strong">{{ $count }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li>No hay datos.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- MÉTRICAS DE INVENTARIO -->
        <div class="dashboard__section--performance" data-metric-section="inventory">
            <h2 class="dashboard__title dashboard__section-title">Métricas de Inventario</h2>
            <div class="dashboard__stats">
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__subtitle">Niveles de Stock</div>
                        <ul class="dashboard__table-list">
                            @forelse($stockLevels as $product)
                                <li class="flex dashboard__table-row--between dashboard__table-item">
                                    <span>{{ $product->name }}</span>
                                    <span class="dashboard__table-strong">{{ $product->stock }}</span>
                                </li>
                            @empty
                                <li>No hay productos.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__subtitle">Unidades Vendidas</div>
                        <ul class="dashboard__table-list">
                            @forelse($unitsSold as $item)
                                <li class="flex dashboard__table-row--between dashboard__table-item">
                                    <span>{{ $item->product->name ?? 'Producto #' . $item->product_id }}</span>
                                    <span class="dashboard__table-strong">{{ $item->total_sold }}</span>
                                </li>
                            @empty
                                <li>No hay ventas.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="dashboard__stats">
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__subtitle">Productos Más Vendidos (Top 10)</div>
                        <ul class="dashboard__table-list">
                            @forelse($topSellingProducts as $item)
                                <li class="flex dashboard__table-row--between dashboard__table-item">
                                    <span>{{ $item->product->name ?? 'Producto #' . $item->product_id }}</span>
                                    <span class="dashboard__table-strong">{{ $item->total_sold }}</span>
                                </li>
                            @empty
                                <li>No hay datos.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__subtitle">Productos de Bajo Stock (≤ 5 unidades)</div>
                        <ul class="dashboard__table-list">
                            @forelse($lowStockProducts as $product)
                                <li class="flex dashboard__table-row--between dashboard__table-item">
                                    <span>{{ $product->name }}</span>
                                    <span class="dashboard__table-strong text-red-600">{{ $product->stock }}</span>
                                </li>
                            @empty
                                <li>No hay productos en bajo stock.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- MÉTRICAS DE CLIENTES -->
        <div class="dashboard__section--performance" data-metric-section="clients">
            <h2 class="dashboard__title dashboard__section-title">Métricas de Clientes</h2>
            <div class="dashboard__stats">
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__table-strong text-gray-700">Total de Clientes</div>
                        <div class="dashboard__highlight">{{ $totalCustomers }}</div>
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__table-strong text-gray-700">Nuevos Clientes (últimos 30 días)</div>
                        <div class="dashboard__highlight">{{ $newCustomers }}</div>
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__table-strong text-gray-700">Clientes Recurrentes</div>
                        <div class="dashboard__highlight">{{ $recurrentCustomers }}</div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__subtitle">Demografía por Ciudad (Top 5)</div>
                        <ul class="dashboard__table-list">
                            @forelse($demographicsByCity as $city)
                                <li class="flex dashboard__table-row--between dashboard__table-item">
                                    <span>{{ $city->city ?? 'Sin ciudad' }}</span>
                                    <span class="dashboard__table-strong">{{ $city->total }}</span>
                                </li>
                            @empty
                                <li>No hay datos.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__subtitle">Demografía por Estado (Top 5)</div>
                        <ul class="dashboard__table-list">
                            @forelse($demographicsByState as $state)
                                <li class="flex dashboard__table-row--between dashboard__table-item">
                                    <span>{{ $state->state ?? 'Sin estado' }}</span>
                                    <span class="dashboard__table-strong">{{ $state->total }}</span>
                                </li>
                            @empty
                                <li>No hay datos.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__table-strong text-gray-700">Valor de Vida del Cliente (CLTV)</div>
                        <div class="dashboard__highlight">${{ number_format($customerLifetimeValue, 2) }}</div>
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__table-strong text-gray-700">Tasa de Retención</div>
                        <div class="dashboard__highlight">{{ $retentionRate !== null ? $retentionRate.'%' : 'N/D' }}</div>
                    </div>
                </div>
                <div class="dashboard__table-container">
                    <div class="dashboard__table-content">
                        <div class="dashboard__table-strong text-gray-700">Tasa de Adquisición</div>
                        <div class="dashboard__highlight">
                            {{ $acquisitionRate !== null ? $acquisitionRate.'%' : 'N/D' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    document.getElementById('toggleDarkMode').onclick = function() {
        document.documentElement.classList.toggle('dark');
        // For Chart.js, update colors
        if(document.documentElement.classList.contains('dark')) {
            document.documentElement.style.setProperty('--chart-text', '#f3f4f6');
        } else {
            document.documentElement.style.setProperty('--chart-text', '#1e293b');
        }
    };
</script>
</x-app-layout>
