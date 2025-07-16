# TESTING CREDENTIALS

Gunakan kredensial berikut untuk testing aplikasi:

**🔥 Firebase Project:** `backend-deteksi-penyakit`

## Email & Password Dummy untuk Testing:

### Admin Testing:
- **Email:** admin@test.com
- **Password:** password123

### User Testing:
- **Email:** user@demo.com
- **Password:** demo123456

### Developer Testing:
- **Email:** dev@firebase.com
- **Password:** firebase123

### General Testing:
- **Email:** test@example.com
- **Password:** test123456

## Cara Testing:

### Quick Test (Recommended):
1. Buka: http://127.0.0.1:3000/register
2. Gunakan: `admin@test.com` / `password123`
3. Klik "Create Account"
4. Setelah berhasil, langsung login

### Manual Login:
1. Buka: http://127.0.0.1:3000/login
2. Gunakan salah satu email dummy di atas
3. Sistem akan otomatis register jika belum ada

## Catatan:
- **Project ID:** backend-deteksi-penyakit
- Email dummy ini akan otomatis terdaftar di Firebase
- Password minimal 6 karakter
- Gunakan email apapun dengan domain @test.com, @demo.com, @firebase.com untuk testing
- Sistem akan menerima email dummy dan membuatnya di Firebase Authentication

## ⚠️ Info Penting - API stapin.site:

### **Status API:**
- ✅ **Firebase Authentication:** Berhasil
- ✅ **Token Generation:** Berhasil
- ❌ **stapin.site Backend:** User tidak ditemukan

### **Error yang Muncul:**
```
API call failed: {"detail":"Akun tidak ditemukan"}
```

### **Penjelasan:**
1. Firebase authentication bekerja dengan sempurna
2. Token Firebase berhasil dibuat dan dikirim ke API
3. API `https://stapin.site/api/v1/users/admin-reg` mengembalikan "Akun tidak ditemukan"
4. Ini berarti user perlu didaftarkan di backend stapin.site terlebih dahulu

### **Solusi:**
- **Option 1:** Daftar user di sistem backend stapin.site dulu
- **Option 2:** Gunakan user yang sudah terdaftar di backend stapin.site
- **Option 3:** Sistem tetap bisa digunakan meski API gagal (Firebase auth berhasil)

### **Untuk Testing:**
Aplikasi tetap bisa ditest dan berfungsi normal. Setelah login (meski ada error API), Anda tetap bisa masuk ke dashboard dan melihat:
- ✅ Firebase Token aktif
- ✅ Session information
- ✅ Authentication status
- ⚠️ Warning bahwa user belum terdaftar di backend

## 🚀 **Cara Menggunakan Token di API Testing:**

### **Step 1: Dapatkan Firebase Token**
1. Buka: http://127.0.0.1:3000/login
2. Login dengan email dummy: `admin@test.com` / `password123`
3. Setelah login berhasil, klik tombol **"🔗 Copy Token"**
4. Token Firebase sudah tersalin ke clipboard

### **Step 2: Gunakan Token di API Interface**
Di Swagger/Postman/API Testing Interface:
- **Authorization Type:** `Bearer Token` atau `HTTPBearer`
- **Value:** Paste token yang sudah di-copy
- **Format:** Token akan otomatis dengan format `Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6...`

### **Step 3: Test API Endpoints**
Dengan token yang sudah di-authorize, test endpoint:
- ✅ `GET /api/v1/tests/` - Ping test
- ✅ `POST /api/v1/plants/` - Add new plant
- ✅ `GET /api/v1/plants/` - Get all plants
- ✅ `PATCH /api/v1/plants/{plant_id}` - Update plant
- ✅ `DELETE /api/v1/plants/{plant_id}` - Delete plant

### **💡 Tips:**
- Token Firebase berlaku selama 1 jam
- Jika token expired, login ulang untuk mendapat token baru
- Copy token dari dashboard juga bisa: http://127.0.0.1:3000/dashboard
- Token bisa digunakan di Postman, Insomnia, atau Swagger UI

## 🧪 **Script Testing API (PowerShell):**

Untuk memudahkan testing, gunakan script `test-api.ps1`:

```powershell
# 1. Login ke Laravel app dan copy token
# 2. Edit file test-api.ps1, ganti $firebaseToken dengan token dari browser
# 3. Jalankan: .\test-api.ps1
```

**Script akan test:**
- ✅ `PATCH /api/v1/users/` - Update user profile
- ✅ `GET /api/v1/users/me` - Get current user info  
- ✅ `GET /api/v1/tests/` - Ping test

## 🔍 **Manual Testing dengan cURL:**

```bash
# Dapatkan token dari Laravel app dulu
TOKEN="eyJhbGciOiJSUzI1NiIsImtpZCI6..."

# Test update user
curl -X PATCH "https://stapin.site/api/v1/users/" \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"email": "admin@test.com", "name": "Admin Test Updated"}'

# Test get current user  
curl -X GET "https://stapin.site/api/v1/users/me" \
  -H "Authorization: Bearer $TOKEN"
```

## ⚠️ **Troubleshooting:**

### **"Invalid or expired token":**
1. Login ulang ke http://127.0.0.1:3000/login
2. Copy token yang baru
3. Update token di API testing interface/script

### **"Akun tidak ditemukan":**
- User Firebase belum terdaftar di backend stapin.site
- Perlu registrasi user di sistem backend terlebih dahulu
