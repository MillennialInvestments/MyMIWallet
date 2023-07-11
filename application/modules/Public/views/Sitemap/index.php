<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($urls as $url): ?>
        <?php 
        echo '
        <url>
            <loc>' . $url['loc'] . '</loc>
            <lastmod>' . $url['lastmod'] . '</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.5</priority>
        </url>
        ';
        ?>
    <?php endforeach; ?>
</urlset>