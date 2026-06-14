<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surtir Receta - Sanatorio San Carlos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        *, *::before, *::after { box-sizing: border-box !important; }
        :root { --bg-page-light: #f8fafc; --bg-page-cyan: #cffafe; --card-cyan-top: #0891b2; --card-cyan-bottom: #164e63; --card-blue-top: #0284c7; --card-blue-bottom: #0369a1; --text-dark: #0f172a; --text-muted: #64748b; --text-white: #ffffff; }
        body { background: linear-gradient(135deg, var(--bg-page-light) 0%, var(--bg-page-cyan) 100%); background-attachment: fixed; font-family: 'Open Sans', sans-serif; min-height: 100vh; color: var(--text-dark); margin: 0; padding-bottom: 50px; }

        .sanatorio-header { background: linear-gradient(90deg, var(--card-blue-bottom) 0%, var(--card-blue-top) 100%); box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; padding: 15px 0; }
        .header-container { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 0 30px; }
        .header-box { flex: 1; display: flex; align-items: center; }
        .box-left { justify-content: flex-start; } .box-center { justify-content: center; } .box-right { justify-content: flex-end; }
        .header-logo { height: 70px; filter: brightness(0) invert(1); }
        .header-title { color: var(--text-white); font-weight: 800; font-size: 1.8rem; margin: 0; }
        .btn-logout { background: transparent; border: 2px solid rgba(255, 255, 255, 0.8); color: var(--text-white); border-radius: 50px; padding: 8px 25px; font-weight: 700; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; text-decoration: none;}
        .btn-logout:hover { background: #ffffff; color: var(--card-blue-bottom); }

        .dashboard-container { max-width: 1000px; margin: 0 auto; padding-top: 40px; }
        .dashboard-header-title { color: var(--card-cyan-bottom); font-weight: 800; font-size: 2rem; margin-bottom: 5px; }
        
        .dashboard-card { background: #ffffff; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; margin-bottom: 30px; }
        .card-header-custom { background: var(--card-cyan-top); color: var(--text-white); padding: 18px 25px; font-weight: 800; font-size: 1.1rem; letter-spacing: 1px; text-transform: uppercase; border-bottom: 4px solid var(--card-cyan-bottom); }
        
        .section-title { color: var(--card-cyan-bottom); font-size: 1.15rem; font-weight: 800; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-top: 10px; }
        
        .info-pill { background: #f1f5f9; border-radius: 12px; padding: 15px 20px; margin-bottom: 20px; border-left: 4px solid var(--card-cyan-top); }
        .info-label { font-size: 0.75rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 3px; }
        .info-value { font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin: 0; }

        .table-pharma th { background: #f1f5f9; color: var(--text-muted); font-weight: 800; text-transform: uppercase; font-size: 0.85rem; padding: 18px; border-bottom: 2px solid #e2e8f0; }
        .table-pharma td { padding: 18px; border-bottom: 1px solid #f1f5f9; font-size: 0.95rem; font-weight: 600; vertical-align: middle; color: #334155; }
        
        .sanatorio-input { background: #ffffff; border: 2px solid #cbd5e1; border-radius: 8px; padding: 10px 15px; color: #334155; font-size: 1rem; font-weight: 700; width: 100px; text-align: center; transition: all 0.3s ease;}
        .sanatorio-input:focus { border-color: var(--card-cyan-top); box-shadow: 0 0 0 4px rgba(8, 145, 178, 0.15); outline: none; }

        .btn-confirm { background-color: #0f172a; color: var(--text-white); border-radius: 12px; padding: 16px 0; font-weight: 800; font-size: 1.05rem; text-transform: uppercase; letter-spacing: 1.5px; width: 100%; border: none; transition: all 0.3s ease; margin-top: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-confirm:hover { background-color: var(--card-cyan-top); transform: translateY(-2px); box-shadow: 0 8px 15px rgba(8, 145, 178, 0.3); color: white;}
    </style>
</head>
<body>

    <header class="sanatorio-header">
        <div class="header-container">
            <div class="header-box box-left">
                <img src="{{ asset('img/logoS.png') }}" alt="Sanatorio San Carlos" class="header-logo">
            </div>
            <div class="header-box box-center">
                <h1 class="header-title">Farmacia: Mostrador</h1>
            </div>
            <div class="header-box box-right">
                <a href="{{ route('pharmacist.dashboard') }}" class="btn-logout"><i class="fa-solid fa-arrow-left me-1"></i> Cancelar</a>
            </div>
        </div>
    </header>

    <div class="container px-4 dashboard-container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="dashboard-header-title">Punto de Venta</h2>
                <p class="text-muted" style="font-size: 1.1rem;">Verificación de receta y cobro de medicamentos.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="dashboard-card">
                    <div class="card-header-custom">
                        <i class="fa-solid fa-file-prescription me-2"></i> Receta #REC-00{{ $prescription->id_prescription }}
                    </div>
                    <div class="p-4">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-pill">
                                    <div class="info-label">Paciente</div>
                                    <p class="info-value">{{ $prescription->consultation->appointment->patient->user->name ?? 'Paciente Desconocido' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-pill">
                                    <div class="info-label">Médico Tratante</div>
                                    <p class="info-value">Dr(a). {{ $prescription->consultation->doctor->user->name ?? 'Médico' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="section-title mt-4">Detalle de Medicamentos</div>
                        
                        <form action="{{ route('pharmacist.confirm_dispense', $prescription->id_prescription) }}" method="POST">
                            @csrf
                            
                            <div class="table-responsive mb-4">
                                <table class="table table-pharma mb-0">
                                    <thead>
                                        <tr>
                                            <th>Medicamento</th>
                                            <th>Indicaciones</th>
                                            <th>Recetado</th>
                                            <th>Precio Unitario</th>
                                            <th>Cantidad a Llevar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($items as $item)
                                            <tr>
                                                <td>
                                                    <span class="fw-bold" style="color: var(--card-cyan-top);">{{ $item->name }}</span><br>
                                                    <small class="text-muted">{{ $item->dosage }}</small>
                                                </td>
                                                <td>{{ $item->frequency }}</td>
                                                <td class="text-center fw-bold">{{ $item->quantity }} cajas</td>
                                                <td class="fw-bold">${{ number_format($item->price, 2) }}</td>
                                                <td>
                                                    <input type="number" 
                                                           name="items[{{ $item->id_medicine }}]" 
                                                           class="sanatorio-input" 
                                                           value="{{ min($item->quantity, $item->stock) }}" 
                                                           min="0" 
                                                           max="{{ $item->stock }}" 
                                                           required>
                                                    <div class="mt-1" style="font-size: 0.75rem; color: #64748b;">En stock: {{ $item->stock }}</div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-muted fw-bold">
                                                    Esta receta no tiene medicamentos asignados.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn-confirm">
                                <i class="fa-solid fa-cash-register me-2"></i> Confirmar Venta y Cobrar
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>