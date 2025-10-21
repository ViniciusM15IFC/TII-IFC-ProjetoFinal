<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Card com Estrelas Verticais</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Iconify -->
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

  <style>
    body {
      background-color: #121212;
      font-family: "Karma", serif;
    }

    .card-post {
      background-color: #1e1e1e;
      color: #f1f1f1;
      border-radius: 15px;
      padding: 1rem 1.5rem;
      max-width: 700px;
      margin: 2rem auto;
    }

    .user-icon {
      background-color: #343a40;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #0d6efd;
    }

    .seguir-btn {
      background-color: #0d6efd;
      color: white;
      font-size: 0.9rem;
      border: none;
      border-radius: 8px;
      padding: 3px 12px;
      transition: 0.2s;
    }

    .seguir-btn:hover {
      background-color: #0b5ed7;
    }

    .game-img {
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
      width: 120px;
      height: auto;
    }

    .rating-vertical {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin-right: 8px;
    }

    .rating-vertical iconify-icon {
      color: #5dade2;
      font-size: 22px;
      margin: 1px 0;
    }

    .divider {
      border-top: 1px solid rgba(255, 255, 255, 0.3);
      margin: 0.75rem 0;
    }

    .footer-icons iconify-icon {
      color: #5dade2;
      font-size: 24px;
      cursor: pointer;
      transition: 0.2s;
    }

    .footer-icons iconify-icon:hover {
      color: #0d6efd;
    }

    @media (max-width: 768px) {
      .text-section {
        text-align: center;
      }

      .game-section {
        justify-content: center;
      }

      .rating-vertical {
        flex-direction: row;
        margin-right: 0;
        margin-bottom: 8px;
      }

      .rating-vertical iconify-icon {
        margin: 0 3px;
      }
    }
  </style>
</head>
<body>

  <div class="card-post">
    <!-- Top section -->
    <div class="d-flex align-items-center mb-2">
      <div class="user-icon me-2">
        <iconify-icon icon="mdi:account"></iconify-icon>
      </div>
      <h6 class="mb-0 me-2 fw-semibold">Lililililili</h6>
      <button class="seguir-btn">Seguir</button>
    </div>

    <!-- Middle content -->
    <div class="row align-items-start">
      <div class="col-md-8 text-section">
        <p class="mb-0">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ipsum arcu, sollicitudin ut odio eget, maximus tempus ex. 
          Donec lobortis ornare eros at tincidunt.<br>
          In eu tortor at purus hendrerit tongue.<br>
          Fusce quis ultrices libero.<br>
          Morbi rhoncus elementum augue, bibendum condimentum lacus aliquet eu.
        </p>
      </div>

      <div class="col-md-4 d-flex justify-content-end align-items-center mt-3 mt-md-0 game-section">
        <div class="d-flex align-items-center">
          <div class="rating-vertical">
            <iconify-icon icon="ic:round-star"></iconify-icon>
            <iconify-icon icon="ic:round-star"></iconify-icon>
            <iconify-icon icon="ic:round-star"></iconify-icon>
            <iconify-icon icon="ic:round-star"></iconify-icon>
            <iconify-icon icon="ic:round-star-border"></iconify-icon>
          </div>
          <div class="text-center">
            <img src="https://via.placeholder.com/120x160" alt="Jogo Flow" class="game-img mb-1">
            <p class="small text-light-50 mb-0">Flow</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Footer icons -->
    <div class="d-flex justify-content-between footer-icons">
      <div>
        <iconify-icon icon="mdi:heart-outline"></iconify-icon>
        <iconify-icon icon="mdi:comment-outline" class="ms-3"></iconify-icon>
      </div>
      <iconify-icon icon="mdi:alert-outline"></iconify-icon>
    </div>
  </div>

</body>
</html>
