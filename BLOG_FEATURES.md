# 📰 Blog Management System

## Overview
Blog Content Management system yang memungkinkan admin untuk membuat, mengedit, dan menghapus artikel blog yang akan ditampilkan di homepage dan halaman blog publik.

## Features

### Admin Features
- ✅ **CRUD Operations**: Buat, baca, ubah, dan hapus artikel blog
- ✅ **Rich Content Editor**: Editor HTML dengan Quill.js untuk formatting konten
- ✅ **Featured Images**: Upload gambar featured untuk setiap artikel
- ✅ **Draft & Publish**: Simpan sebagai draft atau publikasikan langsung
- ✅ **Auto Slug Generation**: Slug otomatis digenerate dari judul
- ✅ **Timestamp Tracking**: Track kapan artikel dibuat dan dipublikasikan

### Public Features
- ✅ **Blog Listing**: Tampilkan semua artikel yang sudah dipublikasikan
- ✅ **Blog Detail**: Lihat konten lengkap dari setiap artikel
- ✅ **Related Articles**: Saran artikel terkait di halaman detail
- ✅ **Homepage Integration**: Tampilkan 3 artikel terbaru di homepage
- ✅ **Pagination**: Navigasi artikel dengan pagination

## Routes

### Public Routes
```
GET  /blogs                    - Daftar semua artikel blog
GET  /blogs/{slug}             - Detail artikel blog
```

### Admin Routes
```
GET    /admin/blogs            - Daftar artikel (admin)
GET    /admin/blogs/create     - Form buat artikel
POST   /admin/blogs            - Simpan artikel baru
GET    /admin/blogs/{id}/edit  - Form edit artikel
PUT    /admin/blogs/{id}       - Update artikel
DELETE /admin/blogs/{id}       - Hapus artikel
```

## Database Schema

### Blogs Table
```sql
CREATE TABLE blogs (
    id BIGINT PRIMARY KEY
    user_id BIGINT (FK to users)
    title VARCHAR(255)
    slug VARCHAR(255) UNIQUE
    content TEXT (HTML content)
    excerpt TEXT (500 chars max)
    featured_image VARCHAR(255)
    is_published BOOLEAN
    published_at TIMESTAMP
    created_at TIMESTAMP
    updated_at TIMESTAMP
)
```

## Model

### Blog Model
```php
class Blog extends Model
{
    protected $fillable = [
        'user_id', 'title', 'slug', 'content',
        'excerpt', 'featured_image', 'is_published', 'published_at'
    ];

    // Relationship
    public function user() - Artikel ditulis oleh siapa
    
    // Accessor
    setTitleAttribute() - Auto-generate slug dari judul
}
```

## Controller Methods

### BlogController
- `index()` - Tampilkan artikel yang dipublikasikan
- `create()` - Form buat artikel baru
- `store()` - Simpan artikel baru
- `show()` - Detail artikel
- `edit()` - Form edit artikel
- `update()` - Update artikel
- `destroy()` - Hapus artikel

## Usage

### Untuk Admin
1. Login dengan akun admin
2. Klik "Kelola Blog" di navigasi
3. Klik "Artikel Baru" untuk membuat artikel
4. Isi judul, konten, dan gambar featured
5. Pilih "Publikasikan sekarang" untuk langsung dipublikasikan
6. Klik "Simpan Artikel"

### Untuk Pengguna
1. Kunjungi `/blogs` untuk melihat daftar artikel
2. Klik artikel untuk membaca selengkapnya
3. Di halaman detail, lihat artikel terkait

### Di Homepage
- 3 artikel terbaru otomatis ditampilkan
- Klik "Lihat Semua Artikel" untuk melihat semua

## Features Details

### Rich Text Editor
- Menggunakan Quill.js untuk WYSIWYG editing
- Support untuk:
  - Heading (H1, H2, H3)
  - Bold, Italic, Underline, Strike
  - Blockquote, Code Block
  - Lists (ordered & unordered)
  - Links dan Images
  - Clean formatting

### Image Upload
- Lokasi: `storage/app/public/blogs/`
- Max size: 2MB
- Supported: JPEG, PNG, JPG, GIF
- Auto-display di artikel

### Slug Generation
- Otomatis dari judul
- Kebab-case format
- Unique di database
- URL-friendly

### Authorization
- Hanya admin yang bisa create/edit/delete
- User biasa hanya bisa view
- Middleware `auth` dan `admin` melindungi routes

## Seeding

Test data tersedia di `BlogSeeder`:
- 3 artikel test otomatis dibuat saat seed
- Semua sudah dipublikasikan
- Author: Admin user

Jalankan:
```bash
php artisan db:seed --class=BlogSeeder
```

## Files Created

### Models
- `app/Models/Blog.php` - Model dengan relationship dan mutator

### Controllers
- `app/Http/Controllers/BlogController.php` - CRUD logic

### Policies
- `app/Policies/BlogPolicy.php` - Authorization rules

### Views
- `resources/views/admin/blogs/index.blade.php` - Admin list
- `resources/views/admin/blogs/create.blade.php` - Create form
- `resources/views/admin/blogs/edit.blade.php` - Edit form
- `resources/views/blogs/index.blade.php` - Public listing
- `resources/views/blogs/show.blade.php` - Article detail

### Database
- `database/migrations/2025_12_14_144813_create_blogs_table.php`
- `database/seeders/BlogSeeder.php`

### Routes
- Added in `routes/web.php`

### Navigation
- Updated `resources/views/layouts/navigation.blade.php`
- Updated `resources/views/welcome.blade.php`

## Security Features

1. **Authentication**: Only logged-in users can access admin panel
2. **Authorization**: Only admins can manage blogs
3. **CSRF Protection**: All forms protected with CSRF tokens
4. **Input Validation**: All inputs validated server-side
5. **File Upload**: Images validated for type and size
6. **XSS Protection**: HTML content properly escaped in views
7. **Published Status**: Non-published articles not visible to public

## Future Enhancements

- [ ] Categories untuk blog
- [ ] Tags untuk blog
- [ ] Comments system
- [ ] Social sharing buttons
- [ ] SEO meta descriptions
- [ ] Reading time estimator
- [ ] Search functionality
- [ ] Export to PDF
- [ ] Scheduled publishing
- [ ] Comment moderation

## Troubleshooting

### Artikel tidak muncul di homepage
- Pastikan `is_published = true`
- Pastikan `published_at` sudah diisi

### Slug conflict
- Slug otomatis unique, jadi tidak perlu khawatir
- Jika ada duplikat, tambahkan number di akhir

### Rich editor tidak tampil
- Pastikan Quill.js CDN accessible
- Check browser console untuk errors

### Images not showing
- Pastikan folder `storage/app/public/blogs/` writable
- Run `php artisan storage:link` untuk symlink

## Additional Notes

- Quill editor hanya available di create/edit forms
- Homepage menampilkan preview dengan excerpt (jika ada)
- Artikel terkait auto-generate dari 3 artikel terakhir
- User info (avatar) dari gravatar/ui-avatars service
