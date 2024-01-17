<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Customer;
use App\Models\StatusFilterModel;
use App\Models\OrderItem;
use App\Models\Cancellation;
use App\Common\Authorizable;
use App\Helpers\ListHelper;
use App\Events\Order\OrderCreated;
use App\Events\Order\OrderFulfilled;
use App\Events\Order\OrderUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateOrderRequest;
use App\Http\Requests\Validations\FulfillOrderRequest;
use App\Repositories\Order\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



use App\Models\stylistRevealsItems;
use App\Models\StylistClientBookingAppointments;

// use App\Services\PdfInvoice;
// use Konekt\PdfInvoice\InvoicePrinter;

class OrderController extends Controller
{
    use Authorizable;

    private $model_name;

    private $order;

    /**
     * construct
     */
    public function __construct(OrderRepository $order)
    {
        parent::__construct();
        $this->model_name = trans('app.model.order');
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Route::is('admin.order.pickup')) {
            $fulfilment = Order::FULFILMENT_TYPE_PICKUP;
        } else {
            $fulfilment = Order::FULFILMENT_TYPE_DELIVER;
        }

        $orders = $this->order->all($fulfilment);

        $archives = $this->order->trashOnly();

        return view('admin.order.index', compact('orders', 'archives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchCutomer()
    {
        return view('admin.order._search_customer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['customer'] = $this->order->getCustomer($request->input('customer_id'));

        $data['cart_lists'] = $this->order->getCartList($request->input('customer_id'));

        if ($request->input('cart_id')) {
            $data['cart'] = $this->order->getCart($request->input('cart_id'));
        }

        return view('admin.order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
    {
        $order = $this->order->store($request);

        event(new OrderCreated($order));

        return redirect()->route('admin.order.order.index')
            ->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->order->find($id);

        $this->authorize('view', $order); // Check permission

        $address = $order->customer->primaryAddress();

        return view('admin.order.show', compact('order', 'address'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
    {

        $order = $this->order->find($id);

        $this->authorize('view', $order); // Check permission

        $order->invoice('D'); // Download the invoice
    }

    /**
     * Show the fulfillment form for the specified order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fulfillment($id)
    {
        $order = $this->order->find($id);
        $this->authorize('fulfill', $order);
        $carriers = ListHelper::carriers($order->shop_id);
        $reveal_id = $order->reveal_id;
        $order_status = $order->order_status_id;
        $dataHasReveal = stylistRevealsItems::where('id',$reveal_id)->first();
        if(isset($dataHasReveal))
        {
            $booking_id = $dataHasReveal->booking_id;
            $reveal_status = getRevealStatusKeyNameHelper('dispatched');
            StylistClientBookingAppointments::where('id',$booking_id)->update(['status' => $reveal_status]);
            $reveal_status = array('status' => $reveal_status);
            $dataHasReveal->update($reveal_status);
        }
        $reveal_dispatch_status = '';
        $booking_dispatch_status = '';
        $booking_infos = '';
        if($dataHasReveal)
        {
            $reveal_dispatch_status = $dataHasReveal->status;
            $reveal_dispatch_id = $dataHasReveal->id;
            $booking_infos  = StylistClientBookingAppointments::where('id',$dataHasReveal->booking_id)->latest()->first();
            if($booking_infos)
            {
                $booking_dispatch_status = $booking_infos->status;
                $booking_dispatch_id =$booking_infos->id;
            }
        }

        $update_filter_data = StatusFilterModel::where('booking_id', $booking_dispatch_id)->where('reveal_id', $reveal_dispatch_id)->latest()->first();
        if(isset($update_filter_data))
        {
            $update_filter_data->booking_status = $booking_dispatch_status;
            $update_filter_data->reveal_status = $reveal_dispatch_status;
            $update_filter_data->update();
        }
        return view('admin.order._fulfill', compact('order', 'carriers'));
    }

    public function deliveryBoys($id)
    {
        $order = $this->order->find($id);

        $deliveryboys = ListHelper::deliveryBoys($order->shop_id);

        return view('admin.order._assign_delivery_boy', compact('deliveryboys', 'order'));
    }

    public function assignDeliveryBoy(Request $request, $id)
    {
        $order = $this->order->find($id);

        $order->delivery_boy_id = $request->delivery_boy_id;
        $order->save();

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->order->find($id);

        $this->authorize('fulfill', $order); // Check permission

        return view('admin.order._edit', compact('order'));
    }

    /**
     * Fulfill the order
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function fulfill(FulfillOrderRequest $request, $id)
    {
        $order = $this->order->find($id);
        $this->authorize('fulfill', $order); // Check permission
        $this->order->fulfill($request, $order);
        event(new OrderFulfilled($order, $request->filled('notify_customer')));
        if (config('shop_settings.auto_archive_order') && $order->isPaid())
        {
            $this->order->trash($id);
            return redirect()->route('admin.order.order.index')->with('success', trans('messages.fulfilled_and_archived'));
        }
        $filters_status_update = '';
        if($order)
        {
            $filters_status_update = StatusFilterModel::where('reveal_id', $order->reveal_id)->where('order_id', $order->id)->where('order_number', $order->order_number)->first();
            if($filters_status_update)
            {
                $filters_status_update->order_status_id = $order->order_status_id;
                $filters_status_update->update();
            }
        }
        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * updateOrderStatus the order
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrderStatus(Request $request, $id)
    {
        
        $order = $this->order->find($id);
        $revela_status = '';
        $seve_deliver_option = '';
        $order_info = '';
        $order_deliver_date = '';
        $cancellation_status = '';
        // deliverd_date
        if(isset($request->order_status_id) && !empty($request->order_status_id) && ($request->order_status_id == 5))
        {
            $revela_status = 'awaiting_delivery';
        }
        else if(isset($request->order_status_id) && !empty($request->order_status_id) && ($request->order_status_id == 6))
        {
            $revela_status = 'delivered';
            $seve_deliver_option = 'delivered';
            $order_deliver_date = date('Y-m-d');
        }
        else if(isset($request->order_status_id) && !empty($request->order_status_id) && ($request->order_status_id == 7))
        {
            $revela_status = 'refunded';
            $cancellation_status = 6;
        }
        else
        {
            $revela_status = '';
        }
        $filters_status_update ='';
        if(isset($order) && !empty($order))
        {
            $order_info = Order::where('id',$order->id)->where('reveal_id', $order->reveal_id)->first();
            if($order_info)
            {

                $order_info->deliverd_status = $seve_deliver_option;
                $order_info->deliverd_date = $order_deliver_date;
                $order_info->update();
            }
            $update_reveal_status = stylistRevealsItems::where('id', $order->reveal_id)->latest()->first();
            if($update_reveal_status)
            {
                $update_reveal_status->status = $revela_status;
                $update_reveal_status->update();
            }
            $filters_status_update = StatusFilterModel::where('reveal_id', $order->reveal_id)->where('order_id', $order->id)->where('order_number', $order->order_number)->latest()->first();
            if(isset($filters_status_update) && !empty($filters_status_update))
            {
                $filters_status_update->reveal_status = $revela_status??'';
                $filters_status_update->order_delivery_date = $order_deliver_date??'';
                $filters_status_update->order_status_id = $request->order_status_id??'';
                $filters_status_update->cancellation_status = $cancellation_status??'';
                $filters_status_update->update();
            }

        }

        // $get_data_by_id = Order::Where('id', )
        $this->authorize('fulfill', $order); // Check permission

        $this->order->updateOrderStatus($request, $order);

        event(new OrderUpdated($order, $request->filled('notify_customer')));

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    public function adminNote($id)
    {
        $order = $this->order->find($id);

        $this->authorize('fulfill', $order); // Check permission

        return view('admin.order._edit_admin_note', compact('order'));
    }

    public function saveAdminNote(Request $request, $id)
    {
        $order = $this->order->find($id);

        // $this->authorize('fulfill', $order); // Check permission

        $this->order->updateAdminNote($request, $order);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request, $id)
    {
        $this->order->trash($id);

        return redirect()->route('admin.order.order.index')
            ->with('success', trans('messages.archived', ['model' => $this->model_name]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->order->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Toggle Payment Status of the given order, Its uses the ajax middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function togglePaymentStatus(Request $request, $id)
    {
        if (Auth::user()->isFromMerchant() && !vendor_get_paid_directly()) {
            return back()->with('warning', trans('messages.failed', ['model' => $this->model_name]));
        }

        $order = $this->order->find($id);

        $this->authorize('fulfill', $order); // Check permission

        if ($order->isPaid()) {
            $order->markAsUnpaid();
        } else {
            $order->markAsPaid();
        }

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->order->destroy($id);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }

    /**
     * Empty the Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emptyTrash(Request $request)
    {
        $this->order->emptyTrash($request);

        if ($request->ajax()) {
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model_name])]);
        }

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }



    public function show_order($id)
    {
        $customer_info = '';
        $customer_name = '';
        $customer_status = '';
        $orderitems_info ='';
        $order = $this->order->find($id);
        if(isset($order))
        {
            $customer_info = Customer::where('id', $order->customer_id)->first();
            if($customer_info)
            {
                $customer_name = $customer_info->name . ' ' .$customer_info->last_name;
                if($customer_info->active == 1)
                {
                    $customer_status = 'Active';
                }
            }
            $orderitems_info = OrderItem::where('order_id',$order->id )->get();
            // dd($orderitems_info);
        }
        return view('admin.order._show', compact('order', 'customer_name', 'customer_status', 'orderitems_info'));
    }
}
