<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Гостевая книга</title>
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body>
        <?php
        /** @var PDO $db */
        $db = require_once $_SERVER['DOCUMENT_ROOT'] . '/db.php';
        $countString = 0;
        $query = $db ->query('SELECT COUNT(*) from reviews')
                ->fetchAll(PDO::FETCH_ASSOC); //кол-во всех записей
        foreach ($query as  $elemQuery){
            foreach ($elemQuery as $key => $count){
                $countString += ceil($count / 2);
            }
        }
        ?>

		<div id="wrapper">
			<h1>Гостевая книга</h1>
            <div>
                <nav>
                    <ul class="pagination">
                        <li class="disabled">
                            <a href="/mini_project/?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ( $i = 1; $i<=$countString; $i++){?>
                        <li><a href="/mini_project/?page=<?= $i ?>"><?php echo $i ?></a></li>
                        <?php } ?>
                        <li>
                            <a href="/mini_project/?page=<?=$countString ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <?php
            $tabs = $_GET['page'] * 2 - 2;
            $list = $db ->query('SELECT * FROM `reviews` LIMIT ' . $tabs . ', 2')
                        ->fetchAll(PDO::FETCH_ASSOC);
            ?>
			<div class="note">
                <?php foreach ($list as $record): ?>
				<p>
					<span class="date"><?php echo $record['data'] . " " . $record['time'] ?></span>
					<span class="name"><?php echo $record['name']?></span>
				</p>
				<p> <?php echo $record['review']?></p>
                <?php endforeach; ?>
			</div>

            <?php if (isset($_GET['result']) && $_GET['result']): ?>
                <div class="info alert alert-info">
                    Запись успешно сохранена!
                </div>
            <?php endif; ?>

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

