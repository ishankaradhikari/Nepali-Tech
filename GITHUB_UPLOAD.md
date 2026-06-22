# GitHub Upload Checklist

Use this checklist before uploading your project to GitHub.

## Pre-Upload Checklist

### Repository Setup
- [ ] Create new repository on GitHub
- [ ] Choose repository name: `NepaliTech` (or similar)
- [ ] Add description: "E-Market Finder - Electronic products marketplace for Nepal"
- [ ] Choose LICENSE: MIT
- [ ] Add .gitignore: PHP
- [ ] Do NOT initialize with README (we have one)

### Code Quality
- [ ] All credentials removed from code
- [ ] No hardcoded passwords or API keys
- [ ] All console errors fixed
- [ ] Code is properly formatted and indented
- [ ] Comments added where needed
- [ ] Dead code removed
- [ ] Console.log statements removed

### Files to Remove Before Upload
- [ ] `setup-db.php` (old setup script)
- [ ] `setup-db-direct.php` (old setup script)
- [ ] `.DS_Store` (Mac system files)
- [ ] `Thumbs.db` (Windows system files)
- [ ] Any personal/test image files
- [ ] Any IDE cache files

### Files Already Ignored (in .gitignore)
- [ ] Database files
- [ ] Setup PHP files
- [ ] IDE files (.vscode, .idea)
- [ ] Cache files
- [ ] Uploaded images (except .gitkeep)
- [ ] Environment files

### Documentation
- [ ] README.md ✓
- [ ] SETUP.md ✓
- [ ] CONTRIBUTING.md ✓
- [ ] LICENSE ✓
- [ ] .gitignore ✓
- [ ] .gitattributes ✓

### Commit Message
```
Initial commit: Nepali Tech E-Market Finder

- Complete project structure
- Database schema and sample data
- Admin panel with product management
- Product search and filtering
- Responsive design
- Comprehensive documentation
```

## Upload Steps

### 1. Initialize Git (First Time)

```bash
cd NepaliTech
git init
git add .
git commit -m "Initial commit: Nepali Tech E-Market Finder"
git branch -M main
git remote add origin https://github.com/yourusername/NepaliTech.git
git push -u origin main
```

### 2. Subsequent Updates

```bash
# Check status
git status

# Add changes
git add .

# Commit with descriptive message
git commit -m "Description of changes"

# Push to GitHub
git push origin main
```

## Best Practices

### Commit Messages
- Use present tense: "Add feature" not "Added feature"
- Be descriptive: "Fix search filter bug on products page"
- Reference issues: "Fixes #123"
- Keep first line under 72 characters

### Branch Strategy
- Use `main` for production-ready code
- Create feature branches: `git checkout -b feature/feature-name`
- Use PR for code review before merging

### Keep It Clean
- Don't commit:
  - Generated files
  - Temporary files
  - Large binary files
  - Credentials or secrets

## GitHub Settings

### Repository Settings
1. **General**
   - Description: "Electronic products marketplace for Nepal"
   - Website: Add your website if you have one
   - Topics: `php`, `mysql`, `e-commerce`, `nepal`

2. **Security**
   - Enable branch protection
   - Require pull request reviews
   - Require status checks

3. **Collaborators**
   - Add team members as needed
   - Set appropriate permissions

### Actions (CI/CD - Optional)
- Set up workflow for code quality checks
- Automated testing (if applicable)
- Documentation generation

## After Upload

### Promote Your Project
- [ ] Add link to README
- [ ] Create GitHub Pages (optional)
- [ ] Add topics for discoverability
- [ ] Share on social media
- [ ] Post on development communities

### Maintenance
- [ ] Respond to issues
- [ ] Review pull requests promptly
- [ ] Keep dependencies updated
- [ ] Fix security vulnerabilities
- [ ] Update documentation

## Useful GitHub Links

- **Repository**: https://github.com/yourusername/NepaliTech
- **Issues**: https://github.com/yourusername/NepaliTech/issues
- **Pull Requests**: https://github.com/yourusername/NepaliTech/pulls
- **Releases**: https://github.com/yourusername/NepaliTech/releases

## Quick Commands

```bash
# Check git status
git status

# View commit history
git log

# View remote repository
git remote -v

# Add only specific files
git add filename.php

# Undo last commit (keep changes)
git reset --soft HEAD~1

# See changes before committing
git diff

# Create a new branch
git checkout -b feature-name

# Switch branch
git checkout main

# Merge branch
git merge feature-name
```

---

**You're ready to upload to GitHub!** 🚀
