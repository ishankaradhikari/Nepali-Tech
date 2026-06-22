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
│   └── style.css            # Main stylesheet with custom properties
├── img/
│   ├── products/            # Product gallery images
│   │   └── *.jpg            # Product images (centralized)
│   └── uploads/             # User-uploaded images directory
├── js/
│   └── script.js            # Client-side interactions
├── php/
│   ├── db_connect.php       # Database connection configuration
│   ├── db_connect.example.php  # Configuration template
│   ├── functions.php        # Helper functions
│   └── database_setup.sql   # Database schema & sample data
├── index.html               # Home page with hero & featured products
├── products.php             # Products listing with filters
├── product-detail.php       # Individual product details
├── contact.php              # Customer contact form
├── setup.php                # Database initialization (run once)
├── .gitignore               # Git exclusion rules
├── .gitattributes           # Line ending normalization
├── LICENSE                  # MIT License
├── SETUP.md                 # Detailed setup instructions
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

## Image Management

All product images are centralized in the `img/products/` folder for better organization.

### Adding Product Images

1. **Upload image to**: `img/products/` folder
2. **Naming convention**: Use lowercase with hyphens (e.g., `samsung-galaxy-s25.jpg`)
3. **Supported formats**: JPG, PNG
4. **File size**: Keep under 200KB (compress JPGs to 80-85% quality)

### Image Paths in Database

When adding products via admin panel, enter image path as:
```
img/products/your-image.jpg
```

The system automatically displays images correctly across all pages:
- Home page featured products
- Product listing page
- Product detail pages
- Admin product management

### Example: Adding a New Product

1. Go to `Admin/dashboard.php` → Manage Products
2. Click "Add New Product"
3. Enter product details and image path: `img/products/productname.jpg`
4. Save - image will display automatically



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

| File/Folder | Purpose |
|---|---|
| `index.html` | Home page with hero section, search, and featured products |
| `products.php` | Products listing page with category, brand, and price filters |
| `product-detail.php` | Individual product detail page |
| `contact.php` | Customer contact form page |
| `php/db_connect.php` | Database connection configuration |
| `php/db_connect.example.php` | Template for database configuration (shows structure without credentials) |
| `php/functions.php` | Reusable PHP helper functions |
| `php/database_setup.sql` | Database schema and sample product data |
| `css/style.css` | Complete styling with CSS custom properties (variables) |
| `js/script.js` | Client-side JavaScript for interactions |
| `img/products/` | **Product gallery images** (organized centrally) |
| `img/uploads/` | User-uploaded images directory (excluded from git) |
| `Admin/dashboard.php` | Admin overview with product statistics |
| `Admin/login.php` | Admin authentication page |
| `Admin/logout.php` | Admin logout handler |
| `Admin/manage-products.php` | Product CRUD operations (add, edit, delete) |
| `setup.php` | Database initialization script (run once after installation) |
| `.gitignore` | Files excluded from version control (credentials, uploads, cache) |
| `.gitattributes` | Ensures consistent line endings across platforms |

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
