<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; color: #333; line-height: 1.6; }
        .container { width: 80%; margin: 0 auto; padding: 20px; border: 1px solid #eee; }
        .header { text-align: center; border-bottom: 2px solid #d4a373; padding-bottom: 20px; }
        .footer { font-size: 12px; text-align: center; color: #777; margin-top: 30px; }
        .text-gold { color: #d4a373; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="text-gold">STUDIO DIAMOND</h1>
            <p>Vielen Dank für Ihre Bestellung!</p>
        </div>

        <h3>Hallo {{ $order->first_name }},</h3>
        <p>Ihre Bestellung <strong>#{{ $order->id }}</strong> ist bei uns eingegangen und wird nun bearbeitet.</p>

        <table>
            <thead>
                <tr style="background: #f9f9f9;">
                    <th>Produkt</th>
                    <th>Menge</th>
                    <th>Preis</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }} €</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: right; font-weight: bold;">Gesamtsumme:</td>
                    <td style="font-weight: bold; color: #d4a373;">{{ number_format($order->total_price, 2) }} €</td>
                </tr>
            </tfoot>
        </table>

        <p><strong>Lieferadresse:</strong><br>
        {{ $order->address }}<br>
        {{ $order->zip }} {{ $order->city }}</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Studio Diamond. Alle Rechte vorbehalten.</p>
        </div>
    </div>
</body>
</html>