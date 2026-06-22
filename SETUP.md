# Setup Guide - Nepali Tech

Complete guide to set up the Nepali Tech application on your local machine.

## Prerequisites

- **XAMPP** (or equivalent - Apache, PHP 7.4+, MySQL 5.7+)
- **Git** for version control
- **Web Browser** (Chrome, Firefox, Safari, or Edge)
- **Text Editor** (VS Code, Sublime Text, etc.)

## Step-by-Step Installation

### 1. Download XAMPP

If not already installed, download from: https://www.apachefriends.org/

### 2. Clone/Download Project

**Option A: Using Git**
```bash
git clone https://github.com/yourusername/NepaliTech.git
cd NepaliTech
```

**Option B: Manual Download**
- Download ZIP from GitHub
- Extract to a folder on your computer

### 3. Place in XAMPP Directory

Copy the NepaliTech folder to XAMPP's htdocs:

**Windows:**
```
C:\xampp\htdocs\NepaliTech\
```

**macOS:**
```
/Applications/XAMPP/htdocs/NepaliTech/
```

**Linux:**
```
/opt/lampp/htdocs/NepaliTech/
```

### 4. Start XAMPP Services

1. Open XAMPP Control Panel
2. Click "Start" for:
   - Apache
   - MySQL

**Verify:**
- Apache Status: Running ✓
- MySQL Status: Running ✓

### 5. Initialize Database

1. Open web browser
2. Navigate to: `http://localhost/NepaliTech/setup.php`
3. You should see:
   ```
   ✓ Database 'nepali_e_market' created successfully or already exists.
   ✓ Tables prepared
   ✓ Tables created
   ✓ Sample data inserted (10 products)
   ✓ Database setup complete! 10 products in database
   ```

4. Click one of the action buttons or navigate manually

### 6. Verify Installation

Access these URLs in your browser:

**Home Page:**
```
http://localhost/NepaliTech/index.html
```
✓ Should show featured products and categories

**Products Page:**
```
http://localhost/NepaliTech/products.php
```
✓ Should display all 10 sample products with filters

**Admin Login:**
```
http://localhost/NepaliTech/Admin/login.php
```
✓ Should show admin login form

### 7. Login to Admin

**Credentials:**
- Username: `admin`
- Password: `1234`

**Navigate to:**
```
http://localhost/NepaliTech/Admin/dashboard.php
```

✓ Should display dashboard with product statistics

## Configuration

### Database Configuration

Edit `php/db_connect.php`:

```php
$host = "localhost";      // Your database host
$username = "root";       // MySQL username
$password = "";           // MySQL password
$database = "nepali_e_market";
```

### Change Admin Password

1. Connect to MySQL (via phpMyAdmin)
2. Find the admin table (if exists) or update in login logic
3. Change default credentials in `Admin/login.php`

## Troubleshooting

### Issue: "Database connection failed"

**Solution:**
- Ensure MySQL is running in XAMPP
- Verify credentials in `php/db_connect.php`
- Check database name: `nepali_e_market`

```bash
# In XAMPP MySQL command line
SHOW DATABASES;
USE nepali_e_market;
SHOW TABLES;
```

### Issue: "Table 'nepali_e_market.products' doesn't exist"

**Solution:**
- Run database setup again: `http://localhost/NepaliTech/setup.php`
- Or manually run the SQL: `php/database_setup.sql`

### Issue: Images not displaying

**Solution:**
- Check image paths in database
- Verify image files in `img/uploads/`
- Check file permissions

```bash
# Check uploads folder permissions
ls -la img/uploads/
```

### Issue: Admin login not working

**Solution:**
- Clear browser cache (Ctrl+Shift+Delete)
- Check PHP sessions directory has write permissions
- Verify session settings in `php.ini`

### Issue: 404 error on pages

**Solution:**
- Ensure Apache is running
- Verify XAMPP htdocs path is correct
- Check file names match URL paths exactly

## Database Structure

### Products Table

```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    specs TEXT,
    availability INT DEFAULT 1,
    image_url VARCHAR(255)
);
```

### Contact Messages Table

```sql
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## File Permissions

Ensure these folders are writable:

```bash
chmod 755 img/uploads/
chmod 755 php/
```

## Performance Tips

1. **Enable Gzip Compression** in Apache
2. **Cache static assets** (CSS, JS, images)
3. **Optimize database queries**
4. **Minify CSS and JavaScript**
5. **Compress images**

## Security Checklist

- [ ] Change default admin credentials
- [ ] Restrict `.php` file access
- [ ] Enable HTTPS in production
- [ ] Sanitize all user inputs
- [ ] Use prepared statements
- [ ] Set proper file permissions
- [ ] Disable directory listing
- [ ] Remove setup.php from production

## PhpMyAdmin Access

Access database management tool:

```
http://localhost/phpmyadmin
```

Login with your MySQL credentials

## Next Steps

1. Customize the application
2. Add more products
3. Customize styling with CSS
4. Add additional features
5. Deploy to production server

## Support

- Documentation: See README.md
- Contributing: See CONTRIBUTING.md
- Issues: Create GitHub issue
- Email: info@nepalitech.com

---

**Congratulations!** Your Nepali Tech installation is ready! 🎉
