<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Mot de passe oublié | Gestion Projets GC
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

        .forgot-card {
            width: 100%;
            max-width: 450px;

            background: white;

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

        .input-wrapper i {
            position: absolute;

            left: 15px;

            top: 50%;

            transform: translateY(-50%);

            color: #9ca3af;
        }

        input {
            width: 100%;

            height: 50px;

            border: 1px solid #d9dee7;

            border-radius: 9px;

            padding: 0 45px;

            font-size: 14px;

            outline: none;
        }

        input:focus {
            border-color: #1d658f;

            box-shadow:
                0 0 0 3px
                rgba(29,101,143,0.10);
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
        }

        .button:hover {
            background: #174f71;
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

<div class="forgot-card">

    <div class="icon">

        <i class="fa-solid fa-key"></i>

    </div>

    <div class="header">

        <h2>
            Mot de passe oublié ?
        </h2>

        <p>
            Saisissez votre adresse email associée
            à votre compte afin de réinitialiser
            votre mot de passe.
        </p>

    </div>


    @if ($errors->any())

        <div class="alert">

            {{ $errors->first() }}

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('password.email') }}"
    >

        @csrf


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
                    placeholder="exemple@entreprise.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >

            </div>

            @error('email')

                <div class="error">

                    {{ $message }}

                </div>

            @enderror

        </div>


        <button
            type="submit"
            class="button"
        >

            Envoyer le lien de réinitialisation

        </button>

    </form>


    <a
        href="{{ route('login') }}"
        class="back"
    >

        <i class="fa-solid fa-arrow-left"></i>

        Retour à la connexion

    </a>

</div>

</body>

</html>