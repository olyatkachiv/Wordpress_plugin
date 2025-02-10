WordPress Plugin: Block List Shortcode.

This plugin allows users to display a list of blocks that can be inserted into WordPress content using a shortcode.

Key Features:

1. Admin Panel Integration:
A new "Blocks" menu item has been added to the WordPress admin panel.
This menu allows users to manage custom blocks.

2. Custom Post Type - blocks_ol:
The plugin registers a new post type called blocks_ol, which stores block data.
Each block has a status that determines whether it should be displayed in the list.

4. Metadata & Custom Fields:
Each block entry has additional metadata fields.
These fields help define how and when the block should be used.

5. Shortcode Functionality:
A shortcode can be added to display the list of blocks on the front end.
Users can insert the shortcode into pages or posts to render the block list dynamically.

How It Works:
1. Admin Panel Usage:
Go to the WordPress Admin Panel.
Click on "Blocks" in the menu.
Add or edit blocks with relevant metadata.

2. Adding Blocks to the Frontend:
Insert the shortcode [your_shortcode_here] into any post or page.
The shortcode will output a list of available blocks based on their status.

3. Conditional Display Logic:
Blocks are displayed dynamically depending on their assigned status.
Only blocks that meet the defined conditions will appear on the frontend.
