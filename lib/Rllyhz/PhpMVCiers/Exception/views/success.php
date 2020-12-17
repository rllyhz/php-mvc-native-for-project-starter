<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhpMVCiers Success Page</title>
  <style>
    body {
      background-color: #3e3e3e;
      color: lightgreen;
      display: flex;
      place-content: center;
    }

    .container {
      margin-top: 2rem;
    }

    .title {
      text-align: center;
      margin-bottom: 4rem;
    }

    .details {
      font-size: 1.1rem;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="title">
      <h1><?php echo isset($title) ? $title : ""; ?></h1>
    </div>
    <div class="details">
      <?php if (isset($details)) : ?>
        <p> => File <?php echo $details["file"]; ?></p>
        <p> => Line <?php echo $details["line"]; ?></p>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>