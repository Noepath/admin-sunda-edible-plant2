# 🚀 Alur Login dan API Integration - Admin Sunda Edible Plant

## 📋 Flow Authentication & API Access

### 1. **Login Process**
```
User Login → Firebase Auth → Admin Registration → Plants API Access
```

### 2. **Detailed Steps**

#### **Step 1: Firebase Authentication**
- User login dengan email/password
- Firebase menghasilkan ID Token
- Token diverifikasi di frontend

#### **Step 2: Admin Registration**
- **POST** `https://stapin.site/api/v1/users/admin-reg`
- **Headers**: 
  ```
  Authorization: Bearer [firebase_token]
  Content-Type: application/json
  Accept: application/json
  ```
- **Purpose**: Register user sebagai admin di backend stapin.site

#### **Step 3: Plants API Access**
- **GET** `https://stapin.site/api/v1/plants/?limit=10`
- **Headers**:
  ```
  Authorization: Bearer [firebase_token]
  Content-Type: application/json
  Accept: application/json
  ```
- **Purpose**: Mengambil data tanaman setelah admin registration berhasil

---

## 🔧 Implementation Details

### **AuthController.php**
- `login()` method sekarang melakukan:
  1. Firebase token verification
  2. Admin registration ke stapin.site
  3. Test plants API access
  4. Session storage dengan status admin

### **DashboardController.php**
- `index()` method mengambil data dari:
  1. Plants API (`/plants/?limit=10`)
  2. Users API (`/users/admin-reg`)
  3. Enhanced logging untuk debugging

### **Login View**
- Menampilkan status admin registration
- Menampilkan status plants API access
- Enhanced success message dengan informasi lengkap

### **Dashboard View**
- Session information menampilkan:
  - Email user
  - Token status
  - Admin registration status
  - API endpoint information

---

## 🛠️ Session Variables

```php
session([
    'firebase_token' => $token,           // Firebase ID Token
    'firebase_email' => $email,           // User email
    'firebase_uid' => $uid,               // Firebase UID
    'authenticated' => true,              // Auth status
    'email' => $email,                    // User email (duplicate)
    'admin_registered' => true,           // Admin registration status
    'api_status' => 'user_not_found_in_backend' // API error status
]);
```

---

## 🚨 Error Handling

### **Admin Registration Failed**
- Status: `user_not_found_in_backend`
- User tetap bisa login dengan Firebase token
- Dashboard menampilkan warning status

### **Plants API Failed**
- Fallback ke mock data
- Error message ditampilkan di dashboard
- Logging untuk debugging

---

## 📊 API Endpoints Used

| Endpoint | Method | Purpose | Headers |
|----------|--------|---------|---------|
| `/users/admin-reg` | POST | Register admin | `Authorization: Bearer [token]` |
| `/plants/?limit=10` | GET | Get plants data | `Authorization: Bearer [token]` |

---

## 🔍 Debugging

### **Browser Console**
```javascript
// Check login process
console.log('Admin Registration API Response:', response);
console.log('Plants API Test Response:', plantsResponse);
```

### **Laravel Logs**
```php
// Check API calls
Log::info('Admin Registration API Response:', [...]);
Log::info('Plants API Response:', [...]);
```

---

## ✅ Success Flow

1. **Login berhasil** → `✅ Login successful!`
2. **Admin registration berhasil** → `✅ Admin registration successful`
3. **Plants API accessible** → `🌱 Plants API accessible`
4. **Redirect ke dashboard** → Data tanaman ditampilkan

---

## 🎯 Next Steps

1. **Add diseases endpoint** ketika tersedia
2. **Implement pagination** untuk plants data
3. **Add category filtering** untuk plants
4. **Enhanced error handling** untuk API failures

---

## 🔗 cURL Example

```bash
# Admin Registration
curl -X 'POST' \
  'https://stapin.site/api/v1/users/admin-reg' \
  -H 'accept: application/json' \
  -H 'Authorization: Bearer [your_firebase_token]' \
  -H 'Content-Type: application/json'

# Get Plants Data
curl -X 'GET' \
  'https://stapin.site/api/v1/plants/?limit=10' \
  -H 'accept: application/json' \
  -H 'Authorization: Bearer [your_firebase_token]'
```
