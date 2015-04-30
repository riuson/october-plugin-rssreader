<?php

return [
    'plugin' => [
        'name' => 'RssReader',
        'description' => 'Get and display RSS news feed from other sites',
    ],
    'backend' => [
        'label' => 'Rss Reader',
        'description' => 'News feeds',
    ],
    'backend_channel' => [
        'menu_label' => 'News channels',
        'manage_channels' => 'Manage Channels',
        'record_name_channel' => 'Channel',
        'new_channel' => 'New Channel',
        'create_channel' => 'Create Channel',
        'edit_channel' => 'Edit Channel',
        'preview_channel' => 'Preview Channel',
        'channels' => 'Channels',
        'return_to_list' => 'Return to Channels list',
        'delete_confirm' => 'Do you really want to delete this Channel?',
        'name' => 'Name',
        'title' => 'Title',
        'description' => 'Description',
        'url' => 'URL',
        'slug' => 'Slug',
        'language' => 'Language',
    ],
    'rss_channel' => [
        'name' => 'Rss Channel',
        'description' => 'Show news feed on page',
        'channel_title' => 'Channel',
        'channel_description' => 'Selected channel',
        'itemsperpage_title' => 'Items per page',
        'items_per_page_validation' => 'Invalid format of the items per page value',
        'mode_title' => 'Mode',
        'mode_description' => 'Display mode',
        'mode_option_full' => 'Titles and content',
        'mode_option_short' => 'Titles only',
        'showpager_title' => 'Show pager',
        'showpager_description' => 'Show page navigation',
        'showpager_option_show' => 'Show',
        'showpager_option_hide' => 'Hide',
        'feedpage_title' => 'Feed page',
        'feedpage_description' => 'Page to show feed with content',
        'pagenumber_title' => 'Page number',
        'show_all' => 'Show all',
    ],
];
