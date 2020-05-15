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

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
//use FCM;

Route::get('/', 'UploadController@index');
Route::post('/store', 'UploadController@store');
Route::get('download/{filename}', function ($filename) {
    $file_path = 'files/' . $filename;
    if (file_exists($file_path)) {
        return Response::download($file_path, $filename, [
            'Content-Length: ' . filesize($file_path)
        ]);
    } else {
        exit('The file does not exist!');
    }
})->name('download');
Route::post('/download', 'UploadController@download');


Route::get('/fcm2', function () {
    $recipients = ["cyGVzrAiQ0CKW9LR_Ui0a1:APA91bEUttvARhE70o_PYtm-rH9vel3qZAm2ABuimVtB2P4RpzwMLBUuXtauG1ozjsXU7AxkBfHGOkZXcgiQ-c9UawxOStHkKHHIJcTq7urRn-qiUvwcwmg-JhCjUuZtp77Q8obEFFb6"];
    fcm()
        ->to($recipients) // $recipients must an array
        ->priority('high')
        ->timeToLive(0)
        ->data([
            'body' => 'testing ',
        ])
        ->notification([
            'title' => 'fuck u',
            'body' => 'اعتقد ذيج المكتبه احسن ',
          
        ])
        ->send();

    return "ok";
});
Route::get('/fcm', function () {
    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60 * 20);

    $notificationBuilder = new PayloadNotificationBuilder('Fuck you');
    $notificationBuilder->setBody('u r bitch')
        ->setSound('default');

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData(['a_data' => 'my_data']);

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();

    $token = "cyGVzrAiQ0CKW9LR_Ui0a1:APA91bEUttvARhE70o_PYtm-rH9vel3qZAm2ABuimVtB2P4RpzwMLBUuXtauG1ozjsXU7AxkBfHGOkZXcgiQ-c9UawxOStHkKHHIJcTq7urRn-qiUvwcwmg-JhCjUuZtp77Q8obEFFb6";


    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
    return "ok";
});
