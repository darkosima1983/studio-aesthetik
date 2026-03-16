<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; border-bottom: 2px solid #e74c3c; padding-bottom: 10px; }
        .content { padding: 20px 0; }
        .footer { font-size: 12px; text-align: center; color: #888; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #e74c3c;">TERMIN STORNIERT</h1>
        </div>
        <div class="content">
            <p>Hallo <strong>{{ $appointment->user->name }}</strong>,</p>
            <p>Leider mussten wir deinen Termin am <strong>{{ \Carbon\Carbon::parse($appointment->date)->format('d.m.Y') }}</strong> um <strong>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }} Uhr</strong> stornieren.</p>
            <p>Bitte besuche unsere Website, um einen neuen passenden Termin zu finden ili nas pozovi direktno.</p>
            <hr>
            <p style="text-align: center;">
                <a href="{{ url('/services') }}" style="background-color: #000; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Neuen Termin buchen</a>
            </p>
        </div>
        <div class="footer">
            Studio Diamond | Tel: Tvoj Telefon
        </div>
    </div>
</body>
</html>