# Railway Deployment Configuration

Dokumentasi deploy Railway ada di `RAILWAY_DEPLOYMENT.md`

## Quick Start:

### 1. Commit & Push ke GitHub
```bash
git add .
git commit -m "Add Railway deployment files"
git push
```

### 2. Railway Setup
- Sign up di https://railway.app
- Create project dari GitHub repo
- Add MySQL service
- Add Redis service (optional)

### 3. Environment Variables
Set di Railway dashboard:
- APP_NAME
- APP_ENV=production
- APP_DEBUG=false
- APP_URL (akan di-generate)
- DATABASE variables (auto-provided)

### 4. Deploy
Push ke GitHub atau gunakan Railway CLI

### 5. Database Migration
SSH ke container dan jalankan:
```bash
php artisan migrate --force
php artisan db:seed --force
```

## Support
- Baca RAILWAY_DEPLOYMENT.md untuk detail lengkap
- Railway Docs: https://docs.railway.app
