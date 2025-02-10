# 📦 WordPress Plugin: Block List Shortcode

## 📌 Overview
This plugin enables users to **display a list of blocks** within WordPress content using a **shortcode**. It provides an **admin panel** for managing blocks and integrates with **custom post types**.

## ✨ Key Features
1. **Admin Panel Integration**:
   - Adds a new **"Blocks"** menu item to the WordPress **Admin Panel**.
   - Users can **manage, add, and edit** custom blocks.

2. **Custom Post Type - `blocks_ol`**:
   - Registers a new **post type (`blocks_ol`)** to store block data.
   - Each block has a **status** to determine its visibility.

3. **Metadata & Custom Fields**:
   - Each block includes **additional metadata fields**.
   - These fields define **how and when** the block should be used.

4. **Shortcode Functionality**:
   - Users can insert a **shortcode** to display blocks dynamically.
   - The block list is rendered on the frontend **based on its status**.

## 🔄 How It Works

### 1️⃣ Admin Panel Usage:
- Navigate to the **WordPress Admin Panel**.
- Click on **"Blocks"** in the menu.
- **Add or edit** blocks, assigning metadata as needed.

### 2️⃣ Adding Blocks to the Frontend:
- Insert the shortcode into any **post or page**:
  ```sh
  [your_shortcode_here]
The block list will be displayed dynamically.

### 3️⃣ Conditional Display Logic:
- Only blocks with an active status will be shown.
- The plugin ensures blocks are displayed dynamically based on predefined conditions.
  
## 🛠️ Installation
- Upload the plugin to your /wp-content/plugins/ directory.
- Activate it from the WordPress Plugins menu.
- Start adding and managing blocks via the admin panel.

📌 **Author**: _Olha Tkachiv_  
