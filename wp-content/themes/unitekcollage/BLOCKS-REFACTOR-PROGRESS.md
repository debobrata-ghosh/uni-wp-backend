# WordPress Blocks Refactoring Progress

## Phase 1: Foundation & Standardization

### ✅ Completed Blocks (3/12)

#### 1. Hero Block
- **Status:** ✅ Complete
- **Changes:**
  - Created `style.css` (frontend styles)
  - Created `editor.css` (editor-only styles)
  - Updated `register.php` with proper asset enqueuing using `filemtime()`
  - Cleaned `render.php` - removed all inline styles
  - Standardized registration (category: design, proper supports, example data)

#### 2. Hero Get Started Block
- **Status:** ✅ Complete  
- **Changes:**
  - Created `style.css` (790 lines extracted from inline)
  - Created `editor.css` (editor-specific styles)
  - Created `index.js` (545 lines of JS extracted from inline)
  - Updated `register.php` with proper asset enqueuing using `filemtime()`
  - Cleaned `render.php` - reduced from 1345 lines to clean template
  - Standardized registration

#### 3. Testimonial Block
- **Status:** ✅ Complete
- **Changes:**
  - Created `style.css` (basic testimonial styling)
  - Created `editor.css` (editor preview styles)
  - Updated `register.php` with proper asset enqueuing
  - Enhanced `render.php` with proper block attributes
  - Standardized registration (category: design, proper icon, example data)

---

## 🔄 Remaining Blocks (9/12)

### High Priority (Large Refactors Needed)
1. **FAQ Block** - Has inline CSS + JS
2. **Nursing Programs Block** - Has inline CSS + JS  
3. **Get Started Today Block** - Has inline CSS
4. **Accreditations-Approvals Block** - Has inline CSS
5. **Career Block** - Has inline CSS
6. **Home Overview Block** - Has inline CSS
7. **Unitek Advantage Block** - Has inline CSS

### Medium Priority
8. **Healthcare Programs Block** - Already has CSS/JS files, just needs registration update

---

## 📋 Standardized Block Structure

Every block now follows this structure:

```
block-name/
├── register.php       # Standardized registration with asset enqueuing
├── fields.php         # ACF field definitions (unchanged)
├── render.php         # Clean PHP/HTML template only
├── style.css          # Frontend styles
├── editor.css         # Editor-only styles  
└── index.js           # JavaScript (if needed)
```

---

## 🎯 Standard Registration Template

```php
<?php
/**
 * [Block Name] Block Registration
 * 
 * @package UnitekCollege
 */

if ( function_exists( 'acf_register_block_type' ) ) {
    acf_register_block_type( array(
        'name'              => 'block-name',
        'title'             => __( 'Block Title', 'unitek-college' ),
        'description'       => __( 'Block description.', 'unitek-college' ),
        'render_template'   => get_template_directory() . '/template-parts/blocks/block-name/render.php',
        'category'          => 'design',
        'icon'              => 'appropriate-dashicon',
        'keywords'          => array( 'keyword1', 'keyword2', 'keyword3' ),
        'supports'          => array(
            'align'           => array( 'wide', 'full' ),
            'anchor'          => true,
            'customClassName' => true,
            'jsx'             => false,
        ),
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'field_name' => 'Example Value',
                )
            )
        ),
        'enqueue_assets'    => function() {
            $block_path = get_template_directory() . '/template-parts/blocks/block-name';
            $block_uri  = get_template_directory_uri() . '/template-parts/blocks/block-name';
            
            // Frontend styles
            if ( file_exists( $block_path . '/style.css' ) ) {
                wp_enqueue_style(
                    'block-name-block-style',
                    $block_uri . '/style.css',
                    array(),
                    filemtime( $block_path . '/style.css' )
                );
            }
            
            // Editor styles (only in admin)
            if ( is_admin() && file_exists( $block_path . '/editor.css' ) ) {
                wp_enqueue_style(
                    'block-name-block-editor',
                    $block_uri . '/editor.css',
                    array( 'wp-edit-blocks' ),
                    filemtime( $block_path . '/editor.css' )
                );
            }
            
            // JavaScript (if needed)
            if ( file_exists( $block_path . '/index.js' ) ) {
                wp_enqueue_script(
                    'block-name-block-script',
                    $block_uri . '/index.js',
                    array(),
                    filemtime( $block_path . '/index.js' ),
                    true
                );
            }
        },
    ) );
}
```

