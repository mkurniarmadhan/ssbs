<?php

return [
  ['POST', '/api/booking', 'App\Http\Controllers\BookingController@store'],
  ['GET',  '/api/bookings', 'App\Http\Controllers\BookingController@index'],
  ['GET', '/api/booking-test', 'App\Http\Controllers\BookingController@indexTest'],
];
