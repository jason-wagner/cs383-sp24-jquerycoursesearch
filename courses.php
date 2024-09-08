<?php
require_once __DIR__ . '/../../../db_login.php';

$conn = new PDO("mysql:host=localhost;dbname=cs383", $username, $password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);

$query = $conn->query("SELECT DISTINCT sub FROM master_schedule ORDER BY sub");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <select id="sub" class="form-control">
            <option></option>
            <?php while($subOption = $query->fetch()): ?>
                <option value="<?= $subOption['sub'] ?>"><?= $subOption['sub'] ?></option>
            <?php endwhile; ?>
        </select>

        <select id="num" class="form-control" disabled>

        </select>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('#sub').on('change', function() {
                let subject = $('#sub').val();

                $.post('getnums.php', {sub: subject}, function(d) {
                    $('#num').html('<option></option>');

                    JSON.parse(d).forEach(function(i) {
                        $('#num').append('<option value="' + i + '">' + i + '</option>');
                    });

                    $('#num').prop('disabled', false);
                });
            });
        });
    </script>
  </body>
</html>