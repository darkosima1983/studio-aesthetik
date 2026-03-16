<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; border-bottom: 2px solid #d4a373; padding-bottom: 10px; }
        .content { padding: 20px 0; }
        .footer { font-size: 12px; text-align: center; color: #888; margin-top: 20px; }
        .button { background-color: #000; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #d4a373;">STUDIO DIAMOND</h1>
        </div>
        <div class="content">
            <p>Hallo <strong>{{ $appointment->user->name }}</strong>,</p>
            <p>Tolle Neuigkeiten! Dein Termin wurde soeben von uns bestätigt.</p>
            <hr>
            <p><strong>Dienstleistung:</strong> {{ $appointment->service->name }}</p>
            <p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('d.m.Y') }}</p>
            <p><strong>Uhrzeit:</strong> {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }} Uhr</p>
            <hr>
            <p>Wir freuen uns auf deinen Besuch!</p>
            <p><a href="{{ route('profile.index') }}" class="button">Mein Profil ansehen</a></p>
        </div>
        <div class="footer">
            Studio Diamond | Deine Adresse ovde | Tel: Tvoj Telefon
        </div>
    </div>
</body>
</html>