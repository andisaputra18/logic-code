<?php

namespace App\Http\Controllers;

use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $containers = Container::all();

        return view('page', compact('containers'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $number = $request->number;
        $position = $request->position;

        $container = new Container;

        if (strlen($number) == 7) {
            $numeric_arr = str_split($number);
            if ($position == 1 || $position == 2 || $position == 3) {
                if (str_contains($number, 0)) {
                    $this->notify("Container number can't contain 0 number!", 'danger');
                    return redirect()->to('/');
                }

                $prima = true;
                for ($i = 0; $i < count($numeric_arr); $i++) {
                    if ($numeric_arr[$i] == 1) {
                        $this->notify("Container number not prime number!", 'danger');
                        return redirect()->to('/');
                    }
                    for ($check = 2; $check < $numeric_arr[$i]; $check++) {
                        if ($numeric_arr[$i] % $check == 0) {
                            $prima = false;
                        }
                    }
                }

                if ($prima) {
                    $container->number = $number;
                    $container->position = $position;
                    $container->save();

                    $this->notify("Container number add successfully", 'success');
                    return redirect()->to('/');
                } else {
                    $this->notify("Container number not prime number!", 'danger');
                    return redirect()->to('/');
                }
            } else {
                $prima = true;
                for ($i = 0; $i < count($numeric_arr); $i++) {
                    for ($check = 2; $check < $numeric_arr[$i]; $check++) {
                        if ($numeric_arr[$i] % $check == 0) {
                            $prima = false;
                        }
                    }
                }

                if ($prima) {
                    $this->notify("Container number can't prime number!", 'danger');
                    return redirect()->to('/');
                } else {
                    $container->number = $number;
                    $container->position = $position;
                    $container->save();

                    $this->notify("Container number add successfully", 'success');
                    return redirect()->to('/');
                }
            }
        } else {
            $this->notify('Container must have 7 number numeric!', 'danger');
            return redirect()->to('/');
        }
    }

    protected function notify($message, $type)
    {
        Session::flash('message', $message);
        Session::flash('alert-class', "alert-$type");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
