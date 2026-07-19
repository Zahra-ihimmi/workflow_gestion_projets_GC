<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Nouveau mot de passe | Gestion Projets GC
    </title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

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

            padding: 20px;
        }

        .reset-card {
            width: 100%;
            max-width: 450px;

            background: #ffffff;

            padding: 45px;

            border-radius: 15px;

            box-shadow:
                0 15px 40px
                rgba(15, 47, 79, 0.08);
        }

        .icon {
            width: 65px;
            height: 65px;

            margin: 0 auto 25px;

            border-radius: 15px;

            background: #eaf3f8;

            color: #1d658f;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 25px;
        }

        .header {
            text-align: center;

            margin-bottom: 30px;
        }

        .header h2 {
            color: #172033;

            font-size: 26px;

            margin-bottom: 10px;
        }

        .header p {
            color: #6b7280;

            font-size: 14px;

            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;

            font-size: 14px;

            font-weight: 600;

            color: #374151;

            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper > i {
            position: absolute;

            left: 15px;

            top: 50%;

            transform: translateY(-50%);

            color: #9ca3af;

            pointer-events: none;
        }

        input {
            width: 100%;

            height: 50px;

            border: 1px solid #d9dee7;

            border-radius: 9px;

            padding: 0 45px;

            font-size: 14px;

            outline: none;

            transition: all 0.2s ease;
        }

        input:focus {
            border-color: #1d658f;

            box-shadow:
                0 0 0 3px
                rgba(29,101,143,0.10);
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
        }

        .password-toggle:hover {
            color: #1d658f;
        }

        .error {
            color: #be123c;

            font-size: 12px;

            margin-top: 6px;
        }

        .alert {
            background: #fff1f2;

            border: 1px solid #fecdd3;

            color: #be123c;

            padding: 12px;

            border-radius: 8px;

            font-size: 13px;

            margin-bottom: 20px;
        }

        .button {
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
        }

        .button:hover {
            background: #174f71;

            transform: translateY(-1px);
        }

        .back {
            display: block;

            text-align: center;

            margin-top: 25px;

            color: #1d658f;

            text-decoration: none;

            font-size: 13px;

            font-weight: 600;
        }

        .back:hover {
            text-decoration: underline;
        }

    </style>

</head>

<body>

<div class="reset-card">


    <!-- Icône -->

    <div class="icon">

        <i class="fa-solid fa-lock"></i>

    </div>


    <!-- En-tête -->

    <div class="header">

        <h2>
            Nouveau mot de passe
        </h2>

        <p>
            Définissez un nouveau mot de passe sécurisé
            pour votre compte.
        </p>

    </div>


    <!-- Erreurs -->

    @if ($errors->any())

        <div class="alert">

            <i class="fa-solid fa-circle-exclamation"></i>

            {{ $errors->first() }}

        </div>

    @endif


    <!-- Formulaire -->

    <form
        method="POST"
        action="{{ route('password.update') }}"
    >

        @csrf


        <!-- Token -->

        <input
            type="hidden"
            name="token"
            value="{{ $token }}"
        >


        <!-- Email -->

        <div class="form-group">

            <label for="email">

                Adresse email

            </label>

            <div class="input-wrapper">

                <i class="fa-solid fa-envelope"></i>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ $email }}"
                    readonly
                >

            </div>

        </div>


        <!-- Nouveau mot de passe -->

        <div class="form-group">

            <label for="password">

                Nouveau mot de passe

            </label>

            <div class="input-wrapper">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 8 caractères"
                    required
                >

                <button
                    type="button"
                    class="password-toggle"
                    onclick="togglePassword('password', this)"
                >

                    <i class="fa-solid fa-eye"></i>

                </button>

            </div>

            @error('password')

                <div class="error">

                    {{ $message }}

                </div>

            @enderror

        </div>


        <!-- Confirmation -->

        <div class="form-group">

            <label for="password_confirmation">

                Confirmer le mot de passe

            </label>

            <div class="input-wrapper">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirmez votre mot de passe"
                    required
                >

                <button
                    type="button"
                    class="password-toggle"
                    onclick="togglePassword('password_confirmation', this)"
                >

                    <i class="fa-solid fa-eye"></i>

                </button>

            </div>

        </div>


        <!-- Bouton -->

        <button
            type="submit"
            class="button"
        >

            Réinitialiser le mot de passe

        </button>

    </form>


    <!-- Retour -->

    <a
        href="{{ route('login') }}"
        class="back"
    >

        <i class="fa-solid fa-arrow-left"></i>

        Retour à la connexion

    </a>


</div>


<script>

    function togglePassword(
        inputId,
        button
    ) {

        const input =
            document.getElementById(inputId);

        const icon =
            button.querySelector('i');


        if (
            input.type === 'password'
        ) {

            input.type = 'text';

            icon.classList.remove(
                'fa-eye'
            );

            icon.classList.add(
                'fa-eye-slash'
            );

        } else {

            input.type = 'password';

            icon.classList.remove(
                'fa-eye-slash'
            );

            icon.classList.add(
                'fa-eye'
            );

        }

    }

</script>

</body>

</html>