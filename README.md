# Nepali Tech - E-Market Finder

A web-based electronic products marketplace finder for Nepal with admin panel to manage products.

## Features

- **Product Browsing**: Search and filter electronic products by category, brand, and price
- **Product Management**: Admin panel to add, edit, and delete products
- **Inventory Tracking**: Track product availability (in stock/out of stock)
- **Contact System**: Customer messages contact form
- **Responsive Design**: Mobile-friendly interface
- **Database Integration**: MySQL database for persistent storage

## Tech Stack

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla JS)
- **Backend**: PHP 7.4+
- **Database**: MySQL 5.7+
- **Server**: Apache (XAMPP)

## Project Structure

```
NepaliTech/
├── Admin/                    # Admin panel pages
│   ├── dashboard.php        # Admin dashboard
│   ├── login.php            # Admin login
│   ├── logout.php           # Admin logout
│   └── manage-products.php  # Product management
├── css/
│   └── style.css            # Main stylesheet
├── img/
│   └── uploads/             # Product images directory
├── js/
│   └── script.js            # Main JavaScript file
├── php/
│   ├── db_connect.php       # Database connection
│   ├── functions.php        # Helper functions
│   └── database_setup.sql   # Database schema
├── index.html               # Home page
├── products.php             # Products listing page
├── product-detail.php       # Product detail page
├── contact.php              # Contact form page
├── setup.php                # Database setup (run once)
└── README.md                # This file
```

## Installation

### Prerequisites

- XAMPP (PHP 7.4+, MySQL 5.7+, Apache)
- A modern web browser

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/NepaliTech.git
   cd NepaliTech
   ```

2. **Place in XAMPP directory**
   ```bash
   # Copy to XAMPP's htdocs folder
   cp -r NepaliTech C:/xampp/htdocs/
   ```

3. **Start XAMPP services**
   - Start Apache and MySQL from XAMPP Control Panel

4. **Initialize Database**
   - Open your browser and navigate to: `http://localhost/NepaliTech/setup.php`
   - This will create the database and insert sample data
   - Database name: `nepali_e_market`

5. **Access the application**
   - Home page: `http://localhost/NepaliTech/index.html`
   - Products: `http://localhost/NepaliTech/products.php`
   - Admin: `http://localhost/NepaliTech/Admin/login.php`

## Admin Login

**Default Credentials** (for demo only):
- Username: `admin`
- Password: `1234`

**Important**: Change these credentials in production!

## Database Configuration

Edit `php/db_connect.php` to configure your database:

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "nepali_e_market";
```

## Features Details

### Product Management
- Add new products with images, specs, and pricing
- Edit product information
- Toggle product availability
- Delete products

### Search & Filter
- Search products by name, brand, or specifications
- Filter by category
- Filter by brand
- Filter by price range

### Admin Dashboard
- View total products count
- Track in-stock and out-of-stock items
- View customer messages
- Quick access to product management

## File Descriptions

| File | Purpose |
|------|---------|
| `index.html` | Home page with featured products |
| `products.php` | Products listing with filters |
| `contact.php` | Contact form for customers |
| `php/db_connect.php` | Database connection setup |
| `php/functions.php` | Reusable PHP functions |
| `css/style.css` | All styling rules |
| `js/script.js` | Client-side interactions |
| `Admin/dashboard.php` | Admin overview page |
| `Admin/manage-products.php` | Product CRUD operations |

## Security Notes

1. Change default admin credentials immediately
2. Sanitize all user inputs (already implemented)
3. Use prepared statements for database queries
4. Implement proper authentication in production
5. Set proper file permissions
6. Never commit database credentials

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Future Enhancements

- [ ] User authentication system
- [ ] Shopping cart functionality
- [ ] Payment integration
- [ ] Email notifications
- [ ] Product ratings and reviews
- [ ] Advanced analytics
- [ ] Multi-language support

## Troubleshooting

### Database Connection Error
- Ensure MySQL is running in XAMPP
- Verify database credentials in `php/db_connect.php`
- Check database exists: `nepali_e_market`

### Images Not Showing
- Check image paths in database
- Verify images exist in `img/uploads/`
- Check file permissions

### Admin Login Issues
- Clear browser cache
- Check session settings in PHP
- Verify database tables created

## Contributing

1. Fork the repository
2. Create feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open Pull Request

## License

This project is open source and available under the MIT License.

## Support

For support, email: info@nepalitech.com

## Author

Nepali Tech Team

---

**Last Updated**: June 2026  
**Version**: 1.0.0
