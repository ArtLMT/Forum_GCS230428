# 📚 StudyRoom – Student Support Forum (COMP1841 Coursework)

**StudyRoom** is a prototype CRUD web application developed for the COMP1841 Web Programming 1 module at FPT Greenwich University. It enables university students to post and manage academic questions, interact with peers, and contact administrators in a structured and secure environment.

---

## 🛠 Features

- ✅ User registration, login/logout (session-based authentication)
- ✅ Create, Read, Update, and Delete (CRUD) operations for posts
- ✅ Post association with academic modules
- ✅ Admin dashboard for managing users, posts, and modules
- ✅ Feedback/contact form for students to message admins
- ✅ User profile viewing and updating
- ✅ Role-based access control (admin vs. student)
- ✅ Simple file/image upload for posts and profiles
- ✅ Tailwind CSS styling for consistency
- ✅ Secure SQL queries via PHP PDO

---

## 🧱 Project Structure

```
/forum-website
├── /public/
│   ├── /css/
│   ├── /assets/
│   │   ├── /img/
│   │   ├── /css/
│   │   ├── /js/
│   ├── /uploads/
│   │   ├── /postAsset/
│   │   ├── /userAsset/
│   ├── .htaccess
│   └── index.php
├── /src/
│   ├── Router.php
│   ├── /controllers/
│   ├── /dal/
│   ├── /models/
│   ├── /utils/
│   └── /views/
├── /config/
│   ├── Database.php
│   └── queries.sql
└── autoload.php
```

---

## 💻 Technologies Used

| Technology           | Purpose                                              |
|----------------------|------------------------------------------------------|
| PHP 8.0+ + PDO       | Server-side logic and database interaction           |
| MySQL                | Relational database for storing application data     |
| HTML5                | Semantic page structure                              |
| Tailwind CSS 3.4.17  | Utility-first CSS for responsive UI                  |
| JavaScript           | Client-side interaction enhancements                 |
| Apache + .htaccess   | URL rewriting and routing                            |

---

Would you like the rest of the README regenerated in this cleaner format as well?

## 🚀 How to Run Locally
This guide explains how to run the Forum project locally using [XAMPP](https://www.apachefriends.org/).

---

## 📥 Clone the Repository

```bash
git clone https://github.com/ArtLMT/Forum_GCS230428.git
```

---

## 🗄️ Import the SQL Schema

1. Open **phpMyAdmin** or use the MySQL CLI via XAMPP.
2. Create a new database, for example: `forum`
3. Import the SQL file located at:

```
config/queries.sql
```

---

## ⚙️ Set Up Apache and PHP with XAMPP

1. Launch the **XAMPP Control Panel**
2. Start **Apache** and **MySQL** services
3. Ensure **mod_rewrite** is enabled (usually enabled by default in XAMPP)

---

## 📁 Project Folder Setup

1. Move the cloned repository into your `htdocs` directory:

```
C:/xampp/htdocs/forum/
```

2. Set the `DocumentRoot` to point to the `public` folder (if you're configuring Virtual Hosts manually)

---

## 🔧 Configure Database Credentials

Edit the file:

```
config/Database.php
```

And ensure the credentials match your XAMPP setup:

```php
private $host = "localhost";    // Default for XAMPP
private $db_name = "forum";     // Your created database name
private $username = "root";     // Default username
private $password = "";         // Default password (empty)
```

---

## 🔁 .htaccess Configuration

Ensure the following `.htaccess` file is placed inside the `/public` folder:

```apache
RewriteEngine On
RewriteBase /forum/public/

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^(.*)$ index.php [QSA,L]
```

---

## 🌐 Launch the Application

Visit the following URL in your browser:

```
http://localhost/forum/public/index.php
```

---

## ✅ You're All Set!

The forum application should now be running locally.
