# Building the Full Width Container Block

This block uses native Gutenberg block with InnerBlocks support, which requires a build step.

## Setup Instructions

1. **Install Node.js** (if not already installed)
   - Download from https://nodejs.org/
   - Version 16 or higher recommended

2. **Install Dependencies**
   ```bash
   cd wp-content/themes/unitekcollage
   npm install
   ```

3. **Build the Block**
   ```bash
   npm run build
   ```

4. **Development Mode** (watches for changes)
   ```bash
   npm start
   ```

## Files Structure

- `src/index.js` - Source JavaScript file (edit this)
- `build/index.js` - Built/compiled file (auto-generated, don't edit)
- `block.json` - Block configuration
- `render.php` - Server-side rendering template
- `style.css` - Block styles

## After Building

After running `npm run build`, the block will be available in the Gutenberg editor under the "Design" category as "Full Width Container".

You can then:
1. Add the block to your page
2. Click inside the container
3. Add any Gutenberg blocks (rows, columns, paragraphs, images, etc.)
4. All blocks will be wrapped in the full-width container with responsive styling

