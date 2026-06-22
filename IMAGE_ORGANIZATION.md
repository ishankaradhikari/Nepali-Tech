# Image Organization Guide

## ✓ Complete - Images Successfully Organized

All product images have been moved to a dedicated folder and properly organized.

## Folder Structure

```
NepaliTech/
└── img/
    ├── uploads/          (for user-uploaded images)
    │   └── .gitkeep
    ├── products/         (product gallery images) ✓
    │   ├── dellxps13.jpg
    │   ├── galaxys21.jpg
    │   ├── headphone.jpg
    │   ├── ipad11pro.jpg
    │   ├── iphone13.jpg
    │   ├── macbookpro14.jpg
    │   ├── omen16.jpg
    │   ├── s25ultra.jpg
    │   ├── dell-vostro.jpg
    │   ├── nothing-phone3a.jpg
    │   ├── pixel9pro.jpg
    │   ├── xiaomi14ultra.jpg
    │   └── README.md
    └── nepal-electronics.jpg (hero background)
```

## Image Usage

### Static Images (index.html)

All hardcoded image references now use:
```html
<img src="img/products/filename.jpg" alt="Product Name">
```

### Dynamic Images (Database-Driven Pages)

Products.php, Product-detail.php, and Admin pages reference images from database:

**Database Path Format:**
```
img/products/filename.jpg
```

## Adding New Product Images

### Via Admin Panel

1. Go to Admin → Manage Products → Add New Product
2. Enter product image path as: `img/products/your-image.jpg`
3. System automatically displays it correctly

### Best Practices

- **File Size**: Keep under 200KB (compress JPGs to 80-85% quality)
- **Dimensions**: 500-800px width recommended
- **Format**: JPG for photos, PNG for graphics
- **Naming**: Use lowercase, hyphens instead of spaces
  - ✓ Good: `samsung-galaxy-s21.jpg`
  - ✗ Bad: `Samsung Galaxy S21.jpg`

## File Reference Summary

| Image File | Product | Category | Status |
|-----------|---------|----------|--------|
| dellxps13.jpg | Dell XPS 13 | Laptop | ✓ |
| galaxys21.jpg | Samsung Galaxy S21 | Phone | ✓ |
| headphone.jpg | Headphones | Accessories | ✓ |
| ipad11pro.jpg | iPad Pro 11 | Tablet | ✓ |
| iphone13.jpg | iPhone 13 | Phone | ✓ |
| macbookpro14.jpg | MacBook Pro 14 | Laptop | ✓ |
| omen16.jpg | HP Omen 16 | Laptop | ✓ |
| s25ultra.jpg | Samsung S25 Ultra | Phone | ✓ |
| dell-vostro.jpg | Dell Vostro | Laptop | ✓ |
| nothing-phone3a.jpg | Nothing Phone 3a | Phone | ✓ |
| pixel9pro.jpg | Google Pixel 9 Pro | Phone | ✓ |
| xiaomi14ultra.jpg | Xiaomi 14 Ultra | Phone | ✓ |

## Code Changes Made

### 1. Database (database_setup.sql)

Updated all image paths:
```sql
-- Before
'galaxys21.jpg'

-- After  
'img/products/galaxys21.jpg'
```

### 2. Homepage (index.html)

Updated static image references:
```html
<!-- Before -->
<img src="galaxys21.jpg" alt="...">

<!-- After -->
<img src="img/products/galaxys21.jpg" alt="...">
```

### 3. Dynamic Pages (No changes needed)

Product pages automatically use database paths:
- products.php
- product-detail.php
- Admin/manage-products.php

## Uploading to GitHub

### .gitignore Already Configured

```
# Keep products folder but ignore user uploads
/img/uploads/*
!img/uploads/.gitkeep
```

- ✓ `img/products/` - **INCLUDED** (all product images uploaded)
- ✗ `img/uploads/` - **IGNORED** (user uploads, stored locally only)

## Admin Panel Usage

When adding/editing products:

```
Image URL field: img/products/your-image.jpg
```

The system will:
- Store the path in database
- Display correctly on all pages
- Scale images responsively with CSS

## Troubleshooting

### Images Not Displaying

**Check:**
1. Image file exists in `/img/products/`
2. Database has correct path: `img/products/filename.jpg`
3. File name is correct (case-sensitive on Linux servers)
4. File is named without spaces

### Upload Issues

- Max file size: Configure in `php.ini` if needed
- Default XAMPP allows 2MB per file
- Compress images before uploading

## Performance Tips

1. **Optimize Images**
   ```bash
   # Use online tools or:
   # ImageOptim (Mac), FileOptimizer (Windows), or
   # GIMP for batch processing
   ```

2. **Image Compression**
   - JPG: 80-85% quality
   - PNG: 8-bit where possible
   - WebP: For modern browsers (if supported)

3. **Responsive Images**
   - Currently CSS handles scaling
   - Consider srcset for multiple resolutions

## Future Enhancements

- [ ] Image upload validation
- [ ] Thumbnail generation
- [ ] Image lazy loading
- [ ] WebP format support
- [ ] CDN integration

---

**Last Updated**: June 2026  
**Status**: ✓ Complete and Operational
