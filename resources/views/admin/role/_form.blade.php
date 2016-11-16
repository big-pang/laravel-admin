<div class="form-group">
    <label for="tag" class="col-md-3 control-label">角色名称</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="name" id="tag" value="{{ $name }}" autofocus>
    </div>
</div>
<div class="form-group">
    <label for="tag" class="col-md-3 control-label">角色概述</label>
    <div class="col-md-5">
        <textarea name="description" class="form-control" rows="3">{{ $description }}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="tag" class="col-md-3 control-label">权限列表</label>
</div>
<div class="form-group">
    <div class="form-group">
        @if($permissionAll)
            @foreach($permissionAll[0] as $v)
                <div class="form-group">
                    <label class="control-label col-md-3 all-check">
                        {{$v['label']}}：
                    </label>
                    <div class="col-md-6">
                        @if(isset($permissionAll[$v['id']]))

                            @foreach($permissionAll[$v['id']] as $vv)
                                <div class="col-md-4" style="float:left;padding-left:20px;margin-top:8px;">
                        <span class="checkbox-custom checkbox-default">
                        <i class="fa"></i>
                            <input class="form-actions"
                                   @if(in_array($vv['id'],$permissions))
                                   checked
                                   @endif
                                   id="inputChekbox{{$vv['id']}}" type="Checkbox" value="{{$vv['id']}}"
                                   name="permissions[]"> <label for="inputChekbox{{$vv['id']}}">
                                {{$vv['label']}}
                            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
<script>
    $(function () {
        $('.all-check').on('click', function () {

        });
    });
</script>