---

## 🎨 Standard Render Template Structure

```php
<?php
/**
 * [Block Name] Block Template
 * 
 * @package UnitekCollege
 */

// Get field values
$field_name = get_field( 'field_name' );

// Validate required fields
$required_fields = array(
    'field_name' => 'Field Label'
);
unitek_college_validate_block_fields( $required_fields, 'Block Name' );

// Get block attributes
$block_id     = $block['id'] ?? '';
$block_class  = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array( 'block-name-block' );
if ( $block_class ) {
    $css_classes[] = $block_class;
}
if ( ! empty( $block['align'] ) ) {
    $css_classes[] = 'align' . $block['align'];
}

$css_class_string = implode( ' ', $css_classes );
?>

<section <?php if ( $block_anchor ): ?>id="<?php echo esc_attr( $block_anchor ); ?>"<?php endif; ?> 
         class="<?php echo esc_attr( $css_class_string ); ?>"
         role="region"
         aria-label="Block description">
    
    <!-- Block content here -->
    
</section>
```

---

## 📝 Step-by-Step Refactoring Process

For each remaining block:

### 1. Read the current render.php
```bash
# Check for inline <style> and <script> tags
```

### 2. Extract CSS
- Copy all CSS from `<style>` tags
- Create `style.css` for frontend styles
- Create `editor.css` for `.wp-block-acf-*` editor styles
- Remove `<style>` tags from render.php

### 3. Extract JavaScript (if any)
- Copy all JS from `<script>` tags  
- Create `index.js` wrapped in IIFE: `(function() { 'use strict'; ... })();`
- Move inline event handlers to proper event listeners
- Remove `<script>` tags from render.php

### 4. Update register.php
- Use standard registration template above
- Add `enqueue_assets` callback
- Use `filemtime()` for cache busting (NOT `time()`)
- Update category to `'design'`
- Add proper icon
- Add example data
- Enable align, anchor, customClassName

### 5. Clean render.php
- Remove all inline styles
- Remove all inline scripts  
- Add proper block attributes ($block_id, $block_class, $block_anchor)
- Build CSS classes array
- Add proper ARIA labels

---

## 🎯 Benefits Achieved So Far

### Performance
- ✅ External CSS files enable browser caching
- ✅ Proper cache busting with `filemtime()` instead of `time()`
- ✅ Reduced HTML size (hero-get-started: 1345 lines → ~150 lines)

### Maintainability
- ✅ Separate concerns (styles, scripts, templates)
- ✅ Consistent file structure across all blocks
- ✅ Easier to find and edit code

### Developer Experience  
- ✅ Standardized registration patterns
- ✅ Clear documentation
- ✅ Consistent naming conventions

### User Experience
- ✅ Consistent block registration (category, icons, examples)
- ✅ Better block previews in editor
- ✅ Proper ARIA labels for accessibility

---

## 🚀 Next Steps

### Immediate (Complete Phase 1)
1. Continue refactoring remaining 9 blocks following the template above
2. Test each refactored block in editor and frontend
3. Verify all functionality still works

### Phase 2 (Post-Refactor)
1. Standardize field naming conventions
2. Add comprehensive ARIA labels
3. Implement keyboard navigation where needed
4. Create shared helper functions for common patterns

### Phase 3 (Optimization)
1. Minify CSS/JS files for production
2. Implement conditional asset loading
3. Add lazy loading for images
4. Performance testing

---

## 📚 Reference Files

### Completed Examples
- `/template-parts/blocks/hero/` - Simple block example
- `/template-parts/blocks/hero-get-started/` - Complex block with multi-step form
- `/template-parts/blocks/testimonial/` - Minimal block example

### Review Document
- See `/Downloads/Deba.html` for comprehensive code review

---

**Last Updated:** November 5, 2025  
**Status:** Phase 1 In Progress (3/12 blocks complete)  
**Estimated Time Remaining:** ~2-3 hours for remaining blocks

