<!DOCTYPE html>
<html>
<head>
  <title>Reçu de paiement</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }

    h2 {
      text-align: center;
    }

    .text-center {
      text-align: center;
    }

    .receipt-info {
      margin-top: 30px;
    }

    .receipt-info p {
      margin: 5px;
    }

    .qr-code {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Reçu de paiement</h2>

    <div class="receipt-info">
      <p><strong>Nom:  </strong><?= $info['0']['nom']?></p>
      <p><strong>Prénom: </strong> <?= $info['0']['prenom']?></p>
      <p><strong>Numéro de transaction:</strong> 123456789</p>
      <p><strong>Montant:</strong> $50.00</p>
      <p><strong>Date:</strong> 16 juillet 2023</p>
    </div>

    <div class="qr-code">
      <!-- <img src="https://api.qrserver.com/v1/create-qr-code/?data=Reçu+de+paiement&size=200x200" alt="QR Code"> -->
    </div>
  </div>
</body>
</html>
