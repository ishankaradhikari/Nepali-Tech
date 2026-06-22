
// Main JavaScript for Nepali Tech

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (menuToggle && navMenu) {
      menuToggle.addEventListener('click', function () {
        navMenu.classList.toggle('active');
      });
    }
  
    // Handle price range slider if exists
    const priceRange = document.getElementById('price-range');
    const priceOutput = document.getElementById('price-output');
    
    if (priceRange && priceOutput) {
      priceOutput.innerHTML = priceRange.value + " NPR";
      priceRange.oninput = function() {
        priceOutput.innerHTML = this.value + " NPR";
      };
    }
  
    // Product filtering functionality
    const filterForm = document.getElementById('filter-form');
    if (filterForm) {
      filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        applyFilters();
      });
  
      // Reset filters
      const resetButton = document.getElementById('reset-filters');
      if (resetButton) {
        resetButton.addEventListener('click', function() {
          filterForm.reset();
          if (priceRange && priceOutput) {
            priceOutput.innerHTML = priceRange.value + " NPR";
          }
          applyFilters();
        });
      }
    }
  
    // Product search functionality
    const searchForm = document.getElementById('search-form');
    if (searchForm) {
      searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const searchInput = document.getElementById('search-input').value.trim().toLowerCase();
        
        // Redirect to products page with search query
        window.location.href = 'products.php?search=' + encodeURIComponent(searchInput);
      });
    }
  
    // Admin delete product confirmation
    const deleteButtons = document.querySelectorAll('.btn-delete');
    if (deleteButtons) {
      deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
          if (!confirm('Are you sure you want to delete this product?')) {
            e.preventDefault();
          }
        });
      });
    }
  
    // Image preview for admin product form
    const imageUrlInput = document.getElementById('image_url');
    const imagePreview = document.getElementById('image-preview');
    
    if (imageUrlInput && imagePreview) {
      imageUrlInput.addEventListener('blur', function() {
        const imageUrl = this.value.trim();
        if (imageUrl) {
          imagePreview.innerHTML = `<img src="${imageUrl}" alt="Product Preview" style="max-width: 100%; max-height: 200px;">`;
        } else {
          imagePreview.innerHTML = '';
        }
      });
    }
  });
  
  // Function to apply filters on products page
  function applyFilters() {
    const categorySelect = document.getElementById('category');
    const brandSelect = document.getElementById('brand');
    const priceRange = document.getElementById('price-range');
    
    let url = 'products.php?';
    const params = [];
    
    if (categorySelect && categorySelect.value) {
      params.push('category=' + encodeURIComponent(categorySelect.value));
    }
    
    if (brandSelect && brandSelect.value) {
      params.push('brand=' + encodeURIComponent(brandSelect.value));
    }
    
    if (priceRange) {
      params.push('max_price=' + encodeURIComponent(priceRange.value));
    }
    
    url += params.join('&');
    window.location.href = url;
  }