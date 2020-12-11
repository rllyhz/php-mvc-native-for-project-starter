<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Page | <?= $_SERVER["APP_NAME"]; ?></title>

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

    .container .content .links {
      margin-top: 6rem;
      padding: 1rem;
      display: flex;
      justify-content: space-around;
      border-radius: 8px;
      box-shadow: 1px 1px 4px rgba(0, 0, 0, .1);
      transition: transform 200ms ease-in-out;
    }

    .container .content .links:hover {
      transform: scale(1.02);
    }

    .container .content .links>a {
      text-decoration: none;
      color: palevioletred;
      transition: opacity 200ms ease-in-out;
    }

    .container .content .links>a:hover {
      opacity: .75;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="heading">
      <h2>Welcome to PHP MVCiers for Starter Project</h2>
    </div>
    <div class="content">
      <p>&copy; Built by Rllyhz.</p>

      <div class="links">
        <a href="https://www.github.com/rllyhz" target="_blank">Github</a>
        <a href="https://www.instagram.com/rllyhz" target="_blank">Instagram</a>
        <a href="https://twitter.com/rullyihza_" target="_blank">Twitter</a>
        <a href="https://www.facebook.com/rully.ihza" target="_blank">Facebook</a>
      </div>
    </div>
  </div>
</body>

</html>