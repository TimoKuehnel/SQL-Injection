<?php
require __DIR__ . '/db.php';

$results = [];
$sqlDebug = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';

    // ABSICHTLICH UNSICHER: Benutzereingabe wird direkt in SQL eingesetzt.
    $sql = "SELECT id, username, email FROM benutzer WHERE username = '$username'";
    $sqlDebug = $sql;

    try {
        $results = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $message = 'SQL-Fehler: ' . $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="de">
<head>
<meta charset="utf-8">
<title>SQL-Injection Demo</title>
<style>
body{font-family:Arial,sans-serif;max-width:800px;margin:40px auto;padding:0 20px;background:#f5f5f5;color:#222}
main{background:white;padding:28px;border-radius:12px;box-shadow:0 2px 12px #0001}
input,button{font-size:1rem;padding:10px}input{width:65%}button{cursor:pointer}
pre{background:#111;color:#0f0;padding:15px;overflow:auto;border-radius:8px}
table{border-collapse:collapse;width:100%;margin-top:20px}th,td{border:1px solid #ccc;padding:8px;text-align:left}
.note{background:#fff3cd;padding:12px;border-radius:8px}
</style>
</head>
<body>
<main>
<h1>SQL-Injection-Demo</h1>
<p class="note">Diese Seite ist absichtlich unsicher und nur für ein lokales Testsystem gedacht.</p>
<form method="post">
    <label>Benutzername:</label><br><br>
    <input name="username" placeholder="z. B. alice" autofocus>
    <button type="submit">Suchen</button>
</form>

<?php if ($sqlDebug): ?>
<h2>Vom PHP erzeugtes SQL</h2>
<pre><?= htmlspecialchars($sqlDebug) ?></pre>
<?php endif; ?>

<?php if ($message): ?>
<p><strong><?= htmlspecialchars($message) ?></strong></p>
<?php endif; ?>

<?php if ($results): ?>
<h2>Ergebnis</h2>
<table>
<tr><th>ID</th><th>Username</th><th>E-Mail</th></tr>
<?php foreach ($results as $row): ?>
<tr>
<td><?= htmlspecialchars($row['id']) ?></td>
<td><?= htmlspecialchars($row['username']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
</main>
</body>
</html>
