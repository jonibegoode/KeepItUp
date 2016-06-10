<?php

$w_routes = array(
	['GET', '/404', 'Default#page404', '404'],
	['GET', '/', 'Default#home', 'home'],

	['GET', '/movie/view/[i:id]', 'Movie#view', 'movie_view'],
	['GET', '/movie/catalog', 'Movie#catalog', 'movie_catalog', 'nav_title' => 'Liste des films'],
	['GET', '/movie/random', 'Movie#random', 'movie_random', 'nav_title' => 'Film aléatoire'],
	['GET', '/movie/search/[:search]', 'Movie#search', 'movie_search_results', 'nav_title' => 'Résultats de recherche'],
	['GET', '/movie/search', 'Movie#search', 'movie_search', 'nav_title' => 'Recherche'],
	['GET|POST', '/movie/add', 'Movie#add', 'movie_add', 'nav_title' => 'Ajouter un film'],

	['GET', '/admin', 'Admin#dashboard', 'admin'],
	['GET', '/admin/dashboard', 'Admin#dashboard', 'admin_dashboard'],

	['GET|POST', '/register', 'User#register', 'user_register'],
	['GET|POST', '/login', 'User#login', 'user_login'],
	['GET|POST', '/logout', 'User#logout', 'user_logout'],
);