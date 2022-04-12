<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\StoreadminRequest;
use App\Http\Requests\UpdateadminRequest;
use App\Models\admin;
use App\Models\Card;
use App\Models\ChildUser;
use App\Models\ParentUser;
use App\Models\refunds;
use App\Models\Transaction;
use App\Models\vendor;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = admin::all();
        return response()->json($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreadminRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreadminRequest $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string|max:6',
            'phone_number' => 'required|integer|digits_between:12,12',
            'address' => 'required|string',
            'dob' => 'date',
            'joining_date'=>'date',
        ]);
        $newAdmin = new admin([
            'name' => $request->get('name'),
            'phone_number' => $request->get('phone_number'),
            'address'=>$request->get('address'),
            'email'=>$request->get('email'),
            'password'=>$request->get('password'),
            'dob'=>$request->get('dob'),
            'joining_date'=>$request->get('joining_date'),
        ]);

        $newAdmin->save();

        return response()->json($newAdmin);
    }
    /**
     * Display the specified resource.
     *
     * @param \App\Models\admin $admin
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(admin $admin)
    {
       // $admin = admin::where('show','=',$admin)->firstorFail();
        $admin =admin::all();
     //   $admin =admin::findOrFail($admin);
        return response()->json($admin);
    }
    public function showadminid(Request $request,$admin)
    {
        $admin = admin::where('id', '=', $admin)->firstOrFail();
        return response()->json($admin);
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\admin $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateadminRequest $request
     * @param \App\Models\admin $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateadminRequest $request, admin $admin)
    {
        $admin = admin::findOrFail($admin);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users|email',
            'password' => 'required|string|max:6',
            'phone_number' => 'required|integer|digits_between:12,12',
            'address' => 'required|string',
            'dob' => 'date',
            'joining_date'=>'date',
        ]);
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->password = $request->get('password');
        $admin->phone_number= $request->get('phone_number');
        $admin->aadhar= $request->get('aadher');
        $admin->dob = $request->get('dob');
        $admin->joining_date = $request->get('joining_date');
        $admin->save();
        return response()->json($admin);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\admin $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {

    }
    public function showparent($parentUser)
    {
        $user = ParentUser::findOrFail($parentUser);
        return response()->json($user);
    }

    public function showchild($childU)
    {
        $user = ChildUser::findOrFail($childU);
        return response()->json($user);
    }

    public function showtransaction($transaction)
    {
        $user = Transaction::findOrFail($transaction);
       // $user = Card::where('id', '=', $transaction)->firstOrFail();

        return response()->json($user);

    }
    public function showcard($card)
    {
        //$user = Card::findOrFail($card);
        $user = Card::where('card_number', '=', $card)->firstOrFail();
        return response()->json($user);
    }
    public function showrefund( $refund_id)
    {
        $refunds =refunds::findOrFail($refund_id);
        return response()->json($refunds);
    }
    public function showvendor($vendor)
    {
        $vendors = Vendor::findOrFail($vendor);
        return response()->json($vendors);
    }
}