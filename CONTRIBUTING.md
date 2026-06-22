# Contributing to Nepali Tech

Thank you for your interest in contributing to the Nepali Tech project! We welcome contributions from everyone.

## How to Contribute

### Reporting Bugs

Before creating bug reports, check the issue list as you might find out that you don't need to create one. When you do create a bug report, include as many details as possible:

- **Use a clear and descriptive title**
- **Describe the exact steps which reproduce the problem**
- **Provide specific examples to demonstrate the steps**
- **Describe the behavior you observed after following the steps**
- **Explain which behavior you expected to see instead and why**
- **Include screenshots if possible**
- **Include your environment details** (OS, browser, PHP version, etc.)

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, include:

- **Use a clear and descriptive title**
- **Provide a step-by-step description of the suggested enhancement**
- **Provide specific examples to demonstrate the steps**
- **Describe the current behavior and the expected behavior**
- **Explain why this enhancement would be useful**

### Pull Requests

- Fill in the required template
- Follow the PHP, CSS, and JavaScript style guides
- Include appropriate test cases
- End all files with a newline
- Avoid platform-dependent code

## Development Setup

1. **Fork and clone the repository**
   ```bash
   git clone https://github.com/yourusername/NepaliTech.git
   cd NepaliTech
   ```

2. **Create a branch for your feature**
   ```bash
   git checkout -b feature/your-feature-name
   ```

3. **Make your changes**
   - Keep commits atomic and descriptive
   - Write meaningful commit messages

4. **Test thoroughly**
   - Test on multiple browsers
   - Test on mobile devices
   - Verify database operations

5. **Push and create Pull Request**
   ```bash
   git push origin feature/your-feature-name
   ```

## Code Style Guidelines

### PHP
- Use PSR-2 coding standard
- Use meaningful variable names
- Add comments for complex logic
- Sanitize all user inputs
- Use prepared statements for database queries

### JavaScript
- Use `const` and `let` instead of `var`
- Use arrow functions where appropriate
- Keep functions small and focused
- Add comments for complex logic

### CSS
- Use meaningful class names
- Use CSS custom properties (variables)
- Follow mobile-first approach
- Keep specificity low

### HTML
- Use semantic HTML5 elements
- Maintain proper indentation
- Close all tags properly
- Use meaningful IDs and classes

## Commit Message Guidelines

- Use the present tense ("Add feature" not "Added feature")
- Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
- Limit the first line to 72 characters or less
- Reference issues and pull requests liberally after the first line

Example:
```
Add search functionality to products page

- Implement search input field
- Add filter logic to database query
- Update product display with search results
- Fixes #123
```

## Testing Checklist

Before submitting a PR, ensure:

- [ ] Code follows style guidelines
- [ ] All new functionality has appropriate comments
- [ ] Database changes are documented
- [ ] Changes work on all major browsers
- [ ] No console errors or warnings
- [ ] Responsive design is maintained
- [ ] Security best practices are followed
- [ ] No hardcoded credentials or sensitive data

## Project Structure Rules

When adding new files:

```
- PHP files go in appropriate subdirectories
- CSS files go in /css
- JavaScript files go in /js
- Images go in /img
- Database files go in /php
- Admin pages go in /Admin
```

## Questions?

Feel free to open an issue with the `question` label or contact us at info@nepalitech.com

---

Thank you for contributing! 🎉
