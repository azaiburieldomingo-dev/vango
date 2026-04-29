# Vango Project Workspace

## Overview
This repository was uploaded as a partial PHP project. It contains:
- `vango-brochure.html` — a static marketing brochure page
- `vango_db.sql` — a phpMyAdmin MySQL dump defining tables `admins`, `users`, `drivers`, `trips`, `bookings`
- A handful of PHP debug/seed scripts (`add_test_trips.php`, `debug_api.php`, `debug_trips.php`, `check_*`, `reset_trips.php`, etc.) that all `include "backend/db.php"`
- `index.php` — landing page added during Replit setup that lists what's in the workspace and links to the brochure

The actual application source (the `backend/` folder, frontend pages, and a running MySQL server) was **not** included in the upload, so the helper PHP scripts cannot execute as-is.

## Environment
- **Language/runtime:** PHP 8.2 (from the `php-8.2` Nix module declared in `.replit`)
- **Web server:** PHP built-in development server (`php -S`)
- **Workflow:** `Start application` — runs `php -S 0.0.0.0:5000 -t .` on port 5000 with webview output
- **Database:** None configured. The original project assumed a local MySQL instance (`vango_db`).

## Project Layout
```
.
├── index.php                    # Landing page (added for Replit)
├── vango-brochure.html          # Static brochure
├── vango_db.sql                 # MySQL dump
├── add_test_trips.php           # Seed script (requires backend/db.php)
├── debug_*.php / check_*.php    # Debug scripts (require backend/db.php)
├── *_seat_history*.php          # Migration helpers (require backend/db.php)
└── reset_trips.php              # Maintenance script (requires backend/db.php)
```

## Deployment
Configured as an autoscale deployment running the same PHP built-in server on port 5000.
