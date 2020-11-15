<?php

use zendzo\Press\Http\Controllers\TestController;

Route::view('test', 'press::test');

Route::get('controller', [Testcontroller::class, 'index']);