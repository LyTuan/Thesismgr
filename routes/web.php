<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Mail\UserPass;

Route::group(['middleware' => 'superadmin'], function () {
    Route::group(['prefix' => 'superadmin'], function() {
        Route::get('/', 'SuperAdmin\MainController@getIndex')->name('getSuperAdminDash');

        Route::get('faculty', 'SuperAdmin\FacultyController@getFacultyIndex')->name('getFacultyManage');
        Route::get('unit', 'SuperAdmin\FacultyController@getUnitIndex')->name('getUnitManage');
        Route::get('admin', 'SuperAdmin\AdminController@getIndex')->name('getAdminManage');
        Route::get('course', 'SuperAdmin\CourseController@getIndex')->name('superadmin.course');
        Route::get('branch', 'SuperAdmin\BranchController@getIndex')->name('superadmin.branch');

        Route::post('postFacultyAdd', 'SuperAdmin\FacultyController@postFacultyAdd')->name('postFacultyAdd');
        Route::post('postFacultyEdit', 'SuperAdmin\FacultyController@postFacultyEdit')->name('postFacultyEdit');
        Route::post('postFacultyDelete', 'SuperAdmin\FacultyController@postFacultyDelete')->name('postFacultyDelete');

        Route::post('postUnitAdd', 'SuperAdmin\FacultyController@postUnitAdd')->name('postUnitAdd');
        Route::post('postUnitEdit', 'SuperAdmin\FacultyController@postUnitEdit')->name('postUnitEdit');
        Route::post('postUnitDelete', 'SuperAdmin\FacultyController@postUnitDelete')->name('postUnitDelete');

        Route::post('postAdminAdd', 'SuperAdmin\AdminController@postAdminAdd')->name('postAdminAdd');
        Route::post('postAdminEdit', 'SuperAdmin\AdminController@postAdminEdit')->name('postAdminEdit');
        Route::post('postAdminDelete', 'SuperAdmin\AdminController@postAdminDelete')->name('postAdminDelete');

        Route::post('postCourseAdd', 'SuperAdmin\CourseController@postCourseAdd')->name('superadmin.postCourseAdd');
        Route::post('postCourseEdit', 'SuperAdmin\CourseController@postCourseEdit')->name('superadmin.postCourseEdit');
        Route::post('postCourseDelete', 'SuperAdmin\CourseController@postCourseDelete')->name('superadmin.postCourseDelete');

        Route::post('postBranchAdd', 'SuperAdmin\BranchController@postBranchAdd')->name('superadmin.postBranchAdd');
        Route::post('postBranchEdit', 'SuperAdmin\BranchController@postBranchEdit')->name('superadmin.postBranchEdit');
        Route::post('postBranchDelete', 'SuperAdmin\BranchController@postBranchDelete')->name('superadmin.postBranchDelete');

        // for ajax
        Route::post('apiFaculty', 'SuperAdmin\FacultyController@apiFaculty')->name('apiFaculty');
        Route::post('apiUnit', 'SuperAdmin\FacultyController@apiUnit')->name('apiUnit');
        Route::post('apiAdmin', 'SuperAdmin\AdminController@apiAdmin')->name('apiAdmin');
        Route::post('apiCourse', 'SuperAdmin\CourseController@apiCourse')->name('superadmin.apiCourse');
        Route::post('apiBranch', 'SuperAdmin\BranchController@apiBranch')->name('superadmin.apiBranch');
    });
});

Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'admin'],function() {
        Route::get('/',function () {
            return view('admin.dashboard');
        });
        Route::group(['prefix' => 'instructor'],function() {
            Route::get('/', 'Admin\InstructorController@getIndex')->name('getInstructorIndex');
            Route::post('postInstructorAdd', 'Admin\InstructorController@postInstructorAdd')->name('postInstructorAdd');
            Route::post('postInstructorEdit', 'Admin\InstructorController@postInstructorEdit')->name('postAdminInstructorEdit');
            Route::post('postInstructorDelete', 'Admin\InstructorController@postInstructorDelete')->name('postInstructorDelete');
            //for ajax
            Route::post('apiInstructor', 'Admin\InstructorController@apiInstructor')->name('apiInstructor');
        });
        Route::group(['prefix' => 'student'],function() {
            Route::get('/', 'Admin\StudentController@getIndex')->name('getStudentIndex');

            Route::post('postStudentAdd', 'Admin\StudentController@postStudentAdd')->name('postStudentAdd');
            Route::post('postStudentEdit', 'Admin\StudentController@postStudentEdit')->name('postStudentEdit');
            Route::post('postStudentDelete', 'Admin\StudentController@postStudentDelete')->name('postStudentDelete');

            //for ajax
            Route::post('apiStudent', 'Admin\StudentController@apiStudent')->name('admin.apiStudent');

        });
        Route::group(['prefix' => 'topic'],function(){
            Route::get('add','Admin\TopicController@getStudentCanAdd')->name('getStudentCanAdd');
            Route::post('add','Admin\TopicController@postStudentCanAdd')->name('postStudentCanAdd');
            Route::get('mailStudentCan','Admin\TopicController@sendMailStudentCan')->name('sendMailStudentCan');
            Route::get('managerRegister','Admin\TopicController@managerRegister')->name('managerRegister');
            Route::get('turnOnRegister','Admin\TopicController@turnOnRegister')->name('turnOnRegister');
            Route::get('turnOffRegister','Admin\TopicController@turnOffRegister')->name('turnOffRegister');
            Route::get('registerTopic','Admin\TopicController@topicRegister')->name('registerTopic');
            Route::post('postTopic','Admin\TopicController@postTopic')->name('postTopic');
            Route::get('withDrawTopic','Admin\TopicController@withDrawTopic')->name('withDrawTopic');

            Route::post('id-check', 'Admin\InstructorController@postIdCheck')->name('postIdCheck');
            Route::post('api/instructors', 'Admin\InstructorController@apiInstructor')->name('apiInstructor');

            Route::get('exportWordFile','Admin\TopicController@exportWordFile')->name('exportWordFile');
            Route::get('exportWordFileEditTopic','Admin\TopicController@exportWordFileEditTopic')->name('exportWordFileEditTopic');
            Route::get('exportWordFileCancelTopic','Admin\TopicController@exportWordFileCancelTopic')->name('exportWordFileCancelTopic');
            Route::post('id-check', 'Admin\InstructorController@postIdCheck')->name('postIdCheck');
            Route::post('api/instructors', 'Admin\InstructorController@apiInstructor')->name('apiInstructor');
        });

//        Route::group(['prefix' => 'student'],function() {
//            Route::get('add', 'Admin\StudentController@getStudentAdd')->name('getStudentAdd');
//            Route::post('add', 'Admin\StudentController@postStudentAdd')->name('postStudentAdd');
//        });

        Route::group(['prefix' => 'record'],function(){
            Route::get('receiveRecordMark','Admin\RecordController@receiveRecordMark')->name('receiveRecordMark');
            Route::get('managerRecordTopic','Admin\RecordController@managerRecordTopic')->name('managerRecordTopic');
            Route::get('turnOnRecordRegister','Admin\RecordController@turnOnRecordRegister')->name('turnOnRecordRegister');
            Route::get('turnOffRecordRegister','Admin\RecordController@turnOffRecordRegister')->name('turnOffRecordRegister');
            Route::get('checkValidRecord','Admin\RecordController@checkValidRecord')->name('checkValidRecord');
            Route::get('export_RecordValidList','Admin\RecordController@export_RecordValidList')->name('export_RecordValidList');
            Route::get('sendMailStudentHasTopic','Admin\RecordController@sendMailStudentHasTopic')->name('sendMailStudentHasTopic');
            Route::get('resendMailNoti','Admin\RecordController@resendMailNoti')->name('resendMailNoti');
            Route::post('postRecordCheckDelete','Admin\RecordController@postRecordCheckDelete')->name('postRecordCheckDelete');
            Route::post('apiStudent','Admin\RecordController@apiStudent')->name('apiStudent');
        });


        Route::group(['prefix' => 'defend'],function(){
            Route::get('assignReview','Admin\DefendController@assignReview')->name('assignReview');
            Route::get('makeCouncil','Admin\DefendController@makeCouncil')->name('makeCouncil');
            Route::get('exportEnd','Admin\DefendController@exportEnd')->name('exportEnd');
            Route::get('assignReview_export','Admin\DefendController@assignReview_export')->name('assignReview_export');
            Route::get('makeCouncil_export','Admin\DefendController@makeCouncil_export')->name('makeCouncil_export');
            Route::get('docSuggest_export','Admin\DefendController@docSuggest_export')->name('docSuggest_export');
        });

    });
});

