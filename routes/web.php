<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\ManageAccountController;
use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\SeverityController;
use App\Http\Controllers\SitRepController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EVerificationController;
use App\Http\Controllers\RegisteredUserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvide[r and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::get('/login', function () {
    return view('/dashboard');
})->name('login');

// when someone is login it will call the /home
// routes/web.php

// routes/web.php or routes/web.php
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');


// when someone is login it will call the /home
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth', 'verified')->name('dashboard');
Route::post('/eventupdate', [ScheduleController::class, 'update'])->middleware('auth', 'verified');

Route::middleware(['auth'])->group(function () {
    // Password change routes
    Route::controller(ChangePasswordController::class)->group(function(){
        Route::get('/password/change', 'showChangePasswordForm')->name('password.change');
        Route::post('/passwordChange', 'changePassword');
    }); 
});

Auth::routes([
    'verify' => true
]);

Route::middleware(['auth', 'Pdrrmo', 'verified'])->prefix('pdrrmo')->group(function () {
    Route::controller(ScheduleController::class)->group(function(){
        Route::get('/schedule', 'calendar')->name('mdrrmo.schedule');
        Route::get('/get-event/{id}', 'details' );
        Route::get('/ScheduleTable', 'events');
        Route::get('/Schedule-table', 'table')->name('mdrrmo.schedule');
        Route::get('/filter-event', 'filtereventpdrrmo');
        
         //update the data
        //delete
        Route::get('/get-sched/{id}', 'sched' );
        Route::get('/get-event/{id}', 'get' );
        Route::delete('/destroy-supplier/{id}', 'destroy');
        Route::get('fullcalenderAjax', 'ajax');
        Route::get('/fullcalender','index');
        Route::get('/details/{id}', 'details');
        Route::post('/update-event', 'tableupdate');
         Route::post('/updateEvent', 'modify');
        
        
    }); 

    

    Route::controller(ManageAccountController::class)->group(function(){
        Route::get('/filter-user', 'filter');

        
    });  
    //pdrrmo
    Route::controller(MemoController::class)->group(function(){
        Route::get('/memo', 'index');
        Route::delete('/destroy-memo/{id}', 'destroy');
        Route::get('/get-memo/{id}', 'edit');
        Route::post('/update-memo', 'update');
        Route::get('/memo-reads/{id}', 'getRead');
        Route::get('/filter', 'filter');
        
        Route::get('/get-recipient-content/{id}', 'RecipientContent');
        Route::get('/view/{filename}', 'view');
        Route::get('/viewmemo/{filename}', 'viewmemo');
       
        Route::get('/filter-memos', 'filter');
        Route::post('insert-memo','store');
        Route::get('/download/{filename}', 'download')->name('download');
        
    });  
    //pdrrmo
    Route::controller(ChatController::class)->group(function(){
        Route::get('/chat/{userId}', 'index')->name('chatpdrrmo.index');
        Route::post('/chat/send/{userId}', 'send')->name('chatpdrrmo.send');

    }); 
    //pdrrmo
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/MyAccount', 'logo');
         //fetch to 
         Route::post('insert-info', 'store');
         Route::post('/update-logo', 'updatelogo');

         Route::post('update-', 'update');
    

     }); 
     //pdrrmo
     Route::controller(ManageAccountController::class)->group(function(){
        Route::get('/manage-user', 'index');
        Route::get('/getInfo/{id}', 'details');
        Route::delete('/destroy-account/{id}', 'destroy');
        
        Route::get('/download-pic/{filename}', 'download')->name('download-pics');


     }); 
//pdrrmo

Route::controller(SubjectController::class)->group(function(){
    Route::get('/sitrepsub', 'index');
    Route::post('//insert-subject', 'store');
    Route::get('/filter-sitrep', 'filter');
 
    Route::get('/sitrep-finalize/{id}', 'finalize')->name('sitrep.finalize');
    
 }); 
     Route::controller(SitRepController::class)->group(function(){
        
        Route::get('/sitrep', 'index');
        Route::get('/export', 'exportfile');
        Route::post('/submit-sitrep', 'store');
        Route::get('/filter-sitrep', 'filter');
        Route::get('/sitrep-notifs/{id}', 'notifs');
        Route::get('/sitreps/{id}', 'summary')->name('sitrep.subject');
        Route::get('/sitreps-details/{id}', 'export')->name('sitrep.detail');
     }); 
     //pdrrmo
     Route::controller(RequestController::class)->group(function(){
        Route::get('/request', 'index');
        Route::post('/insert-request', 'store');
        Route::delete('/destroy-request/{id}', 'destroy');
        Route::get('/get-\request/{id}', 'edit');
        Route::post('/update-request', 'update');
     }); 
     
     //pdrrmo
     Route::controller(AssistanceController::class)->group(function(){
        Route::get('/assistanceRequest-accepted', 'accepted');
        Route::get('/assistanceRequest-declined', 'declined');
        Route::get('/assistanceRequest-pending', 'pending');
        Route::get('/receive-assistance', 'received');
        Route::get('/receivedRequest-notifs/{id}', 'ReceivedNotifspd');  
      
       
        Route::post('/insert-assistance', 'store');
        Route::delete('/destroy-request/{id}', 'destroy');
        Route::get('/get-request/{id}', 'edit');
        Route::post('/update-assistance', 'update');
        Route::get('/filter-req', 'filter');
        Route::post('/update-receive-assistance', 'updateStatus');
        Route::get('/get-referral-history/{id}', 'getReferralHistory');
    
     }); 
     //pdrrmo
     Route::controller(IncidentController::class)->group(function(){
        Route::get('/filter-incident', 'filter');
        Route::get('/incidents', 'index');
          //fetch to 
          Route::get('/get-incidents/{id}', 'edit');
           //update the data
          Route::post('update-incidents', 'update');
          //delete
          Route::delete('/destroy-incidents/{id}', 'destroy');
          //insert
          Route::post('insert-incidents','store');
          //filter
  });

  //pdrrmo
  Route::controller(PositionController::class)->group(function(){

    Route::get('/position', 'index');
      //fetch to 
      Route::get('/get-position/{id}', 'edit');
       //update the data
      Route::post('update-position', 'update');
      //delete
      Route::delete('/destroy-position/{id}', 'destroy');
      //insert
      Route::post('insert-position','store');
      //filter
});
//pdrrmo
Route::controller(DepartmentController::class)->group(function(){

      Route::get('/department', 'index');
      //fetch to 
      Route::get('/department/{id}', 'edit');
      Route::get('/get-department/{id}', 'edit');
       //update the data
      Route::post('update-department', 'update');
      //delete
      Route::delete('/destroy-department/{id}', 'destroy');
      //insert
      Route::post('insert-department','store');
      //filter
});
//pdrrmo
Route::controller(PersonnelController::class)->group(function(){
    Route::get('/personnel', 'index');
    //fetch to 
    
    Route::get('/filter-personnel', 'filter');
    Route::get('/get-personnel/{id}', 'edit');
     //update the data
    Route::post('update-personnel', 'update');
    //delete
    Route::delete('/destroy-supplier/{id}', 'destroy');
    //insert
    Route::post('insert-personnel','store');
    
});   
});


