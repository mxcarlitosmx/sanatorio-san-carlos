<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sanatorio San Carlos</title>
    <!-- ENLACE DE BOOTSTRAP CORREGIDO (Ya no da 404) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        *, *::before, *::after { box-sizing: border-box !important; }

        :root {
            --bg-page-light: #ffffff;
            --bg-page-celeste: #dbeafe;
            --card-blue-top: #3a9edb;
            --card-blue-bottom: #164ca7;
            --text-white: #ffffff;
        }

        html, body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--bg-page-light) 0%, var(--bg-page-celeste) 100%);
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1; 
            display: flex;
            align-items: center; 
            justify-content: center;
            padding: 20px;
        }

        .register-card-futuristic {
            background: linear-gradient(180deg, var(--card-blue-top) 0%, var(--card-blue-bottom) 100%);
            border-radius: 40px; 
            box-shadow: 0 25px 50px rgba(22, 76, 167, 0.3); 
            width: 100%;
            max-width: 850px; 
            padding: 45px 50px; 
            border: none;
        }

        .hospital-title {
            color: var(--text-white);
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .welcome-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            text-align: center;
            font-weight: 400;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 35px; 
        }

        /* SISTEMA DEFINITIVO DE CONTENEDORES POR FILA */
        .sanatorio-row-split {
            display: flex;
            flex-direction: row;
            gap: 16px;
            width: 100%;
            margin-bottom: 14px;
        }

        .sanatorio-col {
            flex: 1;
            min-width: 0; /* Obliga al input a encogerse si el texto es muy largo */
        }

        .input-pill-group {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .input-pill-group .icon-left {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-white);
            font-size: 1.1rem;
            z-index: 5;
        }

        .input-pill-group .icon-right-toggle {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            z-index: 5;
            font-size: 1.1rem;
        }

        .sanatorio-input-pill {
            background: rgba(255, 255, 255, 0.15); 
            border: 2px solid rgba(255, 255, 255, 0.8); 
            border-radius: 50px; 
            padding: 13px 20px 13px 45px; 
            color: var(--text-white);
            font-size: 0.95rem;
            width: 100%;
            height: 100%;
            transition: all 0.3s ease;
        }

        .sanatorio-input-pill.has-toggle {
            padding-right: 45px;
        }

        .sanatorio-input-pill::placeholder {
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.82rem;
        }

        .sanatorio-input-pill:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: #ffffff;
            box-shadow: 0 0 12px rgba(255, 255, 255, 0.4);
            outline: none;
        }

        select.sanatorio-input-pill option {
            background-color: #164ca7;
            color: white;
        }

        select.sanatorio-input-pill {
            appearance: none; 
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 10px 8px;
            cursor: pointer;
        }

        .btn-pill-dark {
            background-color: #0b1a30; 
            color: var(--text-white);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px; 
            font-weight: bold;
            padding: 15px 0;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            width: 60%; 
            margin: 35px auto 0 auto;
            display: block;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); 
        }
        
        .btn-pill-dark:hover {
            background-color: #051020;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.4);
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .register-section {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .register-link {
            color: var(--text-white);
            font-size: 0.9rem;
            font-weight: bold;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.5);
            padding-bottom: 2px;
            transition: all 0.2s ease;
        }

        .register-link:hover { border-bottom-color: var(--text-white); }

        /* RESPONSIVIDAD REAL PARA CELULARES */
        @media (max-width: 768px) {
            .register-card-futuristic { padding: 35px 25px; border-radius: 30px; }
            .btn-pill-dark { width: 100%; }
            .sanatorio-row-split { flex-direction: column; gap: 12px; margin-bottom: 12px; }
        }
    </style>
</head>
<body>

    <main class="main-content">
        <div class="register-card-futuristic animate__animated animate__fadeIn">
            
            <h1 class="hospital-title"><i class="fa-solid fa-staff-snake me-2"></i> Sanatorio San Carlos</h1>
            <h3 class="welcome-subtitle">Registro de Paciente</h3>

            <form action="{{ url('/register') }}" method="POST">
                @csrf 
                <input type="hidden" name="role" value="patient">

                <!-- FILA 1: [ Nombre(s) ] -->
                <div class="sanatorio-row-split">
                    <div class="sanatorio-col">
                        <div class="input-pill-group">
                            <i class="fa-regular fa-user icon-left"></i>
                            <input type="text" name="name" class="sanatorio-input-pill" placeholder="Nombre(s)" required>
                        </div>
                    </div>
                </div>

                <!-- FILA 2: [ Apellido Pat ] [ Apellido Mat ] -->
                <div class="sanatorio-row-split">
                    <div class="sanatorio-col">
                        <div class="input-pill-group">
                            <i class="fa-solid fa-users icon-left"></i>
                            <input type="text" name="first_name" class="sanatorio-input-pill" placeholder="Apellido Paterno" required>
                        </div>
                    </div>
                    <div class="sanatorio-col">
                        <div class="input-pill-group">
                            <i class="fa-solid fa-users icon-left"></i>
                            <input type="text" name="second_name" class="sanatorio-input-pill" placeholder="Apellido Materno">
                        </div>
                    </div>
                </div>

                <!-- FILA 3: [ CURP ] -->
                <div class="sanatorio-row-split">
                    <div class="sanatorio-col">
                        <div class="input-pill-group">
                            <i class="fa-solid fa-fingerprint icon-left"></i>
                            <input type="text" name="curp" class="sanatorio-input-pill" placeholder="CURP (18 Caracteres)" minlength="18" maxlength="18" pattern="[A-Za-z0-9]{18}" required style="text-transform: uppercase;">
                        </div>
                    </div>
                </div>

                <!-- FILA 4: [ Género ] [ Fecha de Nac. ] -->
                <div class="sanatorio-row-split">
                    <div class="sanatorio-col">
                        <div class="input-pill-group">
                            <i class="fa-solid fa-venus-mars icon-left"></i>
                            <select name="genere" class="sanatorio-input-pill" required style="color: rgba(255,255,255,0.8);" onchange="this.style.color='#ffffff';">
                                <option value="" disabled selected hidden>Selecciona tu Género</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="sanatorio-col">
                        <div class="input-pill-group">
                            <i class="fa-solid fa-calendar-days icon-left"></i>
                            <input type="text" name="birth_day" class="sanatorio-input-pill" placeholder="Fecha de Nacimiento" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" required>
                        </div>
                    </div>
                </div>

                <!-- FILA 5: [ Correo Electrónico ] [ Teléfono ] -->
                <div class="sanatorio-row-split">
                    <div class="sanatorio-col">
                        <div class="input-pill-group">
                            <i class="fa-solid fa-envelope icon-left"></i>
                            <input type="email" name="email" class="sanatorio-input-pill" placeholder="Correo Electrónico" required>
                        </div>
                    </div>
                    <div class="sanatorio-col">
                        <div class="input-pill-group">
                            <i class="fa-solid fa-mobile-screen icon-left"></i>
                            <input type="tel" name="phone" class="sanatorio-input-pill" placeholder="Teléfono (10 dígitos)" pattern="[0-9]{10}" required>
                        </div>
                    </div>
                </div>

                <!-- FILA 6: [ Contraseña ] [ Confirmar Contraseña ] -->
                <div class="sanatorio-row-split">
                    <div class="sanatorio-col">
                        <div class="input-pill-group">
                            <i class="fa-solid fa-lock icon-left"></i>
                            <input type="password" name="password" id="password" class="sanatorio-input-pill has-toggle" placeholder="Contraseña (Mín. 8)" minlength="8" required>
                            <i class="fa-regular fa-eye-slash icon-right-toggle" onclick="toggleVisibility('password', this)"></i>
                        </div>
                    </div>
                    <div class="sanatorio-col">
                        <div class="input-pill-group">
                            <i class="fa-solid fa-check-double icon-left"></i>
                            <input type="password" name="password_confirmation" id="confirm_password" class="sanatorio-input-pill has-toggle" placeholder="Confirmar Contraseña" minlength="8" required>
                            <i class="fa-regular fa-eye-slash icon-right-toggle" onclick="toggleVisibility('confirm_password', this)"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-pill-dark">Crear Cuenta</button>

                <div class="register-section">
                    <a href="{{ url('/login') }}" class="register-link">¿Ya tienes cuenta? Inicia sesión</a>
                </div>

            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const password = document.getElementById("password");
        const confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
          if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Las contraseñas no coinciden");
          } else {
            confirm_password.setCustomValidity('');
          }
        }
        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

        function toggleVisibility(inputId, iconElement) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            } else {
                input.type = 'password';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            }
        }
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                title: '¡Registro Exitoso!',
                text: '{{ session("success") }}',
                icon: 'success',
                confirmButtonColor: '#164ca7',
                confirmButtonText: 'Ir a Iniciar Sesión',
                background: '#ffffff',
                color: '#1e293b'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/login') }}";
                }
            });
        </script>
    @endif

</body>
</html>