<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    public function getPosts(Request $request)
    {
        if ($request->ajax()) {
            $query = Post::with('user');
            $query = $this->applySearchFilter($query, $request);

            $table = Datatables::of($query->get());

            $table->addIndexColumn();

            $table->addColumn('user_name', function (Post $post) {
                return $post->user->name;
            });

            $table->addColumn('status', function (Post $post) {
                return $post->user->is_active ? 'active' : 'in-active';
            });

            $table->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="'.$row->id.'">Edit</a>';
                $actionBtn.= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="'.$row->id.'">Delete</a>';
                return $actionBtn;
            });

            $table->editColumn('created_at', function ($row) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)
                    ->format('d-m-Y');
            });

            $table->rawColumns(['action']);

            $table->setRowClass(function ($row) {
                return $row->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            });

            return $table->make(true);
        }
    }

    private function applySearchFilter(QueryBuilder $query, Request $request): QueryBuilder
    {
        if ($request->has('status') && !is_null($request->status)) {
            $query->where('posts.is_active', $request->status);
        }
        if ($request->has('from_date') && $request->has('to_date') &&
            !is_null($request->from_date) && !is_null($request->to_date)) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        return $query;
    }
}
