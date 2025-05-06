<?php
require 'db.php';

// bounty hunter kategori
$categoryQuery = $pdo->query("SELECT texts FROM text_test ORDER BY id");
$categories = $categoryQuery->fetchAll(PDO::FETCH_COLUMN);

// inspektur kategori
$categoryFilter = isset($_GET['categories']) ? $_GET['categories'] : [];

// mining is life
$sql = "SELECT 
            w.id,
            w.text
        FROM text_test w
        WHERE w.texts IN (:texts)
        ORDER BY w.id";

$stmt = $pdo->prepare($sql);
$words = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($words)) {
    foreach ($words as $word) : ?>
        <tr>
            <td><?= htmlspecialchars($word['text']) ?></td>
        </tr>
        <tr>
            <td class="divider" colspan="1">
                <hr class="divider">
            </td>
        </tr>
    <?php endforeach;
} else { ?>
    <tr>
        <td>No results found.</td>
    </tr>
<?php }?>