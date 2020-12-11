<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 Page | <?= $_SERVER["APP_NAME"]; ?></title>

  <style>
    *,
    *::after,
    *::before {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);

      display: flex;
      flex-direction: column;
      align-items: center;
      width: 80%;
      padding: 1rem;
    }

    .container .heading {
      color: blueviolet;
      font-size: 1.3rem;
    }

    .container .content {
      width: 50%;
      margin-top: 1.6rem;
      padding: 1rem;
      color: blueviolet;
      text-align: center;
    }

    .container .content a {
      color: blueviolet;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="heading">
      <h2> 404 | Page Not Found</h2>
    </div>
    <div class="content">
      <p>&copy; Built by <a href="https://github.com/rllyhz" target="_blank">Rllyhz</a>.</p>
    </div>
  </div>
</body>

</html>