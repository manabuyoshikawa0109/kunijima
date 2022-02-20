<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;

class SqlController extends Controller
{
    /**
    * インポートされたExcelファイルからinsert文を作成
    *
    * @param Request $request
    * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
    */
    public function insert(Request $request)
    {
        $sql = null;
        if ($request->isMethod('post')) {
            $table = $request->table;
            $data = Excel::toArray(new \stdClass(), $request->file('excel'));

            $rows = $data[0];
            $lastRowNumber = array_key_last($rows);
            $columnList = null;
            $valueList = '';
            foreach ($rows as $rowNumber => $row) {
                if($rowNumber === 0){
                    $columnList = '("' . implode('", "', $row) . '")';
                    continue;
                }
                $delimiter = ',';
                if($rowNumber === $lastRowNumber){
                    $delimiter = ';';
                }
                $valueList .= '("' . implode('", "', $row) . '")' . $delimiter . "\n";
            }
            $sql = "INSERT INTO '{$table}' {$columnList} VALUES\n {$valueList}";
        }
        return view('user.pages.auth.sql.insert', compact('sql'));
    }
}