Route::group(['middleware' => 'instructor'], function () {
    Route::group(['prefix' => 'instructor'], function() {
        Route::get('/', function () {
            return view('instructor.dashboard');
        });
        Route::get('profile', 'Instructor\InstructorController@getInstructorEdit')->name('getInstructorProfile');
        Route::post('profile', 'Instructor\InstructorController@postInstructorEdit')->name('postInstructorProfile');

        Route::get('change-password', 'Auth\ChangePasswordController@getInstructorPasswordChange')->name('getInstructorPasswordChange');
        Route::post('change-password', 'Auth\ChangePasswordController@postInstructorPasswordChange')->name('postInstructorPasswordChange');

        Route::get('getTopicAccept','Instructor\TopicController@getTopicAccept')->name('getTopicAccept');
        Route::get('accept/{id}','Instructor\TopicController@acceptTopic')->name('accept');
        Route::get('acceptTopic/{id}','Instructor\TopicController@acceptTopic')->name('acceptTopic');
        Route::get('denyTopic/{id}','Instructor\TopicController@denyTopic')->name('denyTopic');
    });
});

Route::group(['middleware' => 'student'], function () {
    Route::group(['prefix' => 'student'], function() {
        Route::get('/', function () {
            return view('student.dashboard');
        });
        Route::get('topicRegister','Student\TopicController@getViewRegister')->name('topicRegister');
        Route::post('postTopicStudent','Student\TopicController@postTopicStudent')->name('postTopicStudent');
        Route::get('listRegister','Student\TopicController@listRegister')->name('listRegister');
        Route::get('cancelRegister/{id}','Student\TopicController@cancelRegister')->name('cancelRegister');
        Route::get('editRegister/{id}','Student\TopicController@editRegister')->name('editRegister');
        Route::post('postTopicEdit','Student\TopicController@postTopicEdit')->name('postTopicEdit');

        Route::get('units', 'Student\UnitController@getIndex')->name('student.units.index');
        Route::get('scopes', 'Student\ScopeController@getIndex')->name('student.scopes.index');
        Route::get('search', 'Student\InstructorController@getSearch')->name('student.search');

        Route::post('units', 'Student\UnitController@apiInstructor')->name('student.units.apiInstructor');
        Route::post('scopes', 'Student\ScopeController@apiInstructor')->name('student.scopes.apiInstructor');
        Route::post('search', 'Student\InstructorController@apiInstructor')->name('student.search.apiInstructor');
    });

    Route::get('instructor/{id}', 'Student\InstructorController@getInstructorInfo')->name('student.instructor.info');
});

Route::group(['middleware' => 'notuser'], function () {
    // login
    Route::get('/', 'LoginController@getLogin')->name('getLoginR');
    Route::get('login', 'LoginController@getLogin')->name('getLogin');
    Route::post('login', 'LoginController@postLogin')->name('postLogin');

    //Password reset route
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');;
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');

    Route::get('activate/{code}', 'LoginController@activateAccount')->name('activateAccount');
    Route::post('activate/account', 'LoginController@postActivateAccount')->name('postActivateAccount');
});

// route for log out
Route::get('logout', 'LoginController@getLogout')->name('getLogout');