# Product Images Folder

This folder contains all product images used in the application.

## Image Organization

- **Size**: Keep images optimized (500-800px width recommended)
- **Format**: JPG or PNG
- **Quality**: Use 80-85% compression for JPGs to reduce file size

## Current Product Images

Place these image files in this folder:

1. `galaxys21.jpg` - Samsung Galaxy S21
2. `dellxps13.jpg` - Dell XPS 13
3. `ipad11pro.jpg` - iPad Pro 11
4. `iphone13.jpg` - iPhone 13
5. `omen16.jpg` - HP Omen 16 (also used as laptop category image)
6. `galaxytabs7.jpg` - Samsung Galaxy Tab S7
7. `sonywh1000xm4.jpg` - Sony WH-1000XM4 Headphones
8. `oneplus9.jpg` - OnePlus 9
9. `macbookpro14.jpg` - MacBook Pro 14
10. `pixel6.jpg` - Google Pixel 6
11. `s25ultra.jpg` - Samsung S25 Ultra (smartphone category image)
12. `headphone.jpg` - Headphone/Accessories category image

## Adding New Products

When adding new products through the admin panel:

1. Upload image to this folder
2. In admin form, enter the image path as: `img/products/imagename.jpg`
3. The system will automatically reference it correctly

## Database References

All image paths in the database are stored as:
```
img/products/imagename.jpg
```

This ensures images display correctly from any page in the application.

## Tips

- Use descriptive filenames (e.g., `samsung-galaxy-s21.jpg`)
- Keep file sizes small (< 200KB per image)
- Avoid spaces in filenames (use hyphens instead)
- Use lowercase letters for consistency

---

**Status**: Images need to be moved from root folder to this directory
