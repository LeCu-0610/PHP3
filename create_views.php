<?php
$structure = [
    'views/admin/category/index.php',
    'views/admin/dashboard/index.php',
    'views/admin/order/index.php',
    'views/admin/post/index.php',
    'views/admin/product/index.php',
    'views/client/category/index.php',
    'views/client/dashboard/index.php',
    'views/client/order/index.php',
    'views/client/post/index.php',
    'views/client/product/index.php',
    'views/client/cart/index.php',
    'views/client/checkout/index.php',
];

foreach ($structure as $path) {
    $dir = dirname($path);

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
        echo "Tạo thư mục: $dir\n";
    }

    if (!file_exists($path)) {
        file_put_contents($path, "<h2>" . htmlspecialchars($path) . "</h2>\n<p>Nội dung hiển thị tại đây...</p>");
        echo "Tạo file: $path\n";
    }
}
