<?php
    
    class CategoriesController extends VanillaController {
        
        function beforeAction() {
        }
        
        function view($categoryId = null) {
            $this->Category->where('parent_id', $categoryId);
            $this->Category->showHasOne();
            $this->Category->showHasMany();
            $subcategories = $this->Category->search();
            
            $this->Category->id = $categoryId;
            $this->Category->showHasOne();
            $this->Category->showHasMany();
            $category = $this->Category->search();
            
            $this->set('subcategories', $subcategories);
            $this->set('category', $category);
            
        }

        function index() {
            $this->Category->orderBy('name', 'ASC');
            $this->Category->showHasOne();
            $this->Category->showHasMany();
            $this->Category->where('parent_id', '0');
            $categories = $this->Category->search();
            $this->set('categories', $categories);
        }
        
        function afterAction() {
        
        }
    
        /**
         * Now suppose that we are in the categories controller and we want to implement a query on the products
        table. One way to implement this is using a custom query i.e. $this->Category->custom(’select * from
        products where ….’);
         */
        function view2($categoryId = null, $categoryName = null) {
            $categories = performAction('products', 'findProducts', array($categoryId, $categoryName));
        }
        
        
    }