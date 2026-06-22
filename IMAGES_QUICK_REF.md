# Quick Reference - Image Management

## Current Setup

```
img/products/ 
├── dellxps13.jpg
├── dell-vostro.jpg
├── galaxys21.jpg
├── headphone.jpg
├── ipad11pro.jpg
├── iphone13.jpg
├── macbookpro14.jpg
├── nothing-phone3a.jpg
├── omen16.jpg
├── pixel9pro.jpg
├── s25ultra.jpg
└── xiaomi14ultra.jpg
```

## Image Paths in Code

### Static References (index.html)
```html
<img src="img/products/galaxys21.jpg" alt="Product">
```

### From Root Pages (products.php, product-detail.php)
```php
<img src="<?php echo $product['image_url']; ?>" alt="Product">
<!-- Database stores: img/products/filename.jpg -->
```

### From Admin Pages (Admin/manage-products.php)
```php
<img src="../<?php echo $product['image_url']; ?>" alt="Product">
<!-- ../ navigates to parent, then img/products/filename.jpg -->
```

## Adding New Products

1. **Upload image** to `img/products/`
2. **Name format**: `productname.jpg` (lowercase, hyphens)
3. **In admin form**, enter: `img/products/productname.jpg`
4. **Database** stores this path automatically

## Database Setup

Run once after adding/changing images:
```
http://localhost/NepaliTech/setup.php
```

Products table automatically populates with:
- Product names
- Image paths
- Prices, specs, availability

## File Naming Rules

✓ **Good:**
- samsung-galaxy-s25.jpg
- dell-xps-15.jpg
- sony-wh1000xm5.jpg

✗ **Bad:**
- Samsung Galaxy S25.jpg (spaces)
- SAMSUNG.JPG (uppercase)
- image (no extension)
- img_01 (not descriptive)

## Git Ignore Rules

```
/img/uploads/*    ← Excludes user uploads
!img/uploads/.gitkeep  ← But includes this file (keeps folder)
img/products/     ← INCLUDED in git (product images)
php/database_setup.sql ← INCLUDED in git (initialization script)
```

## Common Tasks

### Display product image
```php
<img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Product">
```

### Update image path
```sql
UPDATE products SET image_url = 'img/products/new-image.jpg' WHERE id = 5;
```

### Add new product with image
```sql
INSERT INTO products (name, brand, category, price, specs, availability, image_url)
VALUES ('Product Name', 'Brand', 'category', 10000, 'Specs', 1, 'img/products/image.jpg');
```

### Check image exists
```php
if (file_exists('img/products/filename.jpg')) {
    // Image exists
}
```

---

## Support Files

- **IMAGE_ORGANIZATION.md** - Detailed guide
- **img/products/README.md** - Product folder guide
- **IMAGE_COMPLETION.md** - This completion summary

See main README.md for complete project documentation.
