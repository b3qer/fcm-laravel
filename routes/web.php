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

Route::get('/', 'UploadController@index');
Route::post('/store', 'UploadController@store');
Route::get('download/{filename}', function($filename)
{
    $file_path = 'files/'. $filename;
    if (file_exists($file_path))
    {
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        exit('The file does not exist!');
    }
})->name('download');
Route::post('/download', 'UploadController@download');