Route::middleware(['auth', 'Mdrrmo', 'verified'])->prefix('mdrrmo')->group(function () {
//Mdrrmo
    Route::controller(InventoryController::class)->group(function(){
            
        Route::get('/Inventory', 'index');
        //fetch to 
        Route::get('/get-item/{id}', 'edit');
         //update the data
        Route::post('update-item', 'update');
        //delete
        Route::delete('/destroy-item/{id}', 'destroy');
        //insert
        Route::post('insert-item','store');
        //filter
         // Route::get('/filter-report', 'filter');
        Route::get('/Inventory-mdrrmo', 'mdrrmo');
        Route::get('/municipality-mdrrmo', 'municipality');
       
        Route::get('/download-pic/{filename}', 'download')->name('download-pic');

       
    });
//Mdrrmo
    Route::controller(ChartController::class)->group(function(){
        Route::get('/chart-data', 'getChartData');
    });
    Route::controller(ChatController::class)->group(function(){
        Route::get('/chat/{userId}', 'index')->name('chat.index');
        Route::post('/chat/send/{userId}', 'send')->name('chat.send');

    });
    //Mdrrmo
    Route::controller(AssistanceController::class)->group(function(){
        Route::get('/filter-req', 'filter');
        Route::get('/assistanceRequest-accepted', 'accepted');
        Route::get('/assistanceRequest-declined', 'declined');
        Route::get('/assistanceRequest-pending', 'pending');
        Route::get('/totalsent-req', 'totalsent');
        Route::get('/totalaccepted-req', 'totalaccepted');
        Route::get('/totaldeclined-req', 'totaldeclined');
        Route::get('/totalpending-req', 'totalpending');
        Route::get('/receivedRequest-notifs/{id}', 'ReceivedNotifs');
        Route::get('/request-assistance', 'index');
        Route::get('/receive-assistance', 'received');
        Route::post('/insert-assistance', 'store');
        Route::delete('/destroy-request/{id}', 'destroy');
        Route::get('/get-request/{id}', 'edit');
        Route::post('/update-receive-assistance', 'updateStatus');
        Route::post('/update-assistance', 'update');
        Route::get('/response-notifs/{notifname}', 'StatusNotifs');
        Route::get('/filter-assistance', 'filterassistance');
        Route::get('/get-referral-history/{id}', 'getReferralHistory');
     });  
//Mdrrmo
    Route::controller(MemoController::class)->group(function(){
        Route::get('/memo', 'index');
        //fetch to 
        Route::get('/memo-prev/{filename}', 'view');
        Route::get('/markall', 'markall');
        Route::get('/readmark/{id}', 'markAsRead');
        Route::get('/view/{filename}', 'view');
        Route::get('/filter-memos', 'filter');
        Route::get('/memo-reads/{id}', 'getRead');
        Route::get('/memo-notifs/{id}', 'memoNotifs');
        //  //update the data
        Route::get('/get-memo/{id}', 'edit');
        //delete
        Route::delete('/destroy-memo/{id}', 'destroy');
        //insert
        Route::post('insert-memo','store');
        Route::get('/download/{filename}', 'download')->name('download');

    });  

    //Mdrrmo
        Route::controller(InventoryController::class)->group(function(){
          
        Route::get('/inventory', 'index');
        //fetch to 
        Route::get('/get-item/{id}', 'edit');
         //update the data
        Route::post('update-item', 'update');
        //delete
        Route::delete('/destroy-item/{id}', 'destroy');
        //insert
        Route::post('insert-item','store');
        Route::get('/All-Inventory', 'AllInventory');
        
        Route::get('/download-pic/{filename}', 'download')->name('download-pic');
        //filter
         // Route::get('/filter-report', 'filter');
       
    });
    //Mdrrmo
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category', 'index');
        //fetch to 
        Route::get('/get-category/{id}', 'edit');
         //update the data
        Route::post('update-category', 'update');
        //delete
        Route::delete('/destroy-category/{id}', 'destroy');
        //insert
        Route::post('insert-category','store');
        //filter
         // Route::get('/filter-report', 'filter');
    });
    Route::controller(SeverityController::class)->group(function(){
        Route::get('/severity', 'index');
        Route::post('/insert-severity', 'store');
        Route::delete('/destroy-severity/{id}', 'destroy');
        Route::get('/get-severity/{id}', 'edit');
        Route::post('/update-severity', 'update');
     }); 
    //Mdrrmo
       Route::controller(SupplierController::class)->group(function(){
        Route::get('/supplier', 'index');      
        //fetch to 
        Route::get('/get-supplier/{id}', 'edit');
         //update the data

        Route::post('update-supplier', 'update');
        //delete
        Route::delete('/destroy-supplier/{id}', 'destroy');
        //insert
        Route::post('insert-supplier','store');
        //filter
         // Route::get('/filter-report', 'filter');
       
    });
