# Unitek College Blog - Production-Ready Website

A fully responsive, production-quality blog website built with modern web technologies.

## 📁 Project Structure

```
blog/
├── index.html              # Main HTML file
├── css/
│   ├── variables.css      # CSS variables and design system
│   └── style.css          # Main stylesheet with responsive design
├── js/
│   └── main.js            # JavaScript for interactions and animations
├── images/                # Image assets
├── assets/                # Additional assets
└── *.svg                  # SVG icons and graphics
```

## 🎨 Features

### ✨ Design System
- **CSS Variables** for colors, typography, spacing, and more
- **BEM naming convention** for maintainable CSS
- **Consistent spacing system** using a 4px grid
- **Comprehensive color palette** with semantic naming

### 📱 Responsive Design
- **Mobile First** approach
- **Breakpoints:**
  - Mobile: < 768px
  - Tablet: 768px - 1024px
  - Desktop: > 1024px
  - Large Desktop: 1440px+
- **Flexbox and Grid** for modern layouts
- **Fluid typography** that scales with viewport

### ♿ Accessibility
- **Semantic HTML5** structure
- **ARIA labels** and roles
- **Skip navigation** link
- **Keyboard navigation** support
- **Focus indicators** for interactive elements
- **Alt text** for all images

### ⚡ Performance
- **Optimized CSS** with minimal redundancy
- **Intersection Observer** for lazy loading animations
- **Debounced scroll handlers** for smooth scrolling
- **Efficient DOM queries** and event handling

### 🎭 Interactive Features
- **Smooth scrolling** to sections
- **Scroll-triggered animations** for article cards
- **Sticky header** with hide/show on scroll
- **Mobile menu toggle** (ready for implementation)
- **Article filtering** by category
- **Search functionality** (ready for backend integration)

## 🚀 Getting Started

1. **Clone or download** this repository
2. **Open `index.html`** in a modern web browser
3. **No build process required** - pure HTML, CSS, and JavaScript

## 📋 Browser Support

- ✅ Chrome (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Edge (latest)
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 🎯 Breakpoints

| Device | Width | Layout |
|--------|-------|--------|
| Mobile | < 768px | Single column |
| Tablet | 768px - 1024px | Two columns |
| Desktop | > 1024px | Three columns |
| Large Desktop | > 1440px | Full width with max constraints |

## 🔧 Customization

### Colors
Edit `css/variables.css` to customize the color scheme:

```css
:root {
  --color-primary-two: #007acc;
  --color-secondary-two: #58a430;
  /* ... */
}
```

### Typography
Adjust font sizes and families in `css/variables.css`:

```css
:root {
  --font-size-xl: 20px;
  --font-family: "Outfit", sans-serif;
  /* ... */
}
```

### Spacing
Modify the spacing scale in `css/variables.css`:

```css
:root {
  --spacing-xl: 32px;
  --spacing-2xl: 40px;
  /* ... */
}
```

## 📖 Components

### Navigation
- **Header**: Sticky top navigation with logo and main menu
- **Category Nav**: Filter articles by category
- **Footer**: Multi-column footer with links

### Cards
- **Article Cards**: Image, title, meta, and read more link
- **Hero Section**: Large featured article with CTA
- **Hover effects**: Smooth transitions and elevations

### Buttons
- **Primary Button**: Get started CTA
- **Link Button**: Read more, Load more styles
- **Hover states**: Subtle animations

## 🔄 JavaScript Features

Located in `js/main.js`:

- Mobile menu toggle
- Smooth scrolling
- Scroll animations
- Sticky header behavior
- Search functionality
- Article filtering
- Lazy loading
- Form validation
- Accessibility enhancements
- Performance optimizations

## 📝 Code Quality

- ✅ **Clean, well-commented code**
- ✅ **Semantic HTML structure**
- ✅ **BEM CSS methodology**
- ✅ **Modern JavaScript (ES6+)**
- ✅ **No dependencies** (vanilla JS)
- ✅ **Production-ready** and optimized

## 🎨 Design Tokens

### Typography Scale
- `--font-size-xs`: 12px
- `--font-size-sm`: 14px
- `--font-size-base`: 16px
- `--font-size-lg`: 18px
- `--font-size-xl`: 20px
- `--font-size-2xl`: 24px
- `--font-size-3xl`: 32px
- `--font-size-5xl`: 48px

### Spacing Scale
- `--spacing-xs`: 4px
- `--spacing-sm`: 8px
- `--spacing-md`: 16px
- `--spacing-lg`: 24px
- `--spacing-xl`: 32px
- `--spacing-2xl`: 40px
- `--spacing-3xl`: 60px
- `--spacing-4xl`: 80px

## 🚀 Future Enhancements

- [ ] Backend integration for dynamic content
- [ ] CMS integration
- [ ] Search functionality with live results
- [ ] User authentication
- [ ] Comments system
- [ ] Newsletter subscription
- [ ] Analytics integration

## 📄 License

This template is provided for use with Unitek College.

## 👤 Author

Built with modern web development best practices.

---

**Note**: This is a static website. For production use, integrate with your backend CMS or content delivery system.

