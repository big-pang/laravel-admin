<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use Log;
use Auth;

class RoleController extends Controller
{
    protected $fields = [
        'name' => '',
        'description' => '',
        'permissions' => [],
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = array();
            $data['draw'] = $request->get('draw');
            $start = $request->get('start');
            $length = $request->get('length');
            $order = $request->get('order');
            $columns = $request->get('columns');
            $search = $request->get('search');
            $data['recordsTotal'] = Role::count();
            if (strlen($search['value']) > 0) {
                $data['recordsFiltered'] = Role::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('description', 'like', '%' . $search['value'] . '%');
                })->count();
                $data['data'] = Role::where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%')
                        ->orWhere('description', 'like', '%' . $search['value'] . '%');
                })
                    ->skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            } else {
                $data['recordsFiltered'] = Role::count();
                $data['data'] = Role::
                skip($start)->take($length)
                    ->orderBy($columns[$order[0]['column']]['data'], $order[0]['dir'])
                    ->get();
            }
            return response()->json($data);
        }
        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $arr = Permission::all()->toArray();
        foreach ($arr as $v) {
            $data['permissionAll'][$v['cid']][] = $v;
        }
        return view('admin.role.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        // dd($request->get('permission'));
        $role = new Role();
        foreach (array_keys($this->fields) as $field) {
            $role->$field = $request->get($field);
        }
        unset($role->permissions);
        // dd($request->get('permission'));
        $role->save();
        if (is_array($request->get('permissions'))) {
            $role->permissions()->sync($request->get('permissions',[]));
        }
        event(new \App\Events\userActionEvent('\App\Models\Admin\Role',$role->id,1,"用户".Auth::user()->username."{".Auth::user()->id."}添加角色".$role->name."{".$role->id."}"));
        return redirect('/admin/role')->withSuccess('添加成功！');
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
        $role = Role::find((int)$id);
        if (!$role) return redirect('/admin/role')->withErrors("找不到该角色!");
        $permissions = [];
        if ($role->permissions) {
            foreach ($role->permissions as $v) {
                $permissions[] = $v->id;
            }
        }
        $role->permissions = $permissions;
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $role->$field);
        }
        $arr = Permission::all()->toArray();
        foreach ($arr as $v) {
            $data['permissionAll'][$v['cid']][] = $v;
        }
        $data['id'] = (int)$id;
        return view('admin.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionUpdateRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = Role::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $role->$field = $request->get($field);
        }
        unset($role->permissions);
        $role->save();

        $role->permissions()->sync($request->get('permissions',[]));
        event(new \App\Events\userActionEvent('\App\Models\Admin\Role',$role->id,3,"用户".Auth::user()->username."{".Auth::user()->id."}编辑角色".$role->name."{".$role->id."}"));
        return redirect('/admin/role')->withSuccess('修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find((int)$id);
        foreach ($role->users as $v){
            $role->users()->detach($v);
        }

        foreach ($role->permissions as $v){
            $role->permissions()->detach($v);
        }

        if ($role) {
            $role->delete();
        } else {
            return redirect()->back()
                ->withErrors("删除失败");
        }
        event(new \App\Events\userActionEvent('\App\Models\Admin\Role',$role->id,2,"用户".Auth::user()->username."{".Auth::user()->id."}删除角色".$role->name."{".$role->id."}"));
        return redirect()->back()
            ->withSuccess("删除成功");
    }
}
