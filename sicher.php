<?php
require __DIR__ . '/db.php';

$results = [];
$sqlDebug = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';

    // SICHER: Platzhalter trennt Daten vom SQL-Code.
    $sql = 'SELECT id, username, email FROM benutzer WHERE username = :username';
    $sqlDebug = $sql;

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!doctype html>
<html lang="de">
<head>
<meta charset="utf-8">
<title>Sichere Variante</title>
<style>
body{font-family:Arial,sans-serif;max-width:800px;margin:40px auto;padding:0 20px;background:#f5f5f5;color:#222}
main{background:white;padding:28px;border-radius:12px;box-shadow:0 2px 12px #0001}
input,button{font-size:1rem;padding:10px}input{width:65%}button{cursor:pointer}
pre{background:#111;color:#0f0;padding:15px;overflow:auto;border-radius:8px}
table{border-collapse:collapse;width:100%;margin-top:20px}th,td{border:1px solid #ccc;padding:8px;text-align:left}
.note{background:#d1e7dd;padding:12px;border-radius:8px}
</style>
</head>
<body>
<main>
<h1>Sichere Variante</h1>
<p class="note">Hier wird ein Prepared Statement verwendet.</p>
<form method="post">
    <label>Benutzername:</label><br><br>
    <input name="username" placeholder="z. B. alice" autofocus>
    <button type="submit">Suchen</button>
</form>

<h2>SQL-Anweisung</h2>
<pre><?= htmlspecialchars($sqlDebug ?: 'SELECT id, username, email FROM benutzer WHERE username = :username') ?></pre>

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
