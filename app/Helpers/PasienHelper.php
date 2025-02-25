<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class PasienHelper
{
    public static function findNoSep($kodeRegister)
    {
        return DB::connection('db_rsmm')
            ->table('BPJS_REGISTER')
            ->select('No_SEP as no_sep')
            ->where('No_Reg', trim($kodeRegister))
            ->limit(1)
            ->first();
    }
}
