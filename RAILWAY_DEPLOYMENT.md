# 🚀 Panduan Deploy Laravel ke Railway

## Daftar Isi
1. [Persiapan Awal](#persiapan-awal)
2. [Setup di Railway](#setup-di-railway)
3. [Konfigurasi Database](#konfigurasi-database)
4. [Deploy Aplikasi](#deploy-aplikasi)
5. [Migrasi Database](#migrasi-database)
6. [Troubleshooting](#troubleshooting)

---

## Persiapan Awal

### 1. Update `.env.example` (Optional - sudah ada)
File `.env.production` sudah dibuat untuk production environment.

### 2. Pastikan Git Repository
```bash
git init
git add .
git commit -m "Initial commit"
```

### 3. Push ke GitHub (wajib untuk Railway)
```bash
git remote add origin https://github.com/username/rental-app.git
git branch -M main
git push -u origin main
```

---

## Setup di Railway

### Step 1: Buat Akun Railway
- Kunjungi https://railway.app
- Sign up dengan GitHub (recommended)

### Step 2: Buat Project Baru
1. Klik **"New Project"** di dashboard Railway
2. Pilih **"Deploy from GitHub"**
3. Pilih repository Anda
4. Railway akan auto-detect Dockerfile

### Step 3: Tambah Services

#### A. Tambah MySQL Database
1. Di project Railway, klik **"+ Add"**
2. Pilih **"MySQL"** dari list
3. Tunggu hingga database siap

#### B. Tambah Redis Cache (Optional tapi recommended)
1. Klik **"+ Add"** lagi
2. Pilih **"Redis"**
3. Tunggu hingga redis siap

---

## Konfigurasi Database

### Step 1: Ambil Database Credentials
Railway otomatis menyediakan environment variables:
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- `REDIS_HOST`
- `REDIS_PASSWORD`
- `REDIS_PORT`

Anda bisa lihat di: **Project Settings → Variables**

### Step 2: Set Environment Variables di Railway
Di Railway dashboard, pergi ke **Project → Variables**:

```
APP_NAME=Rental App
APP_ENV=production
APP_DEBUG=false
APP_KEY=[akan di-generate otomatis]
APP_URL=https://your-app-name.railway.app

LOG_CHANNEL=stack
LOG_LEVEL=error

SESSION_DRIVER=database
CACHE_DRIVER=redis

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=no-reply@rental.app
```

**⚠️ PENTING**: 
- MySQL variables akan auto-inject oleh Railway
- Jangan set `DB_HOST`, `DB_PORT`, dll manual - biarkan Railway yang set

### Step 3: Deploy Akan Otomatis Menjalankan Build

---

## Deploy Aplikasi

### Method 1: Deploy dari GitHub (Recommended)
1. Railway sudah connected ke GitHub
2. Setiap push ke branch `main` akan auto-deploy
3. Lihat logs di Railway dashboard untuk status

### Method 2: Deploy Manual via Railway CLI
```bash
# Install Railway CLI
npm install -g @railway/cli

# Login
railway login

# Link ke project
railway link

# Deploy
railway up
```

---

## Migrasi Database

### Step 1: Setup Awal
Setelah deploy berhasil, Anda perlu:

1. **SSH ke container** (dari Railway dashboard):
   - Buka service → Klik "Deploy"
   - Klik tab "Logs" → cari "Latest Deploy"
   - Klik "SSH" di atas logs

2. **Jalankan migrasi**:
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```

### Step 2: Alternatif - Migrasi via Build Hook
Edit `Dockerfile` atau buat custom entrypoint yang menjalankan migration otomatis:

```dockerfile
# Tambahkan sebelum CMD
RUN php artisan migrate --force || true
RUN php artisan db:seed --force || true
```

---

## Troubleshooting

### ❌ Error: "Cannot write to storage"
**Solusi**: Storage permissions sudah di-set di Dockerfile

### ❌ Error: "APP_KEY not set"
**Solusi**: Railway akan auto-generate saat build, tapi bisa manual:
```bash
railway run php artisan key:generate
```

### ❌ Database Connection Failed
**Solusi**: 
1. Check di Railway → Project → Variables
2. Pastikan MySQL service sudah running
3. Tunggu 5-10 menit setelah MySQL di-add

### ❌ Assets tidak load (CSS/JS 404)
**Solusi**: Pastikan di Dockerfile ada:
```dockerfile
RUN npm install && npm run build
```

### ❌ Session/Cache Error
**Solusi**: 
1. Gunakan `SESSION_DRIVER=database` atau `CACHE_DRIVER=redis`
2. Pastikan Redis service sudah di-add
3. Run: `php artisan cache:clear` via SSH

### ✅ Cek Status Aplikasi
```bash
# Via SSH ke container
php artisan tinker
>>> DB::connection()->getPdo()
>>> // Jika berhasil, database OK
```

---

## Database Schema (MySQL)

Pastikan user yang di-provide oleh Railway sudah punya privileges:
```sql
GRANT ALL PRIVILEGES ON laravel_db.* TO 'user'@'%';
FLUSH PRIVILEGES;
```

(Railway sudah auto-configure ini)

---

## Fitur Production Ready

✅ Docker container  
✅ Auto HTTPS via Railway  
✅ MySQL database integration  
✅ Redis cache support  
✅ Automatic SSL certificates  
✅ Zero-downtime deployments  
✅ Environment variables management  

---

## Perkiraan Biaya Railway

- **Free Tier**: $5/bulan untuk semua services
- **Database + App**: ~$10-15/bulan (tergantung usage)
- Includes: Bandwidth, Storage, Compute

---

## Links Berguna

- Railway Docs: https://docs.railway.app
- Laravel Deployment: https://laravel.com/docs/deployment
- Railway Support: https://railway.app/support

---

## Checklist Pre-Deploy

- [ ] Repository sudah di-push ke GitHub
- [ ] `.env.production` sudah dikonfigurasi
- [ ] Dockerfile ada di root folder
- [ ] `composer.json` dan `package.json` valid
- [ ] Database migrations siap
- [ ] Storage permissions dikonfigurasi
- [ ] Rails account sudah dibuat

Semoga sukses dengan deployment! 🎉
