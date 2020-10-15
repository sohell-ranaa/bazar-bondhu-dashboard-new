<?php


namespace App\Helpers;

use App\Models\Order;
use Box\Spout\Common\Type;
use Box\Spout\Writer\WriterFactory;
use Carbon\Carbon;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class Helper
{

    public static function rowPerPage($row=50){
        return $row;
    }

    public static function getLayout($menu=''){
        $data[$menu] = 'active';
        $data['header'] = 'header';
        $data['side_bar'] = 'ekom_side_bar';
        $data['footer'] = 'footer';
        return $data;
    }

    public static function getOrders($district='', $upazila='', $search_string=''){
        $users = self::getUsers($district,$upazila,$search_string)->pluck('id');

        return Order::with('user')
            ->whereIn('user_id',$users)
            ->where('orders.status', '!=', 5)
            ->where('orders.is_public_order', '=', 2);
    }

    public static function getUsers($district='', $upazila='', $search_string=''){

        return User::where('center_name', 'LIKE', '% - MM')->where('direct_user',1)->with('orders')
            ->whereIn(DB::raw("lower(district)"), ['tangail','sirajganj','sherpur','jamalpur'])
            ->when($upazila, function ($query, $upazila) {
                return $query->where(DB::raw("lower(upazila)"), 'LIKE', '%' . strtolower($upazila) . '%');
            })
            ->when($search_string, function ($query, $search_string) {
                $query->where('name_en', 'LIKE', '%' . $search_string . '%');
                return $query->orwhere('phone', 'LIKE', '%' . $search_string . '%');
            })
            ->when($district, function ($query, $district) {
                return $query->where('district', 'LIKE', '%' . $district . '%');
            })
            ->orderby('created_at','desc');
    }

    public static function getUpazila(Request $request){
        $district = $request->district;
        try{
            $upazila = User::where('direct_user',1)->
            when($district, function ($query, $district) {
                return $query->where(DB::raw("lower(district)"), strtolower($district));
            })
                ->orderby('upazila','asc')
                ->distinct('upazila')->pluck('upazila');

            return response()->json(['response' => $upazila, 'status' => '200']);
        }catch (\Exception $e){
            return response()->json(['response' => $e->getMessage(), 'status' => '0']);
        }
    }

    public static function getStartingDate()
    {
        return Carbon::createFromDate(2020, 5, 5);
    }

    public static function districtWiseResult($methodName,$postfix){
        $districts = ['tangail','sirajganj','sherpur','jamalpur'];
        $total = 0;
        $data = array();
        foreach ($districts as $district){
            $value = self::$methodName(strtolower($district));
            $data[strtolower($district).$postfix] = $value;
            $total += $value;
        }
        $data['total'.$postfix] = $total;

        return $data;
    }

    public static function transacting($district='',$upazila='', $search_string=''){
        $users = self::getUsers($district, $upazila, $search_string)->pluck('id');
        return Order:: join('users','users.id', '=', 'orders.user_id')
            ->whereIn('user_id',$users)
            ->where('orders.status' ,'!=', 5)
            ->where('orders.is_public_order', '=', 2)
            ->where('orders.created_at', '>', Carbon::now()->subdays(90));
    }

    public static function transactingGet($district=''){
        return self::transacting($district)->distinct('user_id')->count();
    }

    public static function NonTransactingCount($data){

        $districts = ['tangail','sirajganj','sherpur','jamalpur'];
        $total = $subtotal = 0;
        foreach ($districts as $district){
            $total = $data[strtolower($district).'_onboarded_count'] - $data[strtolower($district).'_transacting_count'];
            $data[strtolower($district).'_nontransacting_count'] = $total;
            $subtotal += $total;
        }
        $data['total_nontransacting_count'] = $subtotal;

        return $data;
    }

    public static function transactingCount(){
        return self::districtWiseResult('transactingGet','_transacting_count');
    }

    public static function onBoardCount($district=''){
        $onborad = self::getUsers()->select('district', DB::raw("count('id') as total"))->groupBy('district')->get();
        $data  = array();
        $total = 0;
        foreach ($onborad as $value){
            $total += $value->total;
            $data[strtolower($value->district).'_onboarded_count'] = $value->total;
        }
        $data['total_onboarded_count'] = $total;
        return $data;
    }

    public static function notTransactingCount(){
        return self::districtWiseResult('notTransacting','_not_transacting_count');
    }

    public static function notOrderCount(){
        return self::districtWiseResult('notOrder','_not_order_count');
    }

    public static function salesCount(){
        return self::districtWiseResult('sales','_sales_count');
    }

    public static function ordersCount(){
        return self::districtWiseResult('orders','_order_count');
    }

    public static function nonTransacting($district='', $upazila='', $search_string=''){

        $users = self::getUsers($district, $upazila, $search_string);
        return $users->whereNotIn('id',self::transacting()->select('user_id')->distinct('user_id'));
    }

    public static function notTransacting($district=''){
        $users = self::transacting()->select('user_id')->distinct('user_id')->pluck('user_id');
        $users = User::join('orders','users.id', '=', 'orders.user_id')
            ->whereNotIn('user_id',$users)
            ->whereIn(DB::raw("lower(users.district)"), ['tangail','sirajganj','sherpur','jamalpur'])
            ->where('center_name', 'LIKE', '% - MM')
            ->when($district, function ($query, $district) {
                return $query->where(DB::raw("lower(users.district)"), 'LIKE', '%' . strtolower($district) . '%');
            })
            ->where('direct_user',1)
            ->where('orders.status' ,'!=', 5)
            ->where('orders.is_public_order', '=', 2)
            ->where('orders.created_at', '<=', Carbon::now()->subdays(90))
            ->distinct('users.id')->count();
        return $users;
    }

    public static function notOrder($district=''){

        $users = User::leftjoin('orders','users.id', '=', 'orders.user_id')
            ->whereIn(DB::raw("lower(users.district)"), ['tangail','sirajganj','sherpur','jamalpur'])
            ->when($district, function ($query, $district) {
                return $query->where(DB::raw("lower(users.district)"), 'LIKE', '%' . strtolower($district) . '%');
            })
            ->where('center_name', 'LIKE', '% - MM')
            ->where('direct_user',1)
            ->whereNull('orders.id')
            ->distinct('users.id')
            ->count();

        return $users;
    }

    public static function transactionFilter(Request $request){

        $orders = self::getOrders($request->district, $request->upazila, $request->search_string)->groupby('id');
        $data['total_list'] = $orders->get();
        $data['orders'] = $orders->paginate(self::rowPerPage());
        $data['fo_list'] = User::select(['id', 'name_en'])->where('direct_user', 1)->get();
        return $data;
    }

    public static function filter(Request $request){

        if($request->filterByStatus==2){
            $list = self::nonTransacting($request->district, $request->upazila, $request->search_string)->groupby('users.id');
        }elseif($request->filterByStatus==1){
            $list = self::transacting($request->district, $request->upazila, $request->search_string)->groupby('user_id');
        }else{
            $list = self::getUsers($request->district, $request->upazila, $request->search_string)->groupby('id');
            $orders = self::getOrders($request->district, $request->upazila, $request->search_string)->groupby('id');
            $data['orders'] = $orders->paginate(self::rowPerPage());
        }

        $data['total_list'] = $list->get();
        $data['list'] = $list->paginate(self::rowPerPage());
        $data['fo_list'] = User::select(['id', 'name_en'])->where('direct_user', 1)->get();
        return $data;
    }

    public static function sales($district){
        $users = self::getUsers($district)->pluck('id');
        return Order::with('users')
            ->whereIn('user_id',$users)
            ->where('orders.status', '!=', 5)
            ->where('orders.is_public_order', '=', 2)->sum('sub_total');
    }

    public static function orders($district){
        $users = self::getUsers($district)->pluck('id');
        return Order::with('users')
            ->whereIn('user_id',$users)
            ->where('orders.status', '!=', 5)
            ->where('orders.is_public_order', '=', 2)->count();
    }

    public static function onBoardData($data){
        $data = array_merge($data,self::onBoardCount());
        $data = array_merge($data,self::transactingCount());
        $data = array_merge($data,self::NonTransactingCount($data));
        $data = array_merge($data,self::notTransactingCount());
        $data = array_merge($data,self::notOrderCount());
        $data = array_merge($data,self::salesCount($data));
        $data = array_merge($data,self::ordersCount($data));
        return $data;
    }

    public static function excelExport($data,$columns, $type, $fileName){
        $result = array();
        $writer = WriterFactory::create(Type::XLSX);
        $result['file_name'] = $fileName . date("YmdHis") . ".xlsx";
        $result['filePath'] = base_path("tmp/" . $result['file_name']);
        File::put($result['filePath'], '');
        self::createExportFile($writer, $data, $columns, $type, $result['filePath']);
        return $result;
    }

    public static function createExportFile($writer, $data, $headerRow, $type, $filePath)
    {
        $writer->openToFile($filePath);
        $header_row = $headerRow;
        $writer->addRow($header_row);
        if ($type == 1) {

            foreach ($data as $key => $value) {
                $ofn = $value->district=='Sirajganj'?'Md. Nurul Alam Ansery':($value->district=='Tangail'?"Alauddin Al Azad":($value->district=='Jamalpur'?"Abdullah Bin Abdur Rahman":($value->district=='Sherpur'?"Md. Mahabub Alam":'')));
                $index_datas = array(
                    $key + 1,
                    @$value->name_en,
                    @$value->phone,
                    @$ofn,
                    @$value->district,
                    @$value->upazila,
                    @$value->address
                );
                $writer->addRow($index_datas);

            }
        }
        if ($type == 2) {
            foreach ($data as $key => $value) {
                $ofn = $value->district=='Sirajganj'?'Md. Nurul Alam Ansery':($value->district=='Tangail'?"Alauddin Al Azad":($value->district=='Jamalpur'?"Abdullah Bin Abdur Rahman":($value->district=='Sherpur'?"Md. Mahabub Alam":'')));
                $index_datas = array(
                    $key + 1,
                    @$value->name_en,
                    @$value->phone,
                    @$ofn,
                    @$value->district,
                    @$value->upazila,
                    @$value->orders->where('status', '!=', 5)->where('is_public_order', '=', 2)->count(),
                    @$value->orders->where('status', '!=', 5)->where('is_public_order', '=', 2)->sum('sub_total')
                );
                $writer->addRow($index_datas);
            }
        }
        if ($type == 3) {
            foreach ($data as $key => $value) {
                $ofn = $value->user->district=='Sirajganj'?'Md. Nurul Alam Ansery':($value->user->district=='Tangail'?"Alauddin Al Azad":($value->user->district=='Jamalpur'?"Abdullah Bin Abdur Rahman":($value->user->district=='Sherpur'?"Md. Mahabub Alam":'')));
                $index_datas = array(
                    $key + 1,
                    @$value->order_code,
                    @$value->user->name_en,
                    @$value->user->phone,
                    @$ofn,
                    @$value->user->district,
                    @$value->user->upazila,
                    @$value->payment_method == 1 ? "Cash On Delivery" : "Online Payment",
                    @$value->sub_total
                );
                $writer->addRow($index_datas);
            }
        }
        if ($type == 4) {
            foreach ($data as $key => $value) {
                $index_datas = array(
                    $key + 1,
                    @$value->store_name,
                    @$value->district,
                    @$value->merchant_name,
                    @$value->contact_number
                );
                $writer->addRow($index_datas);
            }
        }
        if ($type == 5) {
            foreach ($data as $key => $value) {
                $mobile_number = '';
                if ($value->phone) {
                    $mobile_number = $value->phone;
                } else if ($value->contact_number) {
                    $mobile_number = $value->contact_number;
                }
                $index_datas = array(
                    $key + 1,
                    @$value->name_bn,
                    @$value->center_name,
                    @$value->entrepreneur_id,
                    @$mobile_number,
                    @$value->email,
                    @$value->division,
                    @$value->district,
                    @$value->upazila,
                    @$value->union,
                );
                $writer->addRow($index_datas);
            }
        }

        $writer->close();
        return;
    }

    public static function get_c1_data($total_merchant, $transacting_merchant)
    {
        $return_data = array();
        $start_date = self::getStartingDate();
        $end = Carbon::now();
        $length = $start_date->diffInDays($end);
        $chart_labels = array();
        $total_merchant_values = array();
        $total_transacting_values = array();

        for ($i = 0; $i <= ceil($length / 30); $i++) {
            $sd = clone $start_date;
            $ed = $start_date->addDays(30);
            $chart_labels[] = '"' . $i * 30 . '"';
            $total_merchant_values[] = '"' . $total_merchant
                    ->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->count() . '"';

            $total_transacting_values[] = '"' . $transacting_merchant
                    ->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->count() . '"';
        }

        $return_data['chart_labels'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$chart_labels));
        $return_data['total_transacting_values'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$total_transacting_values));
        $return_data['total_merchant_values'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$total_merchant_values));
        return $return_data;
    }

    public static function get_c2_data($total_merchant)
    {

        $return_data = array();
        $start_date = self::getStartingDate();
        $end = Carbon::now();
        $length = $start_date->diffInDays($end);
        $chart_labels = array();
        $total_tangail_values = array();
        $total_sirajganj_values = array();
        $total_jamalpur_values = array();
        $total_sherpur_values = array();

        $ta = clone $total_merchant;
        $si = clone $total_merchant;
        $sh = clone $total_merchant;
        $ja = clone $total_merchant;

        for ($i = 0; $i <= ceil($length / 30); $i++) {
            $sd = clone $start_date;
            $ed = $start_date->addDays(30);
            $chart_labels[] = '"' . $i * 30 . '"';
            $total_tangail_values[] = '"' . $ta
                    ->where('district', 'LIKE', '%Tangail%')
                    ->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->count() . '"';
            $total_sirajganj_values[] = '"' . $si
                    ->where('district', 'LIKE', '%Sirajganj%')
                    ->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->count() . '"';
            $total_sherpur_values[] = '"' . $sh
                    ->where('district', 'LIKE', '%Sherpur%')
                    ->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->count() . '"';
            $total_jamalpur_values[] = '"' . $ja
                    ->where('district', 'LIKE', '%Jamalpur%')
                    ->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->count() . '"';
        }

        $return_data['chart_labels'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$chart_labels));
        $return_data['total_tangail_values'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$total_tangail_values));
        $return_data['total_sirajganj_values'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$total_sirajganj_values));
        $return_data['total_sherpur_values'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$total_sherpur_values));
        $return_data['total_jamalpur_values'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$total_jamalpur_values));

        return $return_data;
    }

    public static function get_c3_data($orderList)
    {
        $return_data = array();
        $start_date = self::getStartingDate();
        $end = Carbon::now();
        $length = $start_date->diffInDays($end);
        $chart_labels = array();
        $to = array();
        $toa = array();
        $aoa = array();

        $too = clone $orderList;
        $tooa = clone $orderList;

        for ($i = 0; $i <= ceil($length / 30); $i++) {
            $sd = clone $start_date;
            $ed = $start_date->addDays(30);
            $chart_labels[] = '"' . $i * 30 . '"';

            $tor = $too->where('created_at', '>=', $sd)
                ->where('created_at', '<=', $ed)->count();

            $toaa = $tooa->where('created_at', '>=', $sd)
                ->where('created_at', '<=', $ed)->sum('sub_total');

            if ($tor > 0 && $toaa > 0) {
                $av = round((int)($toaa / $tor));
            } else {
                $av = 0;
            }

            $to[] = '"' . $tor . '"';
            $toa[] = '"' . $toaa . '"';
            $aoa[] = '"' . $av . '"';
        }

        $return_data['chart_labels'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$chart_labels));
        $return_data['to'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$to));
        $return_data['toa'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$toa));
        $return_data['aoa'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$aoa));
        return $return_data;
    }

    public static function get_c4_data($orderList, $type = null)
    {
        $return_data = array();
        $start_date = self::getStartingDate();
        $end = Carbon::now();
        $length = $start_date->diffInDays($end);
        $chart_labels = array();
        $total_tangail_values = array();
        $total_sirajganj_values = array();
        $total_jamalpur_values = array();
        $total_sherpur_values = array();

        $ta = clone $orderList;
        $si = clone $orderList;
        $sh = clone $orderList;
        $ja = clone $orderList;

        for ($i = 0; $i <= ceil($length / 30); $i++) {
            $sd = clone $start_date;
            $ed = $start_date->addDays(30);
            $chart_labels[] = '"' . $i * 30 . '"';
            if ($type == "2") {
                $total_tangail_values[] = '"' . $ta
                        ->whereHas('users', function ($q) {
                            $q->where('district', 'LIKE', '%Tangail%');
                        })->where('created_at', '>=', $sd)
                        ->where('created_at', '<=', $ed)->sum('sub_total') . '"';
                $total_sirajganj_values[] = '"' . $si
                        ->whereHas('users', function ($q) {
                            $q->where('district', 'LIKE', '%Sirajganj%');
                        })->where('created_at', '>=', $sd)
                        ->where('created_at', '<=', $ed)->sum('sub_total') . '"';
                $total_sherpur_values[] = '"' . $sh
                        ->whereHas('users', function ($q) {
                            $q->where('district', 'LIKE', '%Sherpur%');
                        })->where('created_at', '>=', $sd)
                        ->where('created_at', '<=', $ed)->sum('sub_total') . '"';
                $total_jamalpur_values[] = '"' . $ja
                        ->whereHas('users', function ($q) {
                            $q->where('district', 'LIKE', '%Jamalpur%');
                        })->where('created_at', '>=', $sd)
                        ->where('created_at', '<=', $ed)->sum('sub_total') . '"';
            } elseif ($type == "3") {

                $a = $ta
                    ->whereHas('users', function ($q) {
                        $q->where('district', 'LIKE', '%Tangail%');
                    })->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->sum('sub_total');
                $b = $ta
                    ->whereHas('users', function ($q) {
                        $q->where('district', 'LIKE', '%Tangail%');
                    })->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->count();
                $total_tangail_values[] = '"' . 0 . '"';
                if ($a > 0 && $b > 0) {
                    $total_tangail_values[] = '"' . round((int)$a / $b) . '"';
                }

                $c = $si
                    ->whereHas('users', function ($q) {
                        $q->where('district', 'LIKE', '%Sirajganj%');
                    })->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->sum('sub_total');
                $d = $si
                    ->whereHas('users', function ($q) {
                        $q->where('district', 'LIKE', '%Sirajganj%');
                    })->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->count();
                $total_sirajganj_values[] = '"' . 0 . '"';

                if ($c > 0 && $d > 0) {
                    $total_sirajganj_values[] = '"' . round((int)$c / $d) . '"';
                }

                $e = $sh
                    ->whereHas('users', function ($q) {
                        $q->where('district', 'LIKE', '%Sherpur%');
                    })->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->sum('sub_total');
                $f = $sh
                    ->whereHas('users', function ($q) {
                        $q->where('district', 'LIKE', '%Sherpur%');
                    })->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->count();
                $total_sherpur_values[] = '"' . 0 . '"';

                if ($e > 0 && $f > 0) {
                    $total_sherpur_values[] = '"' . round((int)$e / $f) . '"';
                }
                $g = $ja
                    ->whereHas('users', function ($q) {
                        $q->where('district', 'LIKE', '%Jamalpur%');
                    })->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->sum('sub_total');
                $h = $ja
                    ->whereHas('users', function ($q) {
                        $q->where('district', 'LIKE', '%Jamalpur%');
                    })->where('created_at', '>=', $sd)
                    ->where('created_at', '<=', $ed)->count();

                $total_jamalpur_values[] = '"' . 0 . '"';
                if ($g > 0 && $h > 0) {
                    $total_jamalpur_values[] = '"' . round((int)$g / $h) . '"';
                }
            } else {
                $total_tangail_values[] = '"' . $ta
                        ->whereHas('users', function ($q) {
                            $q->where('district', 'LIKE', '%Tangail%');
                        })->where('created_at', '>=', $sd)
                        ->where('created_at', '<=', $ed)->count() . '"';
                $total_sirajganj_values[] = '"' . $si
                        ->whereHas('users', function ($q) {
                            $q->where('district', 'LIKE', '%Sirajganj%');
                        })->where('created_at', '>=', $sd)
                        ->where('created_at', '<=', $ed)->count() . '"';
                $total_sherpur_values[] = '"' . $sh
                        ->whereHas('users', function ($q) {
                            $q->where('district', 'LIKE', '%Sherpur%');
                        })->where('created_at', '>=', $sd)
                        ->where('created_at', '<=', $ed)->count() . '"';
                $total_jamalpur_values[] = '"' . $ja
                        ->whereHas('users', function ($q) {
                            $q->where('district', 'LIKE', '%Jamalpur%');
                        })->where('created_at', '>=', $sd)
                        ->where('created_at', '<=', $ed)->count() . '"';
            }
        }
        $return_data['chart_labels'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$chart_labels));
        $return_data['total_tangail_values'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$total_tangail_values));
        $return_data['total_sirajganj_values'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$total_sirajganj_values));
        $return_data['total_sherpur_values'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$total_sherpur_values));
        $return_data['total_jamalpur_values'] = preg_replace('/(^[\"\']|[\"\']$)/', '', implode(', ', @$total_jamalpur_values));

        return $return_data;
    }

    public static function totalValuesForChart($get_c2_data){

        $data['c2_labels'] = trim($get_c2_data['chart_labels'], '"');
        $data['total_tangail_values'] = trim($get_c2_data['total_tangail_values'], '"');
        $data['total_sirajganj_values'] = trim($get_c2_data['total_sirajganj_values'], '"');
        $data['total_sherpur_values'] = trim($get_c2_data['total_sherpur_values'], '"');
        $data['total_jamalpur_values'] = trim($get_c2_data['total_jamalpur_values'], '"');

        return $data;
    }

    public static function originalOrderListForChart($get_c3_data){
        $data['c3_labels'] = trim($get_c3_data['chart_labels'], '"');
        $data['to'] = trim($get_c3_data['to'], '"');
        $data['toa'] = trim($get_c3_data['toa'], '"');
        $data['aoa'] = trim($get_c3_data['aoa'], '"');
        return $data;
    }


    public static function totalMerchantValuesForChart($get_c1_data){
        $data['c1_labels'] = trim($get_c1_data['chart_labels'], '"');
        $data['c1_tm'] = trim($get_c1_data['total_merchant_values'], '"');
        $data['c1_ttm'] = trim($get_c1_data['total_transacting_values'], '"');
        return $data;
    }

    public static function totalOrderForChart($get_c4_data){
        $data['c4_labels'] = trim($get_c4_data['chart_labels'], '"');
        $data['total_tangail_order'] = trim($get_c4_data['total_tangail_values'], '"');
        $data['total_sirajganj_order'] = trim($get_c4_data['total_sirajganj_values'], '"');
        $data['total_sherpur_order'] = trim($get_c4_data['total_sherpur_values'], '"');
        $data['total_jamalpur_order'] = trim($get_c4_data['total_jamalpur_values'], '"');

        return $data;
    }
    public static function transactingMerchant($transacting){
        return $transacting->whereHas('order', function ($q) {
            $q->where('created_at', '>=', Carbon::now()->subDays(90));
        });
    }

    public static function originalOrderList(Request $request){
        return Order::whereHas('users', function ($q) use ($request) {
            $q->where('direct_user', 1);
            if ($request->c3_filterby) {
                $q->where('district', 'LIKE', '%' . $request->c3_filterby . '%');
            }
        })
            ->where('orders.status', '!=', 5)
            ->where('orders.is_public_order', '=', 2);
    }


    public static function totalTransactingForChart(Request $request){

        return User::where(function ($q) use ($request) {
            if ($request->c2_filterby) {
                if ($request->c2_filterby == 1) {
                    $q->doesntHave('order');
                    $q->whereIn('id',self::transacting()->select('user_id')->distinct('user_id'));
                }
                if ($request->c2_filterby == 2) {
                    $q->doesntHave('order');
                    $q->whereNotIn('id',self::transacting()->select('user_id')->distinct('user_id'));
                }
            }
        })  ->whereIn(DB::raw("lower(district)"), ['tangail','sirajganj','sherpur','jamalpur'])
            ->where('direct_user',1)
            ->where('center_name', 'LIKE', '% - MM')
            ->orderBy('id', 'desc');
    }

    public static function dashboardCharView($request, $data){

        if ($request->track == "c1") {
            return Response::json(View::make('dashboard.c1_view', $data)->render());
        } else if ($request->track == "c2") {
            return Response::json(View::make('dashboard.c2_view', $data)->render());
        } else if ($request->track == "c3") {
            return Response::json(View::make('dashboard.c3_view', $data)->render());
        } else if ($request->track == "c4") {
            return Response::json(View::make('dashboard.c4_view', $data)->render());
        }
    }


}
