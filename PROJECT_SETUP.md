# Admin Sunda Edible Plant - Laravel Fireb## Updated Firebase Configuration

### **NEW PROJECT CREDENTIALS:**
The application now uses the **admin-auth-b015e** Firebase project with the following configuration:

```env
FIREBASE_PROJECT_ID=admin-auth-b015e
FIREBASE_AUTH_DOMAIN=admin-auth-b015e.firebaseapp.com
```

### **Service Account Authentication:**
- Server-side Firebase token verification is now enabled
- Service account credentials are stored in `storage/app/firebase-service-account.json`
- Enhanced security with proper Firebase Admin SDK integration

## How to Login

### **Step 1: Create Firebase User**
Since we're using a new Firebase project (admin-auth-b015e), you need to create users in this project:

**Option A: Use the Registration Page**
1. Go to: **http://127.0.0.1:3000/register**
2. Create a new account with any email/password
3. The system will automatically register the user in Firebase

**Option B: Use Firebase Console**
1. Go to [Firebase Console](https://console.firebase.google.com/)
2. Select project: **admin-auth-b015e**
3. Go to Authentication > Users
4. Add user manually

### **Step 2: Login**
1. Go to: **http://127.0.0.1:3000/login**
2. Use the email/password you created
3. System will:
   - ✅ Authenticate with Firebase frontend
   - ✅ Verify token on Laravel backend  
   - ✅ Send token to stapin.site API
   - ✅ Create secure session

## Features Added

### **Enhanced Security:**
- ✅ Server-side Firebase token verification
- ✅ Service account authentication
- ✅ Secure credential storage
- ✅ Graceful fallback if verification fails

### **Better User Experience:**
- ✅ Registration page for easy testing
- ✅ Improved error handling
- ✅ Real Firebase UID tracking
- ✅ Enhanced session managements is a Laravel application that integrates with Firebase authentication and makes API calls to the stapin.site backend.

## Features

- Firebase Authentication using Firebase SDK
- Laravel backend integration
- Secure token handling with Bearer authorization
- API integration with https://stapin.site/api/v1/users/admin-reg
- Modern, responsive UI with Tailwind CSS

## Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer

### Installation Steps

1. **Install PHP dependencies:**
   ```bash
   composer install
   ```

2. **Environment Configuration:**
   The `.env` file is already configured with Firebase settings:
   ```env
   FIREBASE_API_KEY=AIzaSyDHYngdkHJGzW_w1xE-VG-5TBx7hz4NAxQ
   FIREBASE_AUTH_DOMAIN=backend-deteksi-penyakit.firebaseapp.com
   FIREBASE_PROJECT_ID=backend-deteksi-penyakit
   FIREBASE_STORAGE_BUCKET=backend-deteksi-penyakit.firebasestorage.app
   FIREBASE_MESSAGING_SENDER_ID=197096770916
   FIREBASE_APP_ID=1:197096770916:web:0e8a864ab1f051fda6fe71
   FIREBASE_MEASUREMENT_ID=G-FYSXX6DQL9
   ```

3. **Start the development server:**
   ```bash
   php artisan serve
   ```

## Usage

### Login Process

1. **Access the login page:**
   - Navigate to `http://127.0.0.1:8000/login`
   - Enter your Firebase-registered email and password

2. **Firebase Authentication:**
   - The application uses Firebase Authentication to verify credentials
   - Upon successful authentication, Firebase returns an ID token

3. **API Integration:**
   - The Firebase token is automatically sent to `https://stapin.site/api/v1/users/admin-reg`
   - The token is included in the Authorization header as `Bearer <token>`
   - Successful API response indicates complete authentication flow

4. **Dashboard Access:**
   - After successful login and API call, you'll be redirected to `/dashboard`
   - The dashboard shows authentication status and session information

### Routes

- `GET /` - Redirects to login page
- `GET /login` - Shows the login form
- `POST /login` - Handles login authentication
- `GET /dashboard` - Protected dashboard (requires Firebase authentication)
- `GET /logout` - Logs out the user and clears session

### Authentication Flow

```
1. User enters credentials on login form
   ↓
2. Frontend authenticates with Firebase
   ↓
3. Firebase returns ID token
   ↓
4. Token sent to Laravel backend (/login POST)
   ↓
5. Laravel verifies token with Firebase
   ↓
6. Laravel makes API call to stapin.site with Bearer token
   ↓
7. Successful response → user session created
   ↓
8. User redirected to dashboard
```

## Technical Details

### Dependencies

- **Laravel 12.x** - PHP framework
- **kreait/firebase-php** - Firebase SDK for PHP
- **Firebase Web SDK 10.7.1** - Frontend Firebase integration
- **Tailwind CSS** - Styling framework

### Key Files

- `app/Http/Controllers/AuthController.php` - Handles authentication logic
- `app/Http/Controllers/DashboardController.php` - Dashboard functionality
- `app/Http/Middleware/FirebaseAuth.php` - Authentication middleware
- `app/Providers/FirebaseServiceProvider.php` - Firebase service configuration
- `config/firebase.php` - Firebase configuration
- `resources/views/auth/login.blade.php` - Login form view
- `resources/views/dashboard.blade.php` - Dashboard view

## API Integration

The application integrates with the external API at `https://stapin.site/api/v1/users/admin-reg`:

- **Method:** POST
- **Headers:**
  - `Authorization: Bearer <firebase_token>`
  - `Content-Type: application/json`
- **Purpose:** Admin registration/verification with Firebase token

## Server Status

✅ **Laravel development server is currently running on http://127.0.0.1:8000**

You can access the application at:
- Login page: http://127.0.0.1:8000/login
- Dashboard: http://127.0.0.1:8000/dashboard (after login)

## Quick Start

1. The project is already set up and running
2. Go to http://127.0.0.1:8000/login
3. Enter your Firebase credentials
4. Upon successful login, you'll be redirected to the dashboard
5. The system will automatically hit the stapin.site API with your Firebase token

## Troubleshooting

### Common Issues

1. **Firebase Authentication Errors:**
   - Verify Firebase configuration in `.env`
   - Check if email/password exists in Firebase Auth

2. **API Call Failures:**
   - Ensure the stapin.site API is accessible
   - Verify Firebase token is valid
   - Check network connectivity

3. **Laravel Errors:**
   - Run `composer install` to ensure all dependencies are installed
   - Clear caches with `php artisan optimize:clear`
