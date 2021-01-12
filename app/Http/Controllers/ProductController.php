<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->getData();
        dump($data);
        return response($data);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->getData();
        $dataNew = $request->all();
        $data->push(collect($dataNew));
        dump($data);
        return response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = $request->all();
        $data = $this->getData();
        $selectData = $data->where('id', $id)->first();
        $selectData = $selectData->merge(collect($form));

        return response($selectData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->getData();
        $data = $data->filter(function($product) use ($id){
            return $product['id'] != $id;
        });
        return response($data->values());
    }

    public function getData()
    {
        return collect([
            collect([
                'id' => 0,
                'title' => '測試商品一',
                'content' => '這是很棒的商品',
                'price' => 50
            ]),
            collect([
                'id' => 1,
                'title' => '測試商品二',
                'content' => '這是有點棒的商品',
                'price' => 30
            ]),
            collect([
                'id' => 1,
                'title' => '測試商品二',
                'content' => '這是有點棒的商品',
                'price' => 30
            ])
        ]);
    }
}
