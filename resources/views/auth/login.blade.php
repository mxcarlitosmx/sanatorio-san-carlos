<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sanatorio San Carlos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        /* REGLA DE ORO ANTI-DESBORDAMIENTOS */
        *, *::before, *::after {
            box-sizing: border-box !important;
        }

        /* DEFINICIÓN DE VARIABLES GLOBALES */
        :root {
            --bg-page-light: #ffffff; /* Blanco puro arriba */
            --bg-page-celeste: #dbeafe; /* Celeste muy suave difuminado abajo */
            --card-blue-top: #3a9edb; /* Azul claro para la tarjeta */
            --card-blue-bottom: #164ca7; /* Azul oscuro para la tarjeta */
            --text-white: #ffffff;
        }

        /* CONFIGURACIÓN BASE: FONDO CLARO PARA RESALTAR EL LOGO */
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

        /* ESTRUCTURA FLEXBOX: Separa el logo de la tarjeta central */
        .page-wrapper {
            display: flex;
            flex-direction: column;
            flex: 1;
            width: 100%;
        }

        /* LOGO HEADER: Toma su espacio natural arriba */
        .logo-header {
            padding: 20px 30px 0 30px;
            width: 100%;
            z-index: 10;
        }
        
        .logo-header img {
            height: 130px; 
            width: auto;
            max-width: 100%;
            object-fit: contain;
            transition: all 0.3s ease;
        }

        /* CONTENEDOR PRINCIPAL: Centra la tarjeta */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center; 
            justify-content: center; 
            width: 100%;
            padding: 10px 20px 40px 20px; 
        }

        /* TARJETA ESTILO PILL (Recupera su color azul para destacar sobre el fondo claro) */
        .login-card-futuristic {
            background: linear-gradient(180deg, var(--card-blue-top) 0%, var(--card-blue-bottom) 100%);
            border-radius: 40px; 
            box-shadow: 0 25px 50px rgba(22, 76, 167, 0.3); /* Sombra azulada sutil */
            width: 100%;
            max-width: 420px; 
            padding: 45px 35px;
            z-index: 5;
        }

        .welcome-title-white {
            color: var(--text-white);
            font-size: 1.4rem;
            font-weight: 400;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 35px;
            text-align: center;
        }

        /* INPUTS OVALADOS */
        .input-pill-group {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }

        .input-pill-group .sanatorio-input-pill {
            background: rgba(255, 255, 255, 0.2); 
            border: 2px solid rgba(255, 255, 255, 0.8); 
            border-radius: 50px; 
            padding: 14px 45px; 
            color: var(--text-white);
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .input-pill-group .sanatorio-input-pill::placeholder {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .input-pill-group .sanatorio-input-pill:focus {
            background: rgba(255, 255, 255, 0.3);
            border-color: #ffffff;
            box-shadow: 0 0 12px rgba(255, 255, 255, 0.4);
            outline: none;
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

        /* ENLACE Y BOTÓN */
        .sanatorio-link-white {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.2s;
        }
        
        .sanatorio-link-white:hover {
            color: var(--text-white);
            text-decoration: underline;
        }

        .btn-pill-dark {
            background-color: #0b1a30; 
            color: var(--text-white);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px; 
            font-weight: bold;
            padding: 14px 0;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            width: 80%; 
            margin: 30px auto 0 auto;
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

        /* ZONA DE REGISTRO */
        .register-section {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .register-text {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.8rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .register-link {
            color: var(--text-white);
            font-size: 0.95rem;
            font-weight: bold;
            text-decoration: none;
            border-bottom: 2px solid rgba(255, 255, 255, 0.5);
            padding-bottom: 2px;
            transition: all 0.2s ease;
        }

        .register-link:hover {
            border-bottom-color: var(--text-white);
        }

        /* RESPONSIVIDAD PARA TABLETS Y MÓVILES */
        @media (max-width: 991px) {
            .logo-header {
                text-align: center;
                padding: 20px 20px 0 20px;
            }
            .logo-header img {
                height: 100px;
            }
            .main-content {
                padding: 20px;
            }
            .login-card-futuristic {
                padding: 35px 25px;
            }
        }
    </style>
</head>
<body>

    <div class="page-wrapper">
        <header class="logo-header">
            <img src="{{ asset('img/logoS.png') }}" alt="Sanatorio San Carlos">
        </header>

        <main class="main-content">
            <div class="login-card-futuristic animate__animated animate__fadeIn">
                
                <h3 class="welcome-title-white">Bienvenida (o)</h3>

                <form action="{{ url('/login') }}" method="POST">
                    @csrf 

                    <div class="input-pill-group">
                        <i class="fa-regular fa-user icon-left"></i>
                        <input type="text" 
                               name="login_input" 
                               class="sanatorio-input-pill" 
                               placeholder="Usuario o No. Empleado" 
                               required>
                    </div>

                    <div class="input-pill-group">
                        <i class="fa-solid fa-lock icon-left"></i>
                        <input type="password" 
                               name="password" 
                               id="password-field"
                               class="sanatorio-input-pill" 
                               placeholder="Contraseña" 
                               required>
                        <i class="fa-regular fa-eye-slash icon-right-toggle" onclick="togglePasswordVisibility()"></i>
                    </div>

                    <div class="text-start px-2">
                        <a href="#" class="sanatorio-link-white">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="btn btn-pill-dark">Iniciar sesión</button>

                    <div class="register-section">
                        <p class="register-text">¿Eres nuevo en el sanatorio?</p>
                        <a href="{{ url('/register') }}" class="register-link">Regístrate aquí</a>
                    </div>

                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password-field');
            const toggleIcon = document.querySelector('.icon-right-toggle');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>