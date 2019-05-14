<div class="form-group row">
    <label for="username" class="col-4 col-form-label">@lang('Users.userName')</label>
    <div class="col-8">
        <input value="@isset($user){{$user->name}}@endisset" id="name" name="name" type="text" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="text" class="col-4 col-form-label">@lang('Users.password')</label>
    <div class="col-8">
        <input id="text" name="password" type="password" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="text" class="col-4 col-form-label">@lang('Users.email')</label>
    <div class="col-8">
        <input value="@isset($user){{$user->email}}@endisset" id="text" name="email" type="text" class="form-control">
    </div>   
</div>

<div class="form-group row">
    <label for="text" class="col-4 col-form-label">Rol</label>
    <div class="col-8">
        <select id="rol" name="rol" class="form-control">
            <option value="" >@lang('Users.selectRole')</option>
            <option value="1" >@lang('Users.admin')</option>
            <option value="2">@lang('Users.waiter')</option>
            <option value="3">@lang('Users.chef')</option>
            <option value="4">@lang('Users.client')</option>
        </select>
    </div>
</div>