<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion | Gestion Projets GC</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: #f4f7fb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1f2937;
        }

        .login-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
        }

        /* ==============================
           PARTIE GAUCHE
        ============================== */

        .login-left {
            width: 50%;
            background: linear-gradient(
                135deg,
                #0f2f4f 0%,
                #174a73 50%,
                #1d658f 100%
            );

            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            width: 450px;
            height: 450px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 50%;
            top: -150px;
            left: -150px;
        }

        .login-left::after {
            content: "";
            position: absolute;
            width: 600px;
            height: 600px;
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 50%;
            bottom: -300px;
            right: -200px;
        }

        .brand-content {
            position: relative;
            z-index: 2;
            max-width: 500px;
            color: white;
        }

        .brand-icon {
            width: 75px;
            height: 75px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 32px;
            margin-bottom: 30px;
        }

        .brand-content h1 {
            font-size: 38px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 18px;
        }

        .brand-content p {
            font-size: 16px;
            line-height: 1.7;
            color: rgba(255,255,255,0.78);
            margin-bottom: 35px;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 14px;
            color: rgba(255,255,255,0.9);
        }

        .feature i {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: rgba(255,255,255,0.1);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 14px;
        }


        /* ==============================
           PARTIE DROITE
        ============================== */

        .login-right {
            width: 50%;
            background: #ffffff;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
        }

        .login-header {
            margin-bottom: 35px;
        }

        .login-header h2 {
            font-size: 30px;
            font-weight: 700;
            color: #172033;
            margin-bottom: 10px;
        }

        .login-header p {
            font-size: 14px;
            color: #6b7280;
        }


        /* ==============================
           FORMULAIRE
        ============================== */

        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);

            color: #9ca3af;
            font-size: 15px;

            pointer-events: none;
        }

        .form-input {
            width: 100%;
            height: 50px;

            border: 1px solid #d9dee7;
            border-radius: 9px;

            padding: 0 45px;

            font-size: 14px;
            color: #1f2937;

            background: #ffffff;

            outline: none;

            transition: all 0.2s ease;
        }

        .form-input:focus {
            border-color: #1d658f;
            box-shadow: 0 0 0 3px rgba(29,101,143,0.10);
        }

        .form-input::placeholder {
            color: #a5acb8;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);

            border: none;
            background: transparent;

            color: #9ca3af;

            cursor: pointer;
            font-size: 15px;
        }

        .password-toggle:hover {
            color: #1d658f;
        }


        /* ==============================
           OPTIONS
        ============================== */

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 25px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;

            font-size: 13px;
            color: #6b7280;

            cursor: pointer;
        }

        .remember input {
            width: 15px;
            height: 15px;
            accent-color: #1d658f;
        }

        .forgot-password {
            color: #1d658f;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }


        /* ==============================
           BOUTON
        ============================== */

        .login-button {
            width: 100%;
            height: 50px;

            border: none;
            border-radius: 9px;

            background: #1d658f;
            color: white;

            font-size: 15px;
            font-weight: 600;

            cursor: pointer;

            transition: all 0.2s ease;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .login-button:hover {
            background: #174f71;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(29,101,143,0.2);
        }

        .login-button:active {
            transform: translateY(0);
        }


        /* ==============================
           ERREUR
        ============================== */

        .alert-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;

            padding: 12px 14px;
            border-radius: 8px;

            font-size: 13px;
            margin-bottom: 20px;

            display: flex;
            align-items: center;
            gap: 10px;
        }

        .input-error {
            color: #be123c;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }


        /* ==============================
           FOOTER
        ============================== */

        .login-footer {
            text-align: center;
            margin-top: 30px;

            font-size: 12px;
            color: #9ca3af;
        }


        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 900px) {

            .login-left {
                display: none;
            }

            .login-right {
                width: 100%;
                min-height: 100vh;
                padding: 30px;
            }

            .login-card {
                max-width: 450px;
            }
        }

        @media (max-width: 480px) {

            .login-right {
                padding: 25px 20px;
            }

            .login-header h2 {
                font-size: 26px;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }

    </style>
</head>


<body>

<div class="login-wrapper">


    <!-- ==============================
         PARTIE GAUCHE
    ============================== -->

    <div class="login-left">

        <div class="brand-content">

            <div class="brand-icon">
                <i class="fa-solid fa-building"></i>
            </div>

            <h1>
                Gestion Projets GC
            </h1>

            <p>
                Plateforme de digitalisation et de gestion du workflow
                de l'entité Facility Management.
            </p>

            <div class="features">

                <div class="feature">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>
                        Suivi stratégique et analytique des projets
                    </span>
                </div>

                <div class="feature">
                    <i class="fa-solid fa-coins"></i>
                    <span>
                        Gestion budgétaire et suivi financier
                    </span>
                </div>

                <div class="feature">
                    <i class="fa-solid fa-list-check"></i>
                    <span>
                        Suivi des travaux et des plans d'action
                    </span>
                </div>

            </div>

        </div>

    </div>


    <!-- ==============================
         PARTIE DROITE
    ============================== -->

    <div class="login-right">

        <div class="login-card">


            <!-- En-tête -->

            <div class="login-header">

                <h2>
                    Bienvenue
                </h2>

                <p>
                    Connectez-vous à votre espace de travail
                </p>

            </div>


            <!-- Message d'erreur général -->

            @if ($errors->any())

                <div class="alert-error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        {{ $errors->first() }}
                    </span>

                </div>

            @endif


            <!-- Formulaire -->

            <form method="POST" action="{{ route('login.post') }}">

                @csrf


                <!-- Email -->

                <div class="form-group">

                    <label
                        for="email"
                        class="form-label"
                    >
                        Adresse email
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-envelope input-icon"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input"
                            placeholder="exemple@entreprise.com"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >

                    </div>

                    @error('email')

                        <span class="input-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <!-- Mot de passe -->

                <div class="form-group">

                    <label
                        for="password"
                        class="form-label"
                    >
                        Mot de passe
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-solid fa-lock input-icon"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input"
                            placeholder="Entrez votre mot de passe"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                        >
                            <i class="fa-solid fa-eye"></i>
                        </button>

                    </div>

                    @error('password')

                        <span class="input-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                <!-- Options -->

                <div class="form-options">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <span>
                            Se souvenir de moi
                        </span>

                    </label>

                    <a
                        href="{{ route('password.request') }}"
                        class="forgot-password"
                    >
                        Mot de passe oublié ?
                    </a>

                </div>


                <!-- Bouton -->

                <button
                    type="submit"
                    class="login-button"
                >

                    <span>
                        Se connecter
                    </span>

                    <i class="fa-solid fa-arrow-right"></i>

                </button>

            </form>


            <!-- Footer -->

            <div class="login-footer">

                © {{ date('Y') }} Gestion Projets GC.
                Tous droits réservés.

            </div>

        </div>

    </div>

</div>


<!-- ==============================
     JAVASCRIPT
============================== -->

<script>

    const togglePassword =
        document.getElementById('togglePassword');

    const passwordInput =
        document.getElementById('password');


    togglePassword.addEventListener('click', function () {

        const type =
            passwordInput.getAttribute('type') === 'password'
                ? 'text'
                : 'password';

        passwordInput.setAttribute('type', type);


        const icon =
            this.querySelector('i');


        if (type === 'password') {

            icon.classList.remove('fa-eye-slash');

            icon.classList.add('fa-eye');

        } else {

            icon.classList.remove('fa-eye');

            icon.classList.add('fa-eye-slash');

        }

    });

</script>

</body>

</html>