# 📋 SmartTask – Smart To-Do & Task Management System

<div align="center">

![SmartTask Banner](https://img.shields.io/badge/SmartTask-Task%20Manager-4F46E5?style=for-the-badge)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=flat-square&logo=tailwind-css)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

**SmartTask** adalah aplikasi manajemen tugas modern yang dirancang untuk membantu Anda mengatur, mengelompokkan, dan memonitor aktivitas harian dengan lebih rapi dan efisien.

[Demo](#-demo-akun) • [Fitur](#-fitur-utama) • [Instalasi](#-instalasi) • [Dokumentasi](#-dokumentasi-api)

</div>

---

## 🎯 Tentang SmartTask

SmartTask adalah solusi manajemen tugas yang powerful dan mudah digunakan, dibangun dengan teknologi web modern. Dengan antarmuka yang intuitif dan fitur-fitur canggih, SmartTask membantu Anda tetap produktif dan terorganisir.

### 👥 Cocok untuk:
- 🎓 Pelajar & Mahasiswa
- 💼 Profesional & Karyawan
- 🎨 Freelancer & Creator
- 👨‍💼 Project Manager
- ✨ Siapa saja yang ingin meningkatkan produktivitas

---

## ✨ Fitur Utama

### 📝 Manajemen Tugas yang Powerful
- ✅ CRUD lengkap (Create, Read, Update, Delete)
- 📅 Penentuan deadline dengan calendar picker
- 🎯 Status tracking: To-Do → In-Progress → Done
- 🔥 Level prioritas: Low, Medium, High
- 📊 Progress tracking visual

### 🗂️ Organisasi dengan Kategori
- 🏷️ Kategori dinamis (Work, Study, Personal, Urgent, dll)
- 🎨 Color-coded categories
- 🔍 Filter dan sort berdasarkan kategori
- ⚡ Quick filter untuk akses cepat

### ⏰ Smart Reminder & Deadline Tracker
- 🔔 Notifikasi tugas mendekati deadline
- ⚠️ Highlight otomatis untuk tugas overdue
- 📆 Calendar view untuk overview bulanan
- ⏱️ Countdown timer untuk task mendesak

### 🔍 Smart Search & Filter
- 🔎 Real-time search
- 🎯 Filter multi-criteria (kategori, status, prioritas, tanggal)
- 💡 Autocomplete suggestions
- 📱 Mobile-friendly search interface

### 🎨 Modern UI/UX
- 🌙 Light & Dark mode dengan smooth transition
- 📱 Fully responsive (Mobile, Tablet, Desktop)
- ✨ Smooth animations & transitions
- 🎯 Clean dan minimalist design
- ♿ Accessible (WCAG compliant)

### 👤 User Management
- 🔐 Secure authentication (Laravel Breeze/Sanctum)
- 👥 User profile management
- 🖼️ Photo profile upload
- 🔒 Password encryption (bcrypt)
- ✉️ Email verification
- 🔑 Password reset functionality

### ⚡ Performance & Security
- 🚀 Fast loading dengan lazy loading
- 🔒 CSRF protection
- 🛡️ XSS prevention
- 📦 Database query optimization
- 💾 Efficient caching strategy

---

## 🛠️ Tech Stack

<table>
<tr>
<td align="center" width="33%">

### Backend
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel)

RESTful API, Authentication, Database Management

</td>
<td align="center" width="33%">

### Frontend
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?style=flat-square&logo=tailwind-css)

Responsive UI, Modern Design System

</td>
<td align="center" width="33%">

### Database
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=flat-square&logo=mysql)

Reliable Data Storage

</td>
</tr>
</table>

### Detail Teknologi

| Layer | Teknologi | Fungsi |
|-------|-----------|--------|
| **Backend Framework** | Laravel 10 | Core application & business logic |
| **Template Engine** | Blade | Server-side rendering |
| **CSS Framework** | TailwindCSS 3 | Utility-first styling |
| **Database** | MySQL / MariaDB | Data persistence |
| **JavaScript** | Alpine.js / Vanilla JS | Interactive components |
| **Authentication** | Laravel Breeze | User authentication system |
| **File Storage** | Laravel Storage | Profile picture management |
| **API** | Laravel API Resources | RESTful endpoints |
| **Validation** | Laravel Form Requests | Input validation |

---

## 🚀 Instalasi

### 📋 Prerequisites

Pastikan sistem Anda memiliki:
- PHP >= 8.1
- Composer >= 2.5
- Node.js >= 18.x & NPM >= 9.x
- MySQL >= 8.0 atau MariaDB >= 10.x
- Git

### 📥 Step-by-Step Installation

#### 1️⃣ Clone Repository
```bash
git clone https://github.com/USERNAME/SmartTask.git
cd SmartTask
```

#### 2️⃣ Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

#### 3️⃣ Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 4️⃣ Database Setup
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smarttask
DB_USERNAME=root
DB_PASSWORD=your_password
```

Buat database baru:
```bash
# MySQL
mysql -u root -p
CREATE DATABASE smarttask;
EXIT;
```

#### 5️⃣ Database Migration & Seeding
```bash
# Run migrations
php artisan migrate

# Seed dengan data sample (opsional)
php artisan db:seed

