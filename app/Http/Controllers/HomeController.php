<?php


namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\InventoryUserList;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use DB;

class HomeController extends Helper
{

    public $row_per_page = 50;


    public function dashboard(Request $request){

        $data = $this->getLayout('dashboard');

        $transacting = Helper::totalTransactingForChart($request);
        $original_order_list = Helper::originalOrderList($request);

        $total_merchant = clone $transacting;
        $original_data = clone $transacting;

        $transacting_merchant = Helper::transactingMerchant($transacting);

        $data['total_merchant'] = $total_merchant->get()->count();

        $get_c1_data = $this->get_c1_data($total_merchant->get(), $transacting_merchant->get());
        $data = array_merge($data,Helper::totalMerchantValuesForChart($get_c1_data));

        $get_c2_data = $this->get_c2_data($total_merchant);

        $data = array_merge($data,Helper::totalValuesForChart($get_c2_data));

        $get_c3_data = $this->get_c3_data($original_order_list);
        $data = array_merge($data,Helper::originalOrderListForChart($get_c3_data));

        $get_c4_data = $this->get_c4_data($original_order_list, @$request->c4_filterby);
        $data = array_merge($data,Helper::totalOrderForChart($get_c4_data));

        $data = array_merge($data,$this->onBoardData($data));

        $data['transacting_merchant'] = $data['tangail_transacting_count'] + $data['sirajganj_transacting_count'] + $data['sherpur_transacting_count'] + $data['jamalpur_transacting_count'];

        $data['total_order_list'] = $original_order_list->get();
        $data['original_data'] = clone $original_data;

        if ($request->ajax()) {
            return Helper::dashboardCharView($request, $data);
        } else {
            return view('dashboard')->with($data);
        }
    }

    public function MmList(Request $request){

        $data = $this->getLayout('navMmList');

        $data = array_merge($data,$this->filter($request));

        if (@$request->export_type == 'xlsx') {
            $columns = ["Slno", "Name", "Mobile Number", "Field Officer", "District", "Upazila", "Address"];
            $result = $this->excelExport($data['total_list'], $columns, 1,'mm_list-');
            return Response::download($result['filePath'], $result['file_name']);
        }

        if ($request->ajax()) return Response::json(View::make('mm.render-list', $data)->render());

        $data = array_merge($data,$this->onBoardData($data));
        return view('mm.list')->with($data);
    }


    public function transactingNonTransacting(Request $request)
    {
        $data = $this->getLayout('navTntmms');

        $data = array_merge($data,$this->filter($request));

        if (@$request->export_type == 'xlsx') {
            $columns = ["Slno", "Name", "Mobile Number", "Field Officer", "District", "Upazila", "Total Orders", "Total Sales"];
            $result = $this->excelExport($data['total_list'], $columns, 2,'tntmms_list-');
            return Response::download($result['filePath'], $result['file_name']);
        }

        if ($request->ajax()) return Response::json(View::make('mm.render-tntmms', $data)->render());

        $data = array_merge($data,$this->onBoardData($data));
        return view('mm.tntmms')->with($data);
    }

    public function transactionList(Request $request){

        $data = $this->getLayout('navTransactionList');
        $data = array_merge($data,$this->transactionFilter($request));

        if (@$request->export_type == 'xlsx') {
            $columns = ["Slno", "Order", "Name", "Mobile Number", "Field Officer", "District", "Upazila", "Payment Type", "Order Amount"];
            $result = $this->excelExport($data['total_list'], $columns, 3,'trans_list-');
            return Response::download($result['filePath'], $result['file_name']);
        }
        if ($request->ajax()) return Response::json(View::make('transactions.render-list', $data)->render());

        $data = array_merge($data,$this->onBoardData($data));
        return view('transactions.list')->with($data);
    }

    public function strmte_mngmnt(Request $request)
    {
        $data = $this->getLayout('navStrmntList');

        $data['list'] = InventoryUserList::paginate($this->row_per_page);
        $report_data = InventoryUserList::get();

        if (@$request->export_type == 'xlsx') {
            $columns = ["Slno", "Store Name", "District", "Merchant Name", "Contact Number"];
            $result = $this->excelExport($report_data, $columns, 4,'strmte_mngmnt_list-');
            return Response::download($result['filePath'], $result['file_name']);
        }

        if ($request->ajax()) {
            return Response::json(View::make('mm.render-strmte', $data)->render());
        } else {
            return view('mm.strmte')->with($data);
        }
    }

    public function orderTrack(Request $request){
        $data['order'] = Order::where('order_code', $request->order_code)->with('order_track')->first();

        return Response::json(View::make('transactions.order-track', $data)->render());
    }
}
