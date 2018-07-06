<?php

namespace Mesmerize\Customizer;

class Translations
{
    private static $translationMap = null;

    private static function getStringsArray()
    {
        return apply_filters('cloudpress\customizer\translation_strings',
            array(
                array(
                    "original"   => "3rd party form shortcode",
                    "translated" => __("3rd party form shortcode", "mesmerize-companion"),
                ),
                array(
                    "original"   => "3rd party shortcode (optional)",
                    "translated" => __("3rd party shortcode (optional)", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Add Item",
                    "translated" => __("Add Item", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Add WebFont",
                    "translated" => __("Add WebFont", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Add element",
                    "translated" => __("Add element", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Add item",
                    "translated" => __("Add item", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Add web font",
                    "translated" => __("Add web font", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Address",
                    "translated" => __("Address", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Api key",
                    "translated" => __("Api key", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Background Color",
                    "translated" => __("Background Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Background Image",
                    "translated" => __("Background Image", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Background Overlay",
                    "translated" => __("Background Overlay", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Background Type",
                    "translated" => __("Background Type", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Background can be changed in PRO",
                    "translated" => __("Background can be changed in PRO", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Blog Section Options",
                    "translated" => __("Blog Section Options", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Border Color",
                    "translated" => __("Border Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Bordered",
                    "translated" => __("Bordered", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Button Color",
                    "translated" => __("Button Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Button Icon",
                    "translated" => __("Button Icon", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Button Preset",
                    "translated" => __("Button Preset", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Button Shadow",
                    "translated" => __("Button Shadow", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Button Size",
                    "translated" => __("Button Size", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Button Text Color",
                    "translated" => __("Button Text Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Button",
                    "translated" => __("Button", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Cancel",
                    "translated" => __("Cancel", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Card Border Color",
                    "translated" => __("Card Border Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Categories",
                    "translated" => __("Categories", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Center",
                    "translated" => __("Center", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Change Font Awesome Icon",
                    "translated" => __("Change Font Awesome Icon", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Change Page Background Image",
                    "translated" => __("Change Page Background Image", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Change background Image",
                    "translated" => __("Change background Image", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Change background",
                    "translated" => __("Change background", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Change",
                    "translated" => __("Change", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Check all PRO features",
                    "translated" => __("Check all PRO features", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Choose Gradient",
                    "translated" => __("Choose Gradient", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Choose Icon",
                    "translated" => __("Choose Icon", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Choose Images",
                    "translated" => __("Choose Images", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Close Panel",
                    "translated" => __("Close Panel", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Color item",
                    "translated" => __("Color item", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Color",
                    "translated" => __("Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Column",
                    "translated" => __("Column", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Columns per row",
                    "translated" => __("Columns per row", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Columns",
                    "translated" => __("Columns", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Contact Form 7 Options",
                    "translated" => __("Contact Form 7 Options", "mesmerize-companion"),
                ),

                array(
                    "original"   => "Content Align",
                    "translated" => __("Content Align", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Content Column Bg. Color",
                    "translated" => __("Content Column Bg. Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Content Column Color",
                    "translated" => __("Content Column Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Content Column Options",
                    "translated" => __("Content Column Options", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Content align",
                    "translated" => __("Content align", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Counter duration ( in milliseconds )",
                    "translated" => __("Counter duration ( in milliseconds )", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Custom shortcode",
                    "translated" => __("Custom shortcode", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Dark text",
                    "translated" => __("Dark text", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Date",
                    "translated" => __("Date", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Default",
                    "translated" => __("Default", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Delete element",
                    "translated" => __("Delete element", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Delete item",
                    "translated" => __("Delete item", "mesmerize-companion"),
                ),
                array(
                    "original"   => /** @lang text */
                        "Delete section from page",
                    "translated" => __(/** @lang text */
                        "Delete section from page", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Display section title area",
                    "translated" => __("Display section title area", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Display",
                    "translated" => __("Display", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Duplicate",
                    "translated" => __("Duplicate", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Edit section settings",
                    "translated" => __("Edit section settings", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Edit",
                    "translated" => __("Edit", "mesmerize-companion"),
                ),
                array(
                    "original"   => "End counter to",
                    "translated" => __("End counter to", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Extra Large",
                    "translated" => __("Extra Large", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Font Awesome Icon",
                    "translated" => __("Font Awesome Icon", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Font Weight",
                    "translated" => __("Font Weight", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Frame Settings",
                    "translated" => __("Frame Settings", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Gallery Settings",
                    "translated" => __("Gallery Settings", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Get your api key here",
                    "translated" => __("Get your api key here", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Gradient",
                    "translated" => __("Gradient", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Heading",
                    "translated" => __("Heading", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Height",
                    "translated" => __("Height", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Hide on mobile",
                    "translated" => __("Hide on mobile", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Highlight item",
                    "translated" => __("Highlight item", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Icon Color",
                    "translated" => __("Icon Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Icon Size",
                    "translated" => __("Icon Size", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Icon Style",
                    "translated" => __("Icon Style", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Image",
                    "translated" => __("Image", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Item content align",
                    "translated" => __("Item content align", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Item",
                    "translated" => __("Item", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Items Options",
                    "translated" => __("Items Options", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Items align",
                    "translated" => __("Items align", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Items position",
                    "translated" => __("Items position", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Large",
                    "translated" => __("Large", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Lat (optional)",
                    "translated" => __("Lat (optional)", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Latest News Settings",
                    "translated" => __("Latest News Settings", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Left",
                    "translated" => __("Left", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Link",
                    "translated" => __("Link", "mesmerize-companion"),
                ),
                array(
                    "original"   => "List item",
                    "translated" => __("List item", "mesmerize-companion"),
                ),
                array(
                    "original"   => "List items",
                    "translated" => __("List items", "mesmerize-companion"),
                ),
                array(
                    "original"   => "List",
                    "translated" => __("List", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Lng (optional)",
                    "translated" => __("Lng (optional)", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Main Menu",
                    "translated" => __("Main Menu", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Make Centered",
                    "translated" => __("Make Centered", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Make full width",
                    "translated" => __("Make full width", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Manage Content",
                    "translated" => __("Manage Content", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Manage Options",
                    "translated" => __("Manage Options", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Manage Widgets Areas",
                    "translated" => __("Manage Widgets Areas", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Manage web fonts",
                    "translated" => __("Manage web fonts", "mesmerize-companion"),
                ),
                array(
                    "original"   => "More section design options available in PRO",
                    "translated" => __("More section design options available in PRO", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Move element",
                    "translated" => __("Move element", "mesmerize-companion"),
                ),
                array(
                    "original"   => "No Widgets Area Selected",
                    "translated" => __("No Widgets Area Selected", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Normal",
                    "translated" => __("Normal", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Number of posts to display",
                    "translated" => __("Number of posts to display", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Number of products to display",
                    "translated" => __("Number of products to display", "mesmerize-companion"),
                ),
                array(
                    "original"   => "OK",
                    "translated" => __("OK", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Offset X",
                    "translated" => __("Offset X", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Offset Y",
                    "translated" => __("Offset Y", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Open images in Lightbox",
                    "translated" => __("Open images in Lightbox", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Order By",
                    "translated" => __("Order By", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Order",
                    "translated" => __("Order", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Overlay color",
                    "translated" => __("Overlay color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Please upgrade to the PRO version to use this item and many others.",
                    "translated" => __("Please upgrade to the PRO version to use this item and many others.", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Popularity",
                    "translated" => __("Popularity", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Prefix ( text in front of the number )",
                    "translated" => __("Prefix ( text in front of the number )", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Price",
                    "translated" => __("Price", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Random",
                    "translated" => __("Random", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Rating",
                    "translated" => __("Rating", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Remove Item",
                    "translated" => __("Remove Item", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Remove",
                    "translated" => __("Remove", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Reorder Items",
                    "translated" => __("Reorder Items", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Right",
                    "translated" => __("Right", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Rounded background",
                    "translated" => __("Rounded background", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Search for specific products to display",
                    "translated" => __("Search for specific products to display", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Section Background",
                    "translated" => __("Section Background", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Section Dimensions",
                    "translated" => __("Section Dimensions", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Section Options",
                    "translated" => __("Section Options", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Section Separators",
                    "translated" => __("Section Separators", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Section Settings",
                    "translated" => __("Section Settings", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Section Spacing",
                    "translated" => __("Section Spacing", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Section",
                    "translated" => __("Section", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Select Image",
                    "translated" => __("Select Image", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Select Products to display",
                    "translated" => __("Select Products to display", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Select a Widgets Area",
                    "translated" => __("Select a Widgets Area", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Select",
                    "translated" => __("Select", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Set the shortcode",
                    "translated" => __("Set the shortcode", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Shortcode",
                    "translated" => __("Shortcode", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Show form controls on one column",
                    "translated" => __("Show form controls on one column", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Small",
                    "translated" => __("Small", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Start counter from",
                    "translated" => __("Start counter from", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Stop circle at value",
                    "translated" => __("Stop circle at value", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Suffix ( text after the number )",
                    "translated" => __("Suffix ( text after the number )", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Swap columns position on mobile",
                    "translated" => __("Swap columns position on mobile", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Tags",
                    "translated" => __("Tags", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Text Color",
                    "translated" => __("Text Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Text Options",
                    "translated" => __("Text Options", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Text",
                    "translated" => __("Text", "mesmerize-companion"),
                ),
                array(
                    "original"   => "The quick brown fox jumps over the lazy dog",
                    "translated" => __("The quick brown fox jumps over the lazy dog", "mesmerize-companion"),
                ),
                array(
                    "original"   => "This item is available only in the PRO version",
                    "translated" => __("This item is available only in the PRO version", "mesmerize-companion"),
                ),
                array(
                    "original"   => "This item requires PRO theme",
                    "translated" => __("This item requires PRO theme", "mesmerize-companion"),
                ),
                array(
                    "original"   => "This section has a custom background color",
                    "translated" => __("This section has a custom background color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Toggle visibility in primary menu",
                    "translated" => __("Toggle visibility in primary menu", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Transparent",
                    "translated" => __("Transparent", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Type",
                    "translated" => __("Type", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Upgrade to PRO",
                    "translated" => __("Upgrade to PRO", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Use 3rd party shortcode",
                    "translated" => __("Use 3rd party shortcode", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Use Masonry to display the gallery",
                    "translated" => __("Use Masonry to display the gallery", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Use Transparent Color",
                    "translated" => __("Use Transparent Color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Use custom selection",
                    "translated" => __("Use custom selection", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Use this field for 3rd party maps plugins. The fields above will be ignored in this case.",
                    "translated" => __("Use this field for 3rd party maps plugins. The fields above will be ignored in this case.", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Video Popup Button",
                    "translated" => __("Video Popup Button", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Visible",
                    "translated" => __("Visible", "mesmerize-companion"),
                ),
                array(
                    "original"   => "What Our Clients Say",
                    "translated" => __("What Our Clients Say", "mesmerize-companion"),
                ),
                array(
                    "original"   => "White text",
                    "translated" => __("White text", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Widgets Area",
                    "translated" => __("Widgets Area", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Width",
                    "translated" => __("Width", "mesmerize-companion"),
                ),
                array(
                    "original"   => "WooCommerce Section Options",
                    "translated" => __("WooCommerce Section Options", "mesmerize-companion"),
                ),
                array(
                    "original"   => "Zoom",
                    "translated" => __("Zoom", "mesmerize-companion"),
                ),
                array(
                    "original"   => "add theme color",
                    "translated" => __("add theme color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "background",
                    "translated" => __("background", "mesmerize-companion"),
                ),
                array(
                    "original"   => "big",
                    "translated" => __("big", "mesmerize-companion"),
                ),
                array(
                    "original"   => "blue",
                    "translated" => __("blue", "mesmerize-companion"),
                ),
                array(
                    "original"   => "border",
                    "translated" => __("border", "mesmerize-companion"),
                ),
                array(
                    "original"   => "bottom",
                    "translated" => __("bottom", "mesmerize-companion"),
                ),
                array(
                    "original"   => "button",
                    "translated" => __("button", "mesmerize-companion"),
                ),
                array(
                    "original"   => "column",
                    "translated" => __("column", "mesmerize-companion"),
                ),
                array(
                    "original"   => "columns",
                    "translated" => __("columns", "mesmerize-companion"),
                ),
                array(
                    "original"   => "dark text",
                    "translated" => __("dark text", "mesmerize-companion"),
                ),
                array(
                    "original"   => "date",
                    "translated" => __("date", "mesmerize-companion"),
                ),
                array(
                    "original"   => "default",
                    "translated" => __("default", "mesmerize-companion"),
                ),
                array(
                    "original"   => "edit theme colors",
                    "translated" => __("edit theme colors", "mesmerize-companion"),
                ),
                array(
                    "original"   => "green",
                    "translated" => __("green", "mesmerize-companion"),
                ),
                array(
                    "original"   => "heading",
                    "translated" => __("heading", "mesmerize-companion"),
                ),
                array(
                    "original"   => "image",
                    "translated" => __("image", "mesmerize-companion"),
                ),
                array(
                    "original"   => "lead",
                    "translated" => __("lead", "mesmerize-companion"),
                ),
                array(
                    "original"   => "link",
                    "translated" => __("link", "mesmerize-companion"),
                ),
                array(
                    "original"   => "new button",
                    "translated" => __("new button", "mesmerize-companion"),
                ),
                array(
                    "original"   => "new link",
                    "translated" => __("new link", "mesmerize-companion"),
                ),
                array(
                    "original"   => "no shadow",
                    "translated" => __("no shadow", "mesmerize-companion"),
                ),
                array(
                    "original"   => "normal",
                    "translated" => __("normal", "mesmerize-companion"),
                ),
                array(
                    "original"   => "orange",
                    "translated" => __("orange", "mesmerize-companion"),
                ),
                array(
                    "original"   => "outline",
                    "translated" => __("outline", "mesmerize-companion"),
                ),
                array(
                    "original"   => "paragraph",
                    "translated" => __("paragraph", "mesmerize-companion"),
                ),
                array(
                    "original"   => "popularity",
                    "translated" => __("popularity", "mesmerize-companion"),
                ),
                array(
                    "original"   => "price",
                    "translated" => __("price", "mesmerize-companion"),
                ),
                array(
                    "original"   => "purple",
                    "translated" => __("purple", "mesmerize-companion"),
                ),
                array(
                    "original"   => "random",
                    "translated" => __("random", "mesmerize-companion"),
                ),
                array(
                    "original"   => "rating",
                    "translated" => __("rating", "mesmerize-companion"),
                ),
                array(
                    "original"   => "round outline",
                    "translated" => __("round outline", "mesmerize-companion"),
                ),
                array(
                    "original"   => "round",
                    "translated" => __("round", "mesmerize-companion"),
                ),
                array(
                    "original"   => "select image",
                    "translated" => __("select image", "mesmerize-companion"),
                ),
                array(
                    "original"   => "separator Height",
                    "translated" => __("separator Height", "mesmerize-companion"),
                ),
                array(
                    "original"   => "separator colo",
                    "translated" => __("separator colo", "mesmerize-companion"),
                ),
                array(
                    "original"   => "separator color",
                    "translated" => __("separator color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "separator type",
                    "translated" => __("separator type", "mesmerize-companion"),
                ),
                array(
                    "original"   => "separator",
                    "translated" => __("separator", "mesmerize-companion"),
                ),
                array(
                    "original"   => "show shadow",
                    "translated" => __("show shadow", "mesmerize-companion"),
                ),
                array(
                    "original"   => "small",
                    "translated" => __("small", "mesmerize-companion"),
                ),
                array(
                    "original"   => "square outline",
                    "translated" => __("square outline", "mesmerize-companion"),
                ),
                array(
                    "original"   => "square round outline",
                    "translated" => __("square round outline", "mesmerize-companion"),
                ),
                array(
                    "original"   => "square round",
                    "translated" => __("square round", "mesmerize-companion"),
                ),
                array(
                    "original"   => "square",
                    "translated" => __("square", "mesmerize-companion"),
                ),
                array(
                    "original"   => "top",
                    "translated" => __("top", "mesmerize-companion"),
                ),
                array(
                    "original"   => "transparent ( link button )",
                    "translated" => __("transparent ( link button )", "mesmerize-companion"),
                ),
                array(
                    "original"   => "transparent",
                    "translated" => __("transparent", "mesmerize-companion"),
                ),
                array(
                    "original"   => "use existing color",
                    "translated" => __("use existing color", "mesmerize-companion"),
                ),
                array(
                    "original"   => "white text",
                    "translated" => __("white text", "mesmerize-companion"),
                ),
                array(
                    "original"   => "yellow",
                    "translated" => __("yellow", "mesmerize-companion"),
                ),
            )
        );
    }


    static public function getTranslations()
    {

        if ( ! static::$translationMap) {
            foreach (static::getStringsArray() as $match) {
                static::$translationMap[$match['original']] = $match['translated'];
            }
        }

        return static::$translationMap;
    }
}
