<?php
// Landing page for the Vango project workspace.
// The original project (frontend + backend) was not included in this upload —
// only the brochure, a MySQL dump, and a few PHP debug/seed scripts are present.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vango — Project Workspace</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #4a90e2 100%);
            min-height: 100vh;
            color: #fff;
            padding: 40px 20px;
        }
        .wrap { max-width: 880px; margin: 0 auto; }
        h1 { font-size: 42px; margin-bottom: 8px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
        .tagline { font-size: 18px; color: #e8f4fd; font-style: italic; margin-bottom: 32px; }
        .card {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
        }
        .card h2 { font-size: 22px; margin-bottom: 12px; }
        .card p { line-height: 1.6; margin-bottom: 12px; color: #f0f6ff; }
        a {
            color: #fff;
            text-decoration: none;
            display: inline-block;
            background: rgba(255,255,255,0.18);
            padding: 10px 18px;
            border-radius: 8px;
            margin: 4px 8px 4px 0;
            transition: background 0.2s;
            border: 1px solid rgba(255,255,255,0.25);
        }
        a:hover { background: rgba(255,255,255,0.32); }
        ul { list-style: none; padding: 0; }
        li { padding: 6px 0; color: #e8f4fd; font-family: ui-monospace, SFMono-Regular, monospace; font-size: 14px; }
        .note {
            background: rgba(255, 200, 0, 0.15);
            border-left: 4px solid #ffc83d;
            padding: 14px 18px;
            border-radius: 6px;
            margin-bottom: 20px;
            color: #fff8e1;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <h1>Vango</h1>
        <div class="tagline">Transportation booking project workspace</div>

        <div class="note">
            <strong>Heads up:</strong> This repository only contains a brochure page,
            a MySQL database dump, and a handful of PHP debug/seed scripts. The
            main application (the <code>backend/</code> folder, frontend pages, and
            an active MySQL server) was not included in the upload, so the helper
            scripts that reference <code>backend/db.php</code> cannot run as-is.
        </div>

        <div class="card">
            <h2>View the brochure</h2>
            <p>Open the marketing one-pager bundled with the project.</p>
            <a href="/vango-brochure.html">Open brochure</a>
        </div>

        <div class="card">
            <h2>Files in this workspace</h2>
            <ul>
            <?php
                $files = array_filter(scandir(__DIR__), function ($f) {
                    return $f !== '.' && $f !== '..' && $f[0] !== '.' && !is_dir(__DIR__ . '/' . $f);
                });
                sort($files);
                foreach ($files as $f) {
                    echo '<li>' . htmlspecialchars($f) . '</li>';
                }
            ?>
            </ul>
        </div>

        <div class="card">
            <h2>Database schema</h2>
            <p>The included <code>vango_db.sql</code> dump defines tables for
            <code>admins</code>, <code>users</code>, <code>drivers</code>,
            <code>trips</code>, and <code>bookings</code>. To bring the full app
            online you'd need to import this dump into MySQL and add the missing
            <code>backend/</code> source code.</p>
        </div>
    </div>
</body>
</html>
