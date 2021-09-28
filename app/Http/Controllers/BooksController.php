<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books/index');
    }

    /**
     * Returns the data for the table
     *
     * @return \Illuminate\Http\Response
     */
    public function table_data(Request $request)
    {
        $x = 0;
        $columns = [
            $x++ => 'id',
            $x++ => 'title',
            $x++ => 'description',
            $x++ => 'writer',
            $x++ => 'pages',
            $x++ => 'created_at',
            $x++ => 'buttons',
        ];

        $limit = $request->input('length');
        $start = $request->input('start');

        $datas = Book::select();

        $totalData = clone $datas;
        $totalData = $totalData->count();

        if ($request->input('search.value')) {
            $search = $request->input('search.value');

            $datas->where(function($query) use($search) {
                $query->where('title', 'LIKE', "%$search%");
                $query->orWhere('description', 'LIKE', "%$search%");
                $query->orWhereHas('writer', function($writer) use ($search) {
                    $writer->where('name', 'LIKE', "%$search%");
                });
            });
        }

        $totalFiltered = $datas->count();

        $datas->offset($start)
            ->limit($limit);

        foreach($request->order as $order){
            $column = $columns[$order['column']];
            $datas->orderBy($column, $order['dir']);
        }
        
        $datas = $datas->get();

        $dataArray = [];
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $x = 0;
                $show = ''; $edit = ''; $delete = '';
                
                // $show = "<button title='Visualizar' data-id='$data->id' class='btn btn-info btn-sm show-modal d-print-none'>
                //     <i class='fas fa-search'></i></button>"; 

                $nestedData[$columns[$x++]] = $data->id;
                $nestedData[$columns[$x++]] = $data->title;
                $nestedData[$columns[$x++]] = $data->description;
                $nestedData[$columns[$x++]] = $data->writer?->name;
                $nestedData[$columns[$x++]] = $data->pages;
                $nestedData[$columns[$x++]] = $data->created_at->format('Y-m-d H:i:s');
                $nestedData[$columns[$x++]] = "$show $edit $delete";
                $dataArray[] = $nestedData;
            }
        }

        $json_data = [
            "draw" => (int)$request->input('draw'),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $dataArray,
        ];
        
        return response()->json($json_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ // começa a validação de campos
            'title' => 'required',
            'description' => 'required',
            'writer' => 'required',
            'pages' => 'required',
        ])->validate();
        
        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $writer = Writer::firstOrCreate([
            'name' => $request->writer
        ]);
        $book->writer_id = $writer->id;
        $book->pages = $request->pages;
        $book->user_id = Auth::user()->id;
        $book->save();       
        
        return redirect("books");  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}