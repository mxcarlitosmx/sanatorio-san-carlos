<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Sanatorio San Carlos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        *, *::before, *::after { box-sizing: border-box !important; }
        :root { --bg-page-light: #f8fafc; --bg-page-cyan: #cffafe; --card-cyan-top: #0891b2; --card-cyan-bottom: #164e63; --card-blue-top: #0284c7; --card-blue-bottom: #0369a1; --text-dark: #0f172a; --text-muted: #64748b; --text-white: #ffffff; }
        body { background: linear-gradient(135deg, var(--bg-page-light) 0%, var(--bg-page-cyan) 100%); background-attachment: fixed; font-family: 'Open Sans', sans-serif; min-height: 100vh; color: var(--text-dark); margin: 0; padding-bottom: 50px; }

        /* ==================== CABECERA AZUL ==================== */
        .sanatorio-header { background: linear-gradient(90deg, var(--card-blue-bottom) 0%, var(--card-blue-top) 100%); box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; padding: 15px 0; }
        .header-container { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 0 30px; }
        .header-box { flex: 1; display: flex; align-items: center; }
        .box-left { justify-content: flex-start; } .box-center { justify-content: center; } .box-right { justify-content: flex-end; }
        .header-logo { height: 70px; filter: brightness(0) invert(1); }
        .header-title { color: var(--text-white); font-weight: 800; font-size: 1.8rem; margin: 0; }
        .btn-logout { background: transparent; border: 2px solid rgba(255, 255, 255, 0.8); color: var(--text-white); border-radius: 50px; padding: 8px 25px; font-weight: 700; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; text-decoration: none;}
        .btn-logout:hover { background: #ffffff; color: var(--card-blue-bottom); }

        /* ==================== CONTENEDOR Y TARJETAS ==================== */
        .dashboard-container { max-width: 1200px; margin: 0 auto; padding-top: 40px; }
        .dashboard-header-title { color: var(--card-cyan-bottom); font-weight: 800; font-size: 2rem; margin-bottom: 5px; }
        
        .dashboard-card { background: #ffffff; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; margin-bottom: 30px; }
        .card-header-custom { background: var(--card-cyan-top); color: var(--text-white); padding: 18px 25px; font-weight: 800; font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase; border-bottom: 4px solid var(--card-cyan-bottom); }
        
        /* ==================== DISEÑO MEJORADO DE FORMULARIO ==================== */
        .card-body-custom { padding: 35px; } /* Más espacio interno como en la recepción */
        
        .section-title { color: var(--card-cyan-bottom); font-size: 1.15rem; font-weight: 800; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-top: 10px; }
        .section-title.mt-custom { margin-top: 35px; }

        .form-label-custom { color: #475569; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 10px; display: block; }
        
        /* Inputs modernos sin bordes duros */
        .sanatorio-input { background-color: #f4f6f9; border: 2px solid transparent; border-radius: 12px; padding: 14px 20px; color: #334155; font-size: 1rem; font-weight: 600; width: 100%; transition: all 0.3s ease; }
        .sanatorio-input:focus { background-color: #ffffff; border-color: var(--card-cyan-top); box-shadow: 0 0 0 4px rgba(8, 145, 178, 0.15); outline: none; }

        .btn-confirm { background-color: #0f172a; color: var(--text-white); border-radius: 12px; padding: 16px 0; font-weight: 800; font-size: 1.05rem; text-transform: uppercase; letter-spacing: 1.5px; width: 100%; border: none; transition: all 0.3s ease; margin-top: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-confirm:hover { background-color: var(--card-cyan-top); transform: translateY(-2px); box-shadow: 0 8px 15px rgba(8, 145, 178, 0.3); color: white;}

        /* ==================== TABLA ==================== */
        .table-pharma th { background: #f1f5f9; color: var(--text-muted); font-weight: 800; text-transform: uppercase; font-size: 0.85rem; padding: 18px; border-bottom: 2px solid #e2e8f0; letter-spacing: 0.5px; }
        .table-pharma td { padding: 18px; border-bottom: 1px solid #f1f5f9; font-size: 0.95rem; font-weight: 600; vertical-align: middle; color: #334155; }
        
        .stock-badge { padding: 6px 14px; border-radius: 8px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .stock-good { background: #dcfce7; color: #15803d; }
        .stock-low { background: #fee2e2; color: #b91c1c; }
    </style>
</head>
<body>

    <header class="sanatorio-header">
        <div class="header-container">
            <div class="header-box box-left">
                <img src="{{ asset('img/logoS.png') }}" alt="Sanatorio San Carlos" class="header-logo">
            </div>
            <div class="header-box box-center">
                <h1 class="header-title">Farmacia: Almacén Central</h1>
            </div>
            <div class="header-box box-right">
                <a href="{{ route('pharmacist.dashboard') }}" class="btn-logout me-3"><i class="fa-solid fa-arrow-left me-1"></i> Mostrador</a>
                <form method="POST" action="{{ url('/logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn-logout border-0 bg-transparent text-white fw-bold"><i class="fa-solid fa-power-off"></i></button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid px-4 dashboard-container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="dashboard-header-title">Gestión de Catálogo</h2>
                <p class="text-muted" style="font-size: 1.1rem;">Registro de nuevos medicamentos y actualización de stock.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="dashboard-card h-100">
                    <div class="card-header-custom">
                        <i class="fa-solid fa-plus-circle me-2"></i> Nuevo Medicamento
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('pharmacist.store_medicine') }}" method="POST">
                            @csrf
                            
                            <div class="section-title">1. Identificación</div>
                            
                            <div class="mb-4">
                                <label class="form-label-custom">Nombre del Medicamento</label>
                                <input type="text" name="name" class="sanatorio-input" placeholder="Ej. Paracetamol" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-custom">Presentación (Gramaje/Cajas)</label>
                                <input type="text" name="dosage" class="sanatorio-input" placeholder="Ej. 500mg - 20 Tabletas" required>
                            </div>

                            <div class="section-title mt-custom">2. Valores Iniciales</div>

                            <div class="mb-4">
                                <label class="form-label-custom">Precio al Público ($)</label>
                                <input type="number" step="0.01" name="price" class="sanatorio-input" placeholder="0.00" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-custom">Stock Inicial (Cajas)</label>
                                <input type="number" name="stock" class="sanatorio-input" placeholder="Cantidad física" required>
                            </div>

                            <button type="submit" class="btn-confirm">
                                <i class="fa-solid fa-save me-2"></i> Guardar en Catálogo
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="dashboard-card h-100">
                    <div class="card-header-custom" style="background: #0f172a; border-bottom-color: #334155;">
                        <i class="fa-solid fa-boxes-stacked me-2"></i> Catálogo Actual
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-pharma mb-0">
                            <thead>
                                <tr>
                                    <th>Medicamento</th>
                                    <th>Presentación</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($medicines ?? [] as $medicine)
                                    <tr>
                                        <td class="fw-bold" style="color: var(--card-cyan-top);">{{ $medicine->name }}</td>
                                        <td class="text-muted">{{ $medicine->dosage }}</td>
                                        <td class="fw-bold">${{ number_format($medicine->price, 2) }}</td>
                                        <td>
                                            @if($medicine->stock > 5)
                                                <span class="stock-badge stock-good">{{ $medicine->stock }} Cajas</span>
                                            @else
                                                <span class="stock-badge stock-low">{{ $medicine->stock }} Cajas</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-dark fw-bold rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#updateModal{{ $medicine->id_medicine }}">
                                                <i class="fa-solid fa-arrows-rotate me-1"></i> Actualizar
                                            </button>

                                            <div class="modal fade" id="updateModal{{ $medicine->id_medicine }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content" style="border-radius: 16px; border: none;">
                                                        <div class="modal-header" style="background: var(--bg-page-light); border-bottom: 1px solid #e2e8f0;">
                                                            <h5 class="modal-title fw-bold" style="color: var(--card-cyan-bottom);">Actualizar {{ $medicine->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('pharmacist.update_medicine', $medicine->id_medicine) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body p-4">
                                                                <label class="form-label-custom">Ajustar Precio ($)</label>
                                                                <input type="number" step="0.01" name="price" class="sanatorio-input mb-4" value="{{ $medicine->price }}" required>
                                                                
                                                                <label class="form-label-custom">Sumar al Stock Existente</label>
                                                                <input type="number" name="add_stock" class="sanatorio-input mb-2" placeholder="¿Cuántas cajas nuevas llegaron?" value="0" required>
                                                                <small class="text-muted fw-bold">Stock actual: <span style="color: var(--card-cyan-top);">{{ $medicine->stock }} cajas</span>.</small>
                                                            </div>
                                                            <div class="modal-footer" style="border-top: none;">
                                                                <button type="submit" class="btn-confirm m-0">Guardar Cambios</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted fw-bold">
                                            Aún no hay medicamentos en el catálogo. Usa el formulario de la izquierda para comenzar.
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Operación Exitosa!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#0891b2',
                    background: '#ffffff',
                    borderRadius: '16px',
                    customClass: { popup: 'shadow-lg border-0' }
                });
            @endif
        });
    </script>
</body>
</html>