# Deploy notes — Docker image with pdo_mysql

This repo now includes a `Dockerfile` that installs `pdo_mysql` (and common extensions) and prepares the app for container deployment.

Build locally (Linux/macOS/Windows WSL or Docker Desktop):

```bash
docker build -t your-namespace/laravel-app:latest .
```

Run locally to verify `pdo_mysql` is loaded and app starts:

```bash
docker run --rm -p 9000:9000 -e APP_ENV=local your-namespace/laravel-app:latest
```

Inside the running container you can check extensions:

```bash
docker run --rm your-namespace/laravel-app:latest php -m | grep -i pdo
```

Or create a temporary `phpinfo()` file under `public/` and visit it to confirm `pdo_mysql` is available for FPM.

Push to registry and redeploy on Nimbuz (example using Docker Hub):

```bash
docker tag your-namespace/laravel-app:latest your-namespace/laravel-app:latest
docker push your-namespace/laravel-app:latest
```

In Nimbuz: update the service to use the new image tag or upload the new image. If Nimbuz builds from repository, ensure the platform uses this `Dockerfile` (or provide a custom build script) so `pdo_mysql` is installed in the image.

After deployment:

- Confirm `DB_CONNECTION` in `.env` is `mysql` and credentials are correct.
- Clear cached config on the deployed container (or during build):

```bash
php artisan config:clear
php artisan cache:clear
```

Notes:
- The `Dockerfile` is based on `php:8.2-fpm` to match `composer.json` (`php: ^8.2`).
- If Nimbuz uses a different build environment, share those build logs or platform settings and I can adapt the Dockerfile or provide platform-specific steps.
