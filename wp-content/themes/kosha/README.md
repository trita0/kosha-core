# Kosha WordPress Theme

A beautiful WordPress theme for cultural knowledge bases, combining WikiHow's usability with Indian cultural aesthetics.

## Description

Kosha (meaning "treasure" or "repository" in Sanskrit) is a modern WordPress theme designed specifically for cultural knowledge bases, educational content, and heritage preservation websites. The theme features:

- **Indian-Inspired Design**: Warm color palette with saffron, terracotta, and gold tones
- **WikiHow-Style Layouts**: Step-by-step article formatting for educational content
- **Responsive Design**: Fully responsive and mobile-friendly
- **Rich Typography**: Clean, readable fonts with decorative elements
- **Cultural Elements**: Subtle Indian patterns and design motifs

## Features

### Design
- Modern, clean layout with Indian cultural aesthetics
- Gradient backgrounds and smooth transitions
- Custom color scheme with CSS variables
- Decorative borders inspired by traditional Indian art
- Responsive grid layouts

### Functionality
- Custom breadcrumb navigation
- Auto-generated table of contents for long articles
- Related posts section
- Reading time estimation
- Author bio section
- Search functionality
- Custom pagination
- Widget-ready sidebar and footer areas
- Mobile-responsive navigation menu

### Templates
- Front page with featured articles and category showcase
- Single post template with enhanced formatting
- Archive pages for categories and tags
- Search results page
- Custom 404 error page
- Static page template

## Installation

1. Download the theme files
2. Upload the `kosha` folder to `/wp-content/themes/` directory
3. Activate the theme through the 'Appearance > Themes' menu in WordPress
4. Customize the theme through 'Appearance > Customize'

## Setup

### Menus
1. Go to Appearance > Menus
2. Create a new menu and assign it to "Primary Menu" location
3. Optionally create a footer menu and assign it to "Footer Menu" location

### Widgets
The theme includes the following widget areas:
- Sidebar (right sidebar on posts and pages)
- Footer 1, 2, 3 (three footer widget columns)

### Recommended Plugins
- **Yoast SEO**: For search engine optimization
- **Contact Form 7**: For contact forms
- **Akismet**: For spam protection

## Customization

### Colors
The theme uses CSS variables for easy color customization. Edit the `:root` section in `style.css` to change:
- Primary colors (saffron, terracotta, etc.)
- Accent colors (gold, amber, turmeric)
- Earth tones (sandstone, clay)
- Neutral colors

### Typography
The theme uses:
- **Headings**: Poppins (Google Fonts)
- **Body**: Inter (Google Fonts)

To change fonts, modify the Google Fonts URL in `functions.php` and update the CSS variables.

### Logo
1. Go to Appearance > Customize > Site Identity
2. Upload your custom logo
3. Recommended size: 400x100 pixels

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Credits

### Fonts
- Poppins by Indian Type Foundry (Google Fonts)
- Inter by Rasmus Andersson (Google Fonts)

### Icons
- Bootstrap Icons (MIT License)

## Changelog

### Version 1.0.0
- Initial release
- Core theme functionality
- Indian-inspired design system
- Responsive layouts
- Custom templates and features

## Support

For theme support and documentation, please visit:
- Theme URI: https://kosha.tollugatti.in
- Author: Kosha Team

## License

This theme is licensed under the GNU General Public License v2 or later.
License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Theme Structure

```
kosha/
├── assets/
│   ├── css/
│   │   └── main.css
│   ├── js/
│   │   └── main.js
│   └── images/
├── template-parts/
│   ├── content.php
│   ├── content-search.php
│   └── content-none.php
├── 404.php
├── archive.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── index.php
├── page.php
├── README.md
├── screenshot.png
├── search.php
├── sidebar.php
├── single.php
└── style.css
```

## Developer Notes

### Hooks and Filters
The theme includes several custom hooks and filters:
- `kosha_breadcrumbs()` - Display breadcrumb navigation
- `kosha_get_related_posts()` - Get related posts by category
- `kosha_reading_time()` - Calculate and display reading time
- `kosha_pagination()` - Custom pagination function

### Template Hierarchy
The theme follows WordPress template hierarchy and includes:
- `front-page.php` for the homepage
- `single.php` for individual posts
- `page.php` for static pages
- `archive.php` for category/tag archives
- `search.php` for search results
- `404.php` for error pages

## Contributing

Contributions are welcome! Please feel free to submit pull requests or open issues for bugs and feature requests.
