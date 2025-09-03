<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de Transfert - Job'S Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }

        body {
            padding: 30px;
            font-size: 14px;
        }

        .recu-section {
            border: 2px dashed #000;
            padding: 20px;
            margin-bottom: 40px;
        }

        .section-title {
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .info-block {
            margin-bottom: 20px;
        }

        .signatures {
            margin-top: 30px;
        }

        .signatures .col {
            text-align: center;
        }

        .signatures .col span {
            display: block;
            margin-top: 60px;
            border-top: 1px solid #000;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h4 {
            margin: 0;
        }
    </style>
</head>
<body>


    <div class="recu-section">
        <div class="header mb-3">
            <img src="{{ asset('Authentification/img/logo_Job_S_Agency.png') }}" alt="Job'S Agency" class="logo">
            <h4>Reçu de Transfert N°: {{ $transfert->numero_de_controle }}</h4>
        </div>

        <div class="info-block">
            <p class="section-title">Informations Générales</p>
            <ul class="list-group">
                <li class="list-group-item"><strong>Date :</strong> {{ $transfert->created_at->format('d/m/Y') }}</li>
                <li class="list-group-item"><strong>Montant envoyé :</strong> {{ number_format($transfert->montant_a_envoyer, 0, ',', ' ') }} FCFA</li>
                <li class="list-group-item"><strong>Frais :</strong> {{ number_format($transfert->taxe, 0, ',', ' ') }} FCFA</li>
                <li class="list-group-item"><strong>Montant à recevoir :</strong> {{ number_format($transfert->montant_a_recevoir, 0, ',', ' ') }} FCFA</li>
                <li class="list-group-item"><strong>Motif :</strong> {{ $transfert->motif_du_transfert }}</li>
                <li class="list-group-item"><strong>Statut :</strong> {{ ucfirst(str_replace('_', ' ', $transfert->statut)) }}</li>
            </ul>
        </div>

        <div class="info-block">
            <p class="section-title">Informations Destinataire</p>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nom :</strong> {{ $transfert->destinateur_nom }} {{ $transfert->destinateur_prenom }}</li>
                <li class="list-group-item"><strong>Téléphone :</strong> {{ $transfert->destinateur_telephone }}</li>
                <li class="list-group-item"><strong>Email :</strong> {{ $transfert->destinateur_email }}</li>
                <li class="list-group-item"><strong>Agence de réception :</strong> {{ $transfert->AgenceTransfert->nom ?? 'N/A' }} ({{ $transfert->AgenceTransfert->pays ?? 'N/A' }})</li>
            </ul>
        </div>

        <div class="info-block">
            <p class="section-title">Informations Expéditeur</p>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nom :</strong> {{ $transfert->client->name }} {{ $transfert->client->prenom }}</li>
                <li class="list-group-item"><strong>Téléphone :</strong> {{ $transfert->client->telephone }}</li>
                <li class="list-group-item"><strong>Email :</strong> {{ $transfert->client->email }}</li>
                <li class="list-group-item"><strong>Secrétaire :</strong> {{ $transfert->user->name }} {{ $transfert->user->prenom }}</li>
                @foreach($transfert->user->agences as $agence)
                    <li class="list-group-item"><strong>Agence d'expédition :</strong> {{ $agence->nom ?? 'N/A' }} ({{ $agence->pays ?? 'N/A' }})</li>
                @endforeach
            </ul>
        </div>

        <div class="row signatures">
            <div class="col">
                <p><strong>Signature du client</strong></p>
                <span></span>
            </div>
            <div class="col">
                <p><strong>Signature de la secrétaire</strong></p>
                <span></span>
            </div>
        </div>
    </div>

<div class="text-center no-print mt-5">
    <button class="btn btn-primary" onclick="window.print()">Imprimer les deux reçus</button>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
</div>

</body>
</html>
