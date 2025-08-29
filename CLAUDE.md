# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Plugin Overview

This is "Protect My Content", a WordPress plugin that provides content protection features for websites. The plugin is built using the PLUBO framework and implements various content protection mechanisms to prevent unauthorized access and copying.

## Common Development Commands

### Build and Development
- `yarn build` - Build production assets using wp-scripts
- `yarn start` - Start development server with watch mode
- `composer install` - Install PHP dependencies
- `yarn install` - Install Node.js dependencies

### Translation
- `yarn translate` - Generate both POT file and JS translations
- `yarn translate:pot` - Generate POT file for translations
- `yarn translate:js` - Generate JSON translations for JavaScript

### Linting and Code Quality
The project uses WordPress coding standards. Run these commands to ensure code quality:
- Check package.json or composer.json for any configured linting scripts
- The project uses TypeScript (tsconfig.json) and SCSS with PostCSS

## Architecture and Code Organization

### Plugin Structure
- **Main Plugin File**: `protect-my-content.php` - Plugin bootstrap and constant definitions
- **Autoloader**: Uses Composer PSR-4 autoloading with namespace `ProtectMyContent\`
- **Entry Point**: `Includes/Loader.php` - Dynamically loads all functionality classes

### Core Architecture Pattern
The plugin follows a modular architecture where:
1. `Loader.php` automatically instantiates all classes in `Functionality/` directory
2. Each functionality class receives plugin name and version in constructor
3. Settings are centrally managed through `Components/Data.php` reading from `data/settings.php`

### Directory Structure
- `Functionality/` - Core plugin functionality classes
  - `Settings.php` - WordPress settings API integration
  - `Protections.php` - Protection activation logic
  - `AdminMenus.php` - Admin interface
- `Protections/` - Individual protection implementations
  - Each protection is a separate class (DisableContextMenu, DisableTextSelect, etc.)
- `Components/` - Utility classes like `Data.php` for data access
- `Includes/` - Core system files (Loader, AssetsLoader, Lifecycle)
- `data/` - Configuration files, primarily `settings.php` with protection definitions

### Settings System
Settings are defined in `data/settings.php` as an array of configuration objects. Each setting has:
- `slug` - Unique identifier
- `name` - Display name
- `type` - Field type (checkbox)
- `description` - User-facing description

Protection classes are dynamically loaded based on setting slugs using kebab-case to PascalCase conversion.

### Asset Building
- Uses WordPress Scripts (`@wordpress/scripts`) for build process
- TypeScript and SCSS compilation via Webpack
- Entry point: `resources/scripts/app.ts` and `resources/styles/app.scss`
- Output directory: `dist/`
- TailwindCSS integration for styling

### WordPress Integration
- Plugin constants defined in main file (PROTECTMYCONTENT_PATH, VERSION, etc.)
- Uses WordPress hooks for activation/deactivation lifecycle
- Text domain: `protect-my-content`
- Follows WordPress plugin standards and security practices

## Key Implementation Notes

### Protection Activation Flow
1. User enables protection in WordPress admin
2. `Protections.php` reads active settings from WordPress options
3. Dynamically instantiates corresponding protection class
4. Each protection class implements its specific functionality

### Class Naming Convention
Protection class names are derived from setting slugs:
- Setting slug: `disable-context-menu` 
- Class name: `ProtectMyContent\Protections\DisableContextMenu`

### Error Handling
Classes use try-catch blocks when dynamically instantiating to prevent fatal errors from breaking the entire plugin.