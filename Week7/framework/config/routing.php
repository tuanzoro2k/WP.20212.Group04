<?php
    /**
     * 1. specify default controller and action
     * 2. specify custom redirects using regex
     *      http://localhost/framework/admin/categories/view will become
     *      http://localhost/framework/admin/categories_view
     *      where admin is the controller and categories_view is the action
     */
    
    $routing = array(
        '/admin\/(.*?)\/(.*?)\/(.*)/' => 'admin/\1_\2/\3'
    );
    
    // define a 2d array
    $default['controller'] = 'categories';
    $default['action'] = 'index';