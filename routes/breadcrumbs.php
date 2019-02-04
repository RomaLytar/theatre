<?php

// Home
Breadcrumbs::for('home', function ($trail) {
  $trail->push(__('breadcrumbs.home'), route('front.home'));
});

Breadcrumbs::for('eventType', function ($trail, $eventType) {
  $trail->parent('home');
  $trail->push($eventType->translate->title, route('front.calendar.index'));
});

Breadcrumbs::for('event', function ($trail, $performance) {
  $trail->parent('eventType', $performance->type);
  $trail->push($performance->translate->title, route('front.events.show', ['id' => $performance->id, 'slug' => $performance->translate->slug]));
});

// Home > About
Breadcrumbs::for('about', function ($trail) {
  $trail->parent('home');
  $trail->push(__('breadcrumbs.about'), route('front.articles.about'));
});

Breadcrumbs::for('article', function ($trail, $article) {
  $trail->parent('about');
  $trail->push($article->translate->title, route('front.articles.article', ['id' => $article->id, 'slug' => $article->translate->slug]));
});

Breadcrumbs::for('releases', function ($trail) {
  $trail->parent('home');
  $trail->push(__('breadcrumbs.releases'), route('front.articles.releases'));
});

Breadcrumbs::for('release', function ($trail, $article) {
  $trail->parent('releases');
  $trail->push($article->translate->title, route('front.articles.release', ['id' => $article->id, 'slug' => $article->translate->slug]));
});

Breadcrumbs::for('videos', function ($trail) {
  $trail->parent('home');
  $trail->push(__('breadcrumbs.videos'), route('front.videos.index'));
});

Breadcrumbs::for('albums', function ($trail) {
  $trail->parent('home');
  $trail->push(__('breadcrumbs.albums'), route('front.albums.index'));
});

Breadcrumbs::for('album_category', function ($trail, $albumCategory) {
  $trail->parent('albums');
  $trail->push($albumCategory->translate->title, route('front.albums.index') . '?category_id=' . $albumCategory->id);
});

Breadcrumbs::for('album_item', function ($trail, $albumItem) {
  $trail->parent('album_category', $albumItem->category);
  $trail->push($albumItem->translate->title, route('front.albums.show', ['id' => $albumItem->id, 'slug' => $albumItem->translate->slug]));
});

Breadcrumbs::for('actors', function ($trail) {
  $trail->parent('home');
  $trail->push(__('breadcrumbs.actors'), route('team'));
});

//// Home > Blog
//Breadcrumbs::for('blog', function ($trail) {
//  $trail->parent('home');
//  $trail->push('Blog', route('blog'));
//});
//
//// Home > Blog > [Category]
//Breadcrumbs::for('category', function ($trail, $category) {
//  $trail->parent('blog');
//  $trail->push($category->title, route('category', $category->id));
//});
//
//// Home > Blog > [Category] > [Post]
//Breadcrumbs::for('post', function ($trail, $post) {
//  $trail->parent('category', $post->category);
//  $trail->push($post->title, route('post', $post->id));
//});
