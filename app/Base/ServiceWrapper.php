<?php
namespace App\Base;
use Illuminate\Support\Facades\DB;
class ServiceWrapper{

    public function __invoke(\Closure $action, \Closure $reject=null, $hasTransaction=true)
    {
        DB::beginTransaction();
         try{
       $actionResult = $action();     
        DB::commit();
    }
    catch(\Throwable $th){  
        DB::rollBack();
        // app()[ExceptionHandler::class]->report($th);
        !is_null($reject) && $reject();
        return new ServiceResult(false,$th->getMessage());
    }

        return new ServiceResult(true, $actionResult);
    }
        
    
}