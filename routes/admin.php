<?php
Route::group(['middleware' => 'admin_auth'], function () {
    // 首页
    Route::any('/','IndexController@index')->name('admin.index');
    // 广告位管理
    Route::get('/bannerList','BannerController@bannerList')->name('admin.banner.list');
    Route::get('/bannerAdd','BannerController@bannerAdd')->name('admin.banner.add');
    Route::post('/bannerSave','BannerController@bannerSave')->name('admin.banner.save');
    Route::get('/bannerEdit/{id}','BannerController@bannerEdit')->name('admin.banner.edit');
    Route::post('/bannerUpdate/{id}','BannerController@bannerUpdate')->name('admin.banner.update');
    Route::get('/bannerDel/{id}','BannerController@bannerDel')->name('admin.banner.del');

    // 广告管理
    Route::get('/bannerRecordList/{id}','BannerController@bannerRecordList')->name('admin.banner.record.list');
    Route::get('/bannerRecordAdd/{id}','BannerController@bannerRecordAdd')->name('admin.banner.record.add');
    Route::post('/bannerRecordSave','BannerController@bannerRecordSave')->name('admin.banner.record.save');
    Route::get('/bannerRecordEdit/{id}','BannerController@bannerRecordEdit')->name('admin.banner.record.edit');
    Route::post('/bannerRecordUpdate/{id}','BannerController@bannerRecordUpdate')->name('admin.banner.record.update');
    Route::get('/bannerRecordDel/{id}','BannerController@bannerRecordDel')->name('admin.banner.record.del');

    // 管理员
    Route::get('/adminList','AdminController@list')->name('admin.admin.list');
    Route::get('/adminAdd','AdminController@add')->name('admin.admin.add');
    Route::post('/adminSave','AdminController@save')->name('admin.admin.save');
    Route::get('/adminEdit/{id}','AdminController@edit')->name('admin.admin.edit');
    Route::post('/adminUpdate/{id}','AdminController@update')->name('admin.admin.update');
    Route::get('/adminDestroy/{id}','AdminController@destroy')->name('admin.admin.destroy');

    // 课程管理
    Route::get('/course/list','CourseController@list')->name('admin.course.list');
    Route::get('/course/add','CourseController@add')->name('admin.course.add');
    Route::post('/course/save','CourseController@save')->name('admin.course.save');
    Route::get('/course/edit/{id}','CourseController@edit')->name('admin.course.edit');
    Route::post('/course/update/{id}','CourseController@update')->name('admin.course.update');
    Route::get('/course/destroy/{id}','CourseController@destroy')->name('admin.course.destroy');

    // 课程背景图片管理
    Route::get('/courseBackground/list/{id}','CourseBackgroundController@list')->name('admin.background.list');
    Route::get('/courseBackground/add/{id}','CourseBackgroundController@add')->name('admin.background.add');
    Route::post('/courseBackground/save','CourseBackgroundController@save')->name('admin.background.save');
    Route::get('/courseBackground/edit/{id}','CourseBackgroundController@edit')->name('admin.background.edit');
    Route::post('/courseBackground/update/{id}','CourseBackgroundController@update')->name('admin.background.update');
    Route::get('/courseBackground/destroy/{id}','CourseBackgroundController@destroy')->name('admin.background.destroy');

    // 课程-课时管理
    Route::get('/course/period/list/{id}','CoursePeriodController@list')->name('admin.period.list');
    Route::get('/course/period/add/{id}','CoursePeriodController@add')->name('admin.period.add');
    Route::post('/course/period/save','CoursePeriodController@save')->name('admin.period.save');
    Route::get('/course/period/edit/{id}','CoursePeriodController@edit')->name('admin.period.edit');
    Route::post('/course/period/update/{id}','CoursePeriodController@update')->name('admin.period.update');
    Route::get('/course/period/destroy/{id}','CoursePeriodController@destroy')->name('admin.period.destroy');

    // 课程-课时-问题管理
    Route::get('/course/period/question/list/{id}','CoursePeriodQuestionController@list')->name('admin.question.list');
    Route::get('/course/period/question/add/{id}','CoursePeriodQuestionController@add')->name('admin.question.add');
    Route::post('/course/period/question/save','CoursePeriodQuestionController@save')->name('admin.question.save');
    Route::get('/course/period/question/edit/{id}','CoursePeriodQuestionController@edit')->name('admin.question.edit');
    Route::post('/course/period/question/update/{id}','CoursePeriodQuestionController@update')->name('admin.question.update');
    Route::get('/course/period/question/destroy/{id}','CoursePeriodQuestionController@destroy')->name('admin.question.destroy');

    // 课程-课时-问题-答案管理
    Route::get('/course/period/question/answer/list/{id}','CoursePeriodQuestionAnswerController@list')->name('admin.answer.list');
    Route::get('/course/period/question/answer/add/{id}','CoursePeriodQuestionAnswerController@add')->name('admin.answer.add');
    Route::post('/course/period/question/answer/save','CoursePeriodQuestionAnswerController@save')->name('admin.answer.save');
    Route::get('/course/period/question/answer/edit/{id}','CoursePeriodQuestionAnswerController@edit')->name('admin.answer.edit');
    Route::post('/course/period/question/answer/update/{id}','CoursePeriodQuestionAnswerController@update')->name('admin.answer.update');
    Route::get('/course/period/question/answer/destroy/{id}','CoursePeriodQuestionAnswerController@destroy')->name('admin.answer.destroy');

    // 关于我们管理
    Route::get('/about/list','AboutController@list')->name('admin.about.list');
    Route::get('/about/add','AboutController@add')->name('admin.about.add');
    Route::post('/about/save','AboutController@save')->name('admin.about.save');
    Route::get('/about/edit/{id}','AboutController@edit')->name('admin.about.edit');
    Route::post('/about/update/{id}','AboutController@update')->name('admin.about.update');
    Route::get('/about/destroy/{id}','AboutController@destroy')->name('admin.about.destroy');
});


Route::get('/login','PublicController@login')->name('admin.login');
Route::get('/signOut','PublicController@signOut')->name('admin.login.out');;
Route::post('/login','PublicController@loginAct')->name('admin.login.act');