//Mdrrmo
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/MyAccount', 'logo');
         //fetch to 
         Route::post('insert-info', 'store');
         Route::post('/update-logo', 'updatelogo');

         Route::post('update-', 'update');
     });
     //Mdrrmo 
     Route::controller(SubjectController::class)->group(function(){
        Route::get('/sitrepsub', 'index');
        Route::get('/filter-sitrep', 'filter');
  
        Route::get('/subject-notif/{id}', 'notifs');
     }); 
     Route::controller(SitRepController::class)->group(function(){
        Route::get('/sitrep', 'index');
        Route::post('/submit-sitrep', 'store');
        Route::get('/filter-sitrep', 'filter');
        Route::delete('/destroy-sitrep/{id}', 'destroy');
        Route::post('edit-sitrep','update');
        Route::get('/sitreps-export/{id}', 'show')->name('sitrep.details');
     }); 
     //Mdrrmo
     Route::controller(ScheduleController::class)->group(function(){
        Route::get('/Schedule', 'calendar')->name('mdrrmo.schedule');
        Route::get('/get-event/{id}', 'details' );
        Route::get('/ScheduleTable', 'events');
        Route::get('/read-sched/{id}', 'read');
        Route::post('/event-sent', 'storeevent');
        Route::get('/filter-event', 'filtereventmdrrmo');
        Route::post('/update-event', 'tableupdate');
        Route::get('/Schedule-table', 'table')->name('mdrrmo.schedule');
      
         //update the data
        //delete
        Route::get('/get-sched/{id}', 'sched' );
        Route::delete('/destroy-supplier/{id}', 'destroy');
        Route::get('fullcalenderAjax', 'ajax');
        Route::get('/fullcalender','index');
        Route::get('/details/{id}', 'details');
        Route::post('/event-update', 'update');
         Route::post('/updateEvent', 'modify');
        
        
    }); 
    //Mdrrmo
    
    Route::controller(PositionController::class)->group(function(){

          Route::get('/position', 'index');
          //fetch to 
          Route::get('/get-position/{id}', 'edit');
           //update the data
          Route::post('update-position', 'update');
          //delete
          Route::delete('/destroy-position/{id}', 'destroy');
          //insert
          Route::post('insert-position','store');
          //filter
  });
  //Mdrrmo
   Route::controller(DepartmentController::class)->group(function(){

          Route::get('/department', 'index');
          //fetch to 
          Route::get('/department/{id}', 'edit');
          Route::get('/get-department/{id}', 'edit');
           //update the data
          Route::post('update-department', 'update');
          //delete
          Route::delete('/destroy-department/{id}', 'destroy');
          //insert
          Route::post('insert-department','store');
          //filter
  });
  //Mdrrmo
  Route::controller(PersonnelController::class)->group(function(){
    Route::get('/personnel', 'index');
    //fetch to 
    Route::get('/get-personnel/{id}', 'edit');
     //update the data
    Route::post('update-personnel', 'update');
    //delete
    Route::delete('/destroy-supplier/{id}', 'destroy');
    //insert
    Route::post('insert-personnel','store');


    
});   
//Mdrrmo
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/web.php
Route::post('/register-user', [CustomRegisterController::class, 'register']);

Route::get('/register', 'Auth\CustomRegisterController@showRegistrationForm')->name('register');


require __DIR__.'/auth.php';