# Atau jalankan sekaligus
php artisan migrate:fresh --seed
```

#### 6️⃣ Storage Setup
```bash
# Create symbolic link untuk storage
php artisan storage:link
```

#### 7️⃣ Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

#### 8️⃣ Run Application
```bash
# Start Laravel development server
php artisan serve

# Aplikasi akan berjalan di: http://localhost:8000
```

### 🐳 Docker Installation (Alternative)
```bash
# Coming soon
docker-compose up -d
```

---

## 🔐 Demo Akun

Gunakan akun berikut untuk testing (jika menjalankan seeder):

| Role | Email | Password |
|------|-------|----------|
| 👤 **User** | user@gmail.com | password123 |
| 👑 **Admin** | admin@gmail.com | admin12345 |

> ⚠️ **Note**: Jangan gunakan password ini di production!

---

## 📁 Struktur Project

```
SmartTask/
├── 📂 app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── TaskController.php      # Task CRUD operations
│   │   │   ├── CategoryController.php  # Category management
│   │   │   └── ProfileController.php   # User profile
│   │   ├── Requests/                   # Form validation
│   │   └── Middleware/                 # Custom middleware
│   ├── Models/
│   │   ├── Task.php                    # Task model
│   │   ├── Category.php                # Category model
│   │   └── User.php                    # User model
│   └── Services/                       # Business logic
│
├── 📂 resources/
│   ├── views/
│   │   ├── tasks/
│   │   │   ├── index.blade.php        # Task list
│   │   │   ├── create.blade.php       # Create task
│   │   │   ├── edit.blade.php         # Edit task
│   │   │   └── show.blade.php         # Task detail
│   │   ├── categories/                # Category views
│   │   ├── profile/                   # User profile
│   │   ├── layouts/
│   │   │   └── app.blade.php          # Main layout
│   │   └── components/                # Reusable components
│   ├── css/
│   └── js/
│
├── 📂 routes/
│   ├── web.php                        # Web routes
│   ├── api.php                        # API routes
│   └── auth.php                       # Authentication routes
│
├── 📂 database/
│   ├── migrations/                    # Database migrations
│   ├── seeders/                       # Database seeders
│   └── factories/                     # Model factories
│
├── 📂 public/
│   ├── storage/                       # Symlink to storage
│   └── assets/                        # Static assets
│
└── 📂 tests/                          # Unit & Feature tests
```

---

## 📚 Dokumentasi API

### Authentication
```http
POST /api/login
POST /api/register
POST /api/logout
```

### Tasks Endpoints
```http
GET    /api/tasks              # Get all tasks
GET    /api/tasks/{id}         # Get single task
POST   /api/tasks              # Create new task
PUT    /api/tasks/{id}         # Update task
DELETE /api/tasks/{id}         # Delete task
```

### Example Request
```javascript
// Fetch all tasks
fetch('/api/tasks', {
    headers: {
        'Authorization': 'Bearer ' + token,
        'Content-Type': 'application/json'
    }
})
.then(response => response.json())
.then(data => console.log(data));
```

### Example Response
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Complete project documentation",
            "description": "Write comprehensive docs",
            "status": "in_progress",
            "priority": "high",
            "deadline": "2025-12-31",
            "category": {
                "id": 1,
                "name": "Work",
                "color": "#3B82F6"
            }
        }
    ]
}
```

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --filter TaskTest

# Run with coverage
php artisan test --coverage
```

---

## 📸 Screenshots

> 🚧 Coming soon - tambahkan screenshot aplikasi Anda di sini

---

## 🗺️ Roadmap

- [ ] 📱 Mobile app (React Native / Flutter)
- [ ] 🔔 Push notifications
- [ ] 👥 Team collaboration features
- [ ] 📊 Advanced analytics & reports
- [ ] 🌐 Multi-language support
- [ ] 🎯 Gamification (badges, points)
- [ ] 📤 Export to PDF/Excel
- [ ] 🔄 Task templates
- [ ] 🤖 AI-powered task suggestions

---

## 🤝 Contributing

Kontribusi sangat diterima! Berikut cara berkontribusi:

1. Fork repository ini
2. Buat branch baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

Baca [CONTRIBUTING.md](CONTRIBUTING.md) untuk detail lebih lanjut.

---

## 📝 License

Project ini menggunakan lisensi **MIT License** - lihat file [LICENSE](LICENSE) untuk detail.

---

## 👨‍💻 Author

**Your Name**
- GitHub: [@yourusername](https://github.com/yourusername)
- Email: your.email@example.com
- LinkedIn: [Your Profile](https://linkedin.com/in/yourprofile)

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [TailwindCSS](https://tailwindcss.com) - Utility-first CSS
- [Heroicons](https://heroicons.com) - Beautiful icons
- Semua kontributor yang telah membantu project ini

---

## 💬 Support

Jika Anda menemukan bug atau memiliki saran:
- 🐛 [Report Bug](https://github.com/USERNAME/SmartTask/issues)
- 💡 [Request Feature](https://github.com/USERNAME/SmartTask/issues)
- 📧 Email: support@smarttask.com

---

<div align="center">

### ⭐ Jika project ini bermanfaat, berikan Star di GitHub!

**Made with ❤️ using Laravel & TailwindCSS**

[⬆ Back to Top](#-smarttask--smart-to-do--task-management-system)

</div>