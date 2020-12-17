<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhpMVCiers Error Page</title>
  <style>
    body {
      background-color: #3e3e3e;
      color: lightcoral;
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

    .details table tr,
    .details table tr td {
      padding: .6rem 1rem;
    }

    .container .credits {
      position: fixed;
      bottom: 3rem;
      left: 50%;
      transform: translateX(-50%);
    }

    .container .credits p a {
      text-decoration: none;
      color: lightcoral;
    }

    .container .credits p a:hover {
      text-decoration: underline;
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
        <table cellspacing="0" border="1">
          <tbody>
            <tr>
              <td>Message</td>
              <td><strong style="color: white;"><?php echo $details["message"]; ?></strong></td>
            </tr>
            <tr>
              <td>File</td>
              <td><?php echo $details["file"]; ?></td>
            </tr>
            <tr>
              <td>Line</td>
              <td><?php echo $details["line"] >= 0 ? $details["line"] : "---"; ?></td>
            </tr>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
    <div class="credits">
      <p>&copy; Built by <a href="https://www.github.com/rllyhz" target="_blank">Rllyhz</a>.</p>
    </div>
  </div>
</body>

</html>