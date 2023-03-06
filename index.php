<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Гостевая книга</title>
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body>
		<div id="wrapper">
			<h1>Гостевая книга</h1>
            <?php
            /** @var PDO $db */
            $db = require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';

            $stmt = $db ->query('select * from reviews ORDER BY data DESC, time DESC')
                        ->fetchAll(PDO::FETCH_ASSOC);
            ?>
			<div class="note">
                <?php foreach ($stmt as $Record): ?>
				<p>
					<span class="date"><?php echo $Record['data'] . " " . $Record['time'] ?></span>
					<span class="name"><?php echo $Record['name']?></span>
				</p>
				<p> <?php echo $Record['review']?></p>
                <?php endforeach; ?>
			</div>

            <div class="info alert alert-info">
                Запись успешно сохранена!
            </div>

			<div id="form">
				<form action="/form/create.php" method="POST">
					<p><input class="form-control" name="name" placeholder="Ваше имя"></p>
					<p><textarea class="form-control" name="review" placeholder="Ваш отзыв"></textarea></p>
					<p><input type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
				</form>
			</div>
		</div>
	</body>
</html>

