<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre dynamique: montre le numéro de reçu généré côté serveur -->
    <title>Reçu de Paiement - {{ $payment->receipt_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            color: #333;
            padding: 20px;
            background: #f8f9fa;
        }
        
        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        
        /* En-tête avec dégradé */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }
        
        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #ffd700, #ffed4e, #ffd700);
        }
        
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 10px;
            background: white;
            border-radius: 50%;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo img {
            max-width: 60px;
            max-height: 60px;
            object-fit: contain;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .header p {
            font-size: 12px;
            opacity: 0.9;
        }
        
        /* Corps du reçu */
        .receipt-body {
            padding: 20px 15px;
        }
        
        .receipt-title {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .receipt-title h2 {
            font-size: 20px;
            color: #667eea;
            margin-bottom: 8px;
        }
        
        .receipt-number {
            display: inline-block;
            background: #f0f0f0;
            padding: 6px 15px;
            border-radius: 15px;
            font-weight: 600;
            color: #555;
            font-size: 12px;
        }
        
        /* Informations en deux colonnes */
        .info-grid {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        
        .info-grid td {
            padding: 8px 10px;
            border-bottom: 1px solid #e9ecef;
            width: 50%;
            vertical-align: top;
        }
        
        .info-label {
            font-weight: 600;
            color: #667eea;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 3px;
        }
        
        .info-value {
            font-size: 14px;
            color: #333;
        }
        
        /* Tableau des détails */
        .payment-details {
            margin: 20px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            padding: 2px;
        }
        
        .payment-details-inner {
            background: white;
            border-radius: 6px;
            padding: 15px;
        }
        
        .detail-row {
            width: 100%;
            padding: 10px 0;
            border-bottom: 1px dashed #e9ecef;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-row td {
            padding: 3px 0;
        }
        
        .detail-label {
            font-weight: 600;
            color: #555;
            font-size: 12px;
            width: 60%;
        }
        
        .detail-value {
            text-align: right;
            font-size: 14px;
            color: #333;
            width: 40%;
        }
        
        .amount-row {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: -2px;
            margin-top: 15px;
            padding: 15px 20px;
            border-radius: 6px;
            color: white;
        }
        
        .amount-row td {
            color: white;
            padding: 3px 0;
        }
        
        .amount-row .detail-label {
            color: white;
            font-size: 16px;
            font-weight: 700;
        }
        
        .amount-row .detail-value {
            color: white;
            font-size: 22px;
            font-weight: 700;
        }
        
        /* Pied de page */
        .footer {
            background: #f8f9fa;
            padding: 20px 15px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        
        .footer-message {
            font-size: 14px;
            color: #667eea;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .footer-info {
            font-size: 10px;
            color: #777;
            line-height: 1.4;
        }
        
        .signature-section {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px dashed #ccc;
        }
        
        .signature-box {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-item {
            width: 48%;
            text-align: center;
            padding: 10px 5px;
        }
        
        .signature-line {
            width: 150px;
            height: 40px;
            border-bottom: 1px solid #333;
            margin: 15px auto 8px;
        }
        
        .signature-label {
            font-size: 11px;
            color: #777;
            font-weight: 600;
        }
        
        /* Badge de statut */
        .status-badge {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            margin-left: 8px;
        }
        
        /* Bouton d'impression */
        .print-btn {
            position: fixed;
            top: 15px;
            right: 15px;
            background: #ffd700;
            color: #333;
            border: none;
            border-radius: 15px;
            padding: 8px 12px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            z-index: 1000;
        }
        
        @media print {
            .print-btn { display: none; }
            body { background: white; padding: 0; }
            .receipt-container { box-shadow: none; }
        }
        
        @page { 
            size: A4; 
            margin: 5mm; 
        }
        
        @media print {
            html, body { 
                width: 210mm; 
                height: 297mm; 
            }
            .receipt-container { 
                max-width: 100%; 
                margin: 0; 
                box-shadow: none; 
                break-inside: avoid; 
                page-break-inside: avoid; 
                height: auto;
            }
            .header, .receipt-body { 
                padding: 12px 15px; 
            }
            .payment-details, .payment-details-inner, .info-grid, .detail-row, .amount-row, .signature-section, .footer { 
                break-inside: avoid; 
                page-break-inside: avoid; 
            }
            .payment-details-inner { 
                padding: 12px; 
            }
            .detail-row { 
                padding: 8px 0; 
            }
            .amount-row { 
                margin-top: 10px; 
                padding: 12px 15px; 
            }
            .signature-section { 
                margin-top: 12px; 
                padding-top: 8px; 
            }
            .header h1 { 
                font-size: 20px; 
            }
            .receipt-title h2 { 
                font-size: 18px; 
            }
            .receipt-number { 
                padding: 4px 10px; 
                font-size: 11px; 
            }
            .detail-label { 
                font-size: 11px; 
            }
            .detail-value { 
                font-size: 12px; 
            }
            .amount-row .detail-label { 
                font-size: 14px; 
            }
            .amount-row .detail-value { 
                font-size: 18px; 
            }
            .signature-line {
                width: 120px;
                height: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- En-tête -->
        <div class="header">
            <button class="print-btn" onclick="window.print()">Imprimer</button>
            <!-- Affiche le logo si disponible; onerror cache l'image manquante -->
            <div class="logo">
                <img src="{{ asset('images/logo_université.png') }}" alt="Académie de langue" onerror="this.style.display='none'">
            </div>
            <h1>Académie de Langue</h1>
            <p>Centre de Formation Linguistique</p>
        </div>
        
        <!-- Corps -->
        <div class="receipt-body">
            <div class="receipt-title">
                <!-- En-tête du reçu avec type et numéro -->
                <h2>REÇU DE PAIEMENT</h2>
                <span class="receipt-number">N° {{ $payment->receipt_number }}</span>
                <span class="status-badge">PAYÉ</span>
            </div>
            
            <!-- Informations -->
            <table class="info-grid">
                <tr>
                    <td>
                        <!-- Relation: informations de l'étudiant lié au paiement -->
                        <div class="info-label">Étudiant(e)</div>
                        <div class="info-value">{{ $payment->enrollment->student->first_name }} {{ $payment->enrollment->student->last_name }}</div>
                    </td>
                    <td>
                        <!-- Date et heure formatées avec Carbon (via cast 'paid_at') -->
                        <div class="info-label">Date de paiement</div>
                        <div class="info-value">{{ $payment->paid_at->format('d/m/Y à H:i') }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="info-label">Cours</div>
                        <div class="info-value">{{ $payment->enrollment->course->name ?? 'Non spécifié' }}</div>
                    </td>
                    <td>
                        <div class="info-label">Niveau</div>
                        <div class="info-value">{{ $payment->enrollment->level ?? 'N/A' }}</div>
                    </td>
                </tr>
            </table>
            
            <!-- Détails du paiement -->
            <div class="payment-details">
                <div class="payment-details-inner">
                    <table class="detail-row" style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="detail-label">Méthode de paiement</td>
                            <td class="detail-value">{{ $payment->method ?? 'Espèces' }}</td>
                        </tr>
                    </table>
                    <table class="detail-row" style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="detail-label">Montant total de l'inscription</td>
                            <td class="detail-value">{{ number_format($payment->enrollment->total_amount, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    </table>
                    <table class="detail-row" style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <!-- Montant déjà payé cumulatif (somme des paiements liés) -->
                            <td class="detail-label">Total déjà payé</td>
                            <td class="detail-value">{{ number_format($payment->enrollment->payments->sum('amount'), 0, ',', ' ') }} FCFA</td>
                        </tr>
                    </table>
                    <table class="detail-row" style="width: 100%; border-collapse: collapse; border-bottom: none;">
                        <tr>
                            <!-- Reste à payer: total - somme_payée -->
                            <td class="detail-label">Reste à payer</td>
                            <td class="detail-value">{{ number_format($payment->enrollment->total_amount - $payment->enrollment->payments->sum('amount'), 0, ',', ' ') }} FCFA</td>
                        </tr>
                    </table>
                    
                    <table class="amount-row" style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td class="detail-label">MONTANT DE CE PAIEMENT</td>
                            <td class="detail-value">{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <!-- Section signature -->
            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-item">
                        <div class="signature-line"></div>
                        <div class="signature-label">Signature de l'étudiant</div>
                    </div>
                    <div class="signature-item">
                        <div class="signature-line"></div>
                        <div class="signature-label">Signature du responsable</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pied de page -->
        <div class="footer">
            <div class="footer-message">✓ Merci pour votre paiement !</div>
            <div class="footer-info">
                Ce reçu est généré automatiquement et fait foi de paiement.<br>
                Pour toute question, veuillez contacter l'administration.<br>
                <strong>Académie de Langue</strong> - {{ now()->format('Y') }}
            </div>
        </div>
    </div>
<script>document.addEventListener('DOMContentLoaded',function(){setTimeout(function(){window.print();},500);});</script>
</body>
</html>