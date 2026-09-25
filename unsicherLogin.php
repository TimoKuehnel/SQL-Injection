<?php
session_start();
require __DIR__ . '/db.php';

$message = '';
$debugSql = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // ABSICHTLICH UNSICHER: Nur für lokale Unterrichtszwecke.
    $sql = "SELECT id, username, email
            FROM benutzer
            WHERE username = '$username' AND passwort = '$password'";

    $debugSql = $sql;
    $stmt = $pdo->query($sql);
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userRow) {
        $message = 'Login erfolgreich. Willkommen, ' . htmlspecialchars($userRow['username']) . '!';
        $_SESSION['login_user'] = $userRow['username'];
    } else {
        $message = 'Login fehlgeschlagen.';
        unset($_SESSION['login_user']);
    }
}
?>
<!doctype html>
<html lang="de">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SQL Injection Login-Demo</title>
<style>
body { font-family: Arial, sans-serif; background:#f3f4f6; margin:0; }
.container { max-width:760px; margin:50px auto; padding:24px; }
.card { background:white; border-radius:12px; padding:28px; box-shadow:0 4px 18px rgba(0,0,0,.08); }
h1 { margin-top:0; }
label { display:block; margin:14px 0 6px; font-weight:700; }
input { width:100%; padding:10px; box-sizing:border-box; border:1px solid #bbb; border-radius:6px; }
button { margin-top:18px; padding:10px 16px; border:0; border-radius:6px; cursor:pointer; }
.message { margin-top:20px; padding:12px; background:#eef6ff; border-left:4px solid #2b6cb0; }
.debug { margin-top:20px; background:#111827; color:#e5e7eb; padding:16px; border-radius:8px; white-space:pre-wrap; font-family:monospace; }
.note { margin-top:18px; color:#555; font-size:.95rem; }
</style>
</head>
<body>
<div class="container">
  <div class="card">
    <h1>Login-Demo</h1>
    <p>Diese Variante ist absichtlich unsicher und nur für eine lokale Unterrichtsumgebung gedacht.</p>

    <form method="post">
      <label for="username">Benutzername</label>
      <input id="username" name="username" type="text" required>

      <label for="password">Passwort</label>
      <input id="password" name="password" type="password" required>

      <button type="submit">Einloggen</button>
    </form>

    <?php if ($message !== ''): ?>
      <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <?php if ($debugSql !== ''): ?>
      <div class="debug"><strong>Ausgeführtes SQL:</strong>

<?= htmlspecialchars($debugSql) ?></div>
    <?php endif; ?>

    <p class="note">Testkonto: <code>admin</code> / <code>Admin123!</code></p>
  </div>
</div>
</body>
</html>
