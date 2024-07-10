<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function(){

    Route::get('/',                                             'Admin\DashboardController@getDashboard')->name('dashboard');

    //Module Users
        Route::get('/users/{status}',                           'Admin\UserController@getUsers')->name('users_list');
        Route::get('/user/{id}/edit',                           'Admin\UserController@getUserEdit')->name('user_edit');
        Route::post('/user/{id}/edit',                          'Admin\UserController@postUserEdit')->name('user_edit');
        Route::get('/user/{id}/banned',                         'Admin\UserController@getUserBanned')->name('user_banned');
        Route::get('/user/{id}/permissions',                    'Admin\UserController@getUserPermissions')->name('user_permissions');
        Route::post('/user/{id}/permissions',                   'Admin\UserController@postUserPermissions')->name('user_permissions');

    //Module Area
        Route::get('/areas',                                'Admin\AreaController@getHome')->name('areas');
        Route::post('/area/add',                            'Admin\AreaController@postAreaAdd')->name('area_add');
        Route::get('/area/{id}/edit',                       'Admin\AreaController@getAreaEdit')->name('area_edit');
        Route::post('/area/{id}/edit',                      'Admin\AreaController@postAreaEdit')->name('area_edit');
        Route::get('/area/{id}/delete',                     'Admin\AreaController@getAreaDelete')->name('area_delete');

    //Module Carousels
        Route::get('/carousels',                                'Admin\CarouselsController@getHome')->name('carousels');
        Route::post('/carousel/add',                            'Admin\CarouselsController@postCarouselAdd')->name('carousel_add');
        Route::get('/carousel/{id}/edit',                       'Admin\CarouselsController@getCarouselEdit')->name('carousel_edit');
        Route::post('/carousel/{id}/edit',                      'Admin\CarouselsController@postCarouselEdit')->name('carousel_edit');
        Route::get('/carousel/{id}/delete',                     'Admin\CarouselsController@getCarouselDelete')->name('carousel_delete');


    //Module CorporateArea
        Route::get('/company',                                 'Admin\CorporateAreaController@getHome')->name('company');
        Route::get('/company/{slug}',                       'Admin\CorporateAreaController@getCompanyEdit')->name('company_edit');
        Route::post('/company/{slug}/edit',                      'Admin\CorporateAreaController@postCompanyEdit')->name('company_edit');


    //Module Gallery
        Route::get('/gallery',                                'Admin\CarouselsController@getHometGallery')->name('gallery');
        Route::post('/gallery/add',                            'Admin\CarouselsController@postGalleryAdd')->name('gallery_add');
        Route::get('/gallery/{id}/edit',                       'Admin\CarouselsController@getGalleryEdit')->name('gallery_edit');
        Route::post('/gallery/{id}/edit',                      'Admin\CarouselsController@postGalleryEdit')->name('gallery_edit');
        Route::post('/section/{slug}',                          'Admin\SectionController@postGallerySection')->name('gallery_edit');
        Route::get('/gallery/{id}/delete',                     'Admin\CarouselsController@getGalleryDelete')->name('gallery_delete');

    //Module Videos
        Route::get('/video',                                'Admin\SectionController@getHomeVideo')->name('video');
        Route::post('/video/add',                            'Admin\SectionController@postVideoAdd')->name('video_add');
        Route::get('/video/{id}/edit',                       'Admin\SectionController@getVideoEdit')->name('video_edit');
        Route::post('/video/{id}/edit',                      'Admin\SectionController@postVideoEdit')->name('video_edit');
        Route::get('/video/{id}/delete',                     'Admin\SectionController@getVideoDelete')->name('video_delete');

    //Module Article
        Route::get('/articulos/{status}/',                           'Admin\ArticleController@getHome')->name('articulos');
        Route::get('/articulo/add',                                  'Admin\ArticleController@getArticleAdd')->name('articulos_add');
        Route::post('/articulo/add',                                'Admin\ArticleController@postArticleAdd')->name('articulos_add');
        Route::get('/articulos/{id}/edit',                           'Admin\ArticleController@getArticleEdit')->name('articulos_edit');
        Route::post('/articulos/{id}/edit',                          'Admin\ArticleController@postArticleEdit')->name('articulos_edit');
        Route::get('/articulos/{id}/delete',                         'Admin\ArticleController@getArticleDelete')->name('articulos_delete');
        Route::get('/articulos/{id}/restore',                        'Admin\ArticleController@getArticleRestore')->name('articulos_delete');
        Route::post('/articulos/{id}/gallery/add/{gallery}',         'Admin\ArticleController@postArticleGalleryAdd')->name('articulos_edit');
        Route::get('/articulos/{slug}/gallery/{id}/delete',           'Admin\ArticleController@getArticleGalleryDelete')->name('articulos_edit');

    //Module Campaign
        Route::get('/campañas/{status}/',                           'Admin\CampaignController@getHome')->name('campañas');
        Route::get('/campaña/add',                                  'Admin\CampaignController@getCampaignAdd')->name('campaña_add');
        Route::post('/campaña/add/',                                'Admin\CampaignController@postCampaignAdd')->name('campaña_add');
        Route::get('/campaña/{id}/edit',                           'Admin\CampaignController@getCampaignEdit')->name('campaña_edit');
        Route::post('/campaña/{id}/edit',                          'Admin\CampaignController@postCampaignEdit')->name('campaña_edit');
        Route::get('/campaña/{id}/delete',                         'Admin\CampaignController@getCampaignDelete')->name('campaña_delete');
        Route::get('/campaña/{id}/restore',                        'Admin\CampaignController@getCampaignRestore')->name('campaña_delete');
        Route::post('/campaña/{id}/gallery/add/{gallery}',         'Admin\CampaignController@postCampaignGalleryAdd')->name('campaña_edit');
        Route::get('/campaña/{id}/gallery/{gid}/delete',           'Admin\CampaignController@getCampaignGalleryDelete')->name('campaña_edit');

    //Module Community
        Route::get('/comunidades/{status}/',                           'Admin\CommunityController@getHome')->name('comunidades');
        Route::get('/comunidad/add',                                  'Admin\CommunityController@getCommunityAdd')->name('comunidad_add');
        Route::post('/comunidad/add/',                                'Admin\CommunityController@postCommunityAdd')->name('comunidad_add');
        Route::get('/comunidad/{id}/edit',                           'Admin\CommunityController@getCommunityEdit')->name('comunidad_edit');
        Route::post('/comunidad/{id}/edit',                          'Admin\CommunityController@postCommunityEdit')->name('comunidad_edit');
        Route::get('/comunidad/{id}/delete',                         'Admin\CommunityController@getCommunityDelete')->name('comunidad_delete');
        Route::get('/comunidad/{id}/restore',                        'Admin\CommunityController@getCommunityRestore')->name('comunidad_delete');
        Route::post('/comunidad/{id}/gallery/add/{gallery}',         'Admin\CommunityController@postCommunityGalleryAdd')->name('comunidad_edit');
        Route::get('/comunidad/{id}/gallery/{gid}/delete',           'Admin\CommunityController@getCommunityGalleryDelete')->name('comunidad_edit');

    //Module Exhibition
        Route::get('/exhibiciones/{status}/',                           'Admin\ExhibitionController@getHome')->name('exhibiciones');
        Route::get('/exhibicion/add',                                  'Admin\ExhibitionController@getExhibitionAdd')->name('exhibicion_add');
        Route::post('/exhibicion/add/',                                'Admin\ExhibitionController@postExhibitionAdd')->name('exhibicion_add');
        Route::get('/exhibicion/{id}/edit',                           'Admin\ExhibitionController@getExhibitionEdit')->name('exhibicion_edit');
        Route::post('/exhibicion/{id}/edit',                          'Admin\ExhibitionController@postExhibitionEdit')->name('exhibicion_edit');
        Route::get('/exhibicion/{id}/delete',                         'Admin\ExhibitionController@getExhibitionDelete')->name('exhibicion_delete');
        Route::get('/exhibicion/{id}/restore',                        'Admin\ExhibitionController@getExhibitionRestore')->name('exhibicion_delete');
        Route::post('/exhibicion/{id}/gallery/add/{gallery}',         'Admin\ExhibitionController@postExhibitionGalleryAdd')->name('exhibicion_edit');
        Route::get('/exhibicion/{id}/gallery/{gid}/delete',           'Admin\ExhibitionController@getExhibitionGalleryDelete')->name('exhibicion_edit');


    //Module Recycling
        Route::get('/reciclajes/{status}/',                           'Admin\RecyclingController@getHome')->name('reciclajes');
        Route::get('/reciclaje/add',                                  'Admin\RecyclingController@getRecyclingAdd')->name('reciclaje_add');
        Route::post('/reciclaje/add/',                                'Admin\RecyclingController@postRecyclingAdd')->name('reciclaje_add');
        Route::get('/reciclaje/{id}/edit',                           'Admin\RecyclingController@getRecyclingEdit')->name('reciclaje_edit');
        Route::post('/reciclaje/{id}/edit',                          'Admin\RecyclingController@postRecyclingEdit')->name('reciclaje_edit');
        Route::get('/reciclaje/{id}/delete',                         'Admin\RecyclingController@getRecyclingDelete')->name('reciclaje_delete');
        Route::get('/reciclaje/{id}/restore',                        'Admin\RecyclingController@getRecyclingRestore')->name('reciclaje_delete');
        Route::post('/reciclaje/{id}/gallery/add/{gallery}',         'Admin\RecyclingController@postRecyclingGalleryAdd')->name('reciclaje_edit');
        Route::get('/reciclaje/{id}/gallery/{gid}/delete',           'Admin\RecyclingController@getRecyclingGalleryDelete')->name('reciclaje_edit');




});
