<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Item;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display the form to create a bill.
     */
    public function index()
    {
        // Fetch all items for the form dropdown
        $items = Item::all();
        return view('sales.index', compact('items'));
    }

    /**
     * Store a newly created bill and its associated items.
     */
    public function store(Request $request)
    {
        // Validate the request with custom messages
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ], [
            'items.required' => 'At least one item must be selected.',
            'items.*.item_id.exists' => 'Selected item is invalid.',
            'items.*.quantity.min' => 'Quantity must be at least 1.',
        ]);

        // Create a new bill with an initial total amount of 0
        $bill = Bill::create(['total_amount' => 0]);
        $totalAmount = 0;

        // Process each item in the request
        foreach ($request->items as $itemData) {
            $item = Item::findOrFail($itemData['item_id']);
            $totalPrice = $item->price * $itemData['quantity'];
            $totalAmount += $totalPrice;

            // Create a bill item record
            BillItem::create([
                'bill_id' => $bill->id,
                'item_id' => $item->id,
                'quantity' => $itemData['quantity'],
                'total_price' => $totalPrice,
            ]);
        }

        // Update the total amount in the bill
        $bill->update(['total_amount' => $totalAmount]);

        // Redirect to the invoice view
        return redirect()->route('sales.invoice', $bill->id)
            ->with('status', 'Bill created successfully.');
    }

    /**
     * Display the invoice for the specified bill.
     */
    public function showInvoice($id)
    {
        // Fetch the bill and its related items
        $bill = Bill::with('billItems.item')->findOrFail($id);

        // Return the invoice view
        return view('invoices.show', compact('bill'));
    }
}
