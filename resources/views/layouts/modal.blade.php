<div  data-backdrop="static" data-keyboard="false" class="modal fade modalBR"  id="@php
    if(isset($id)){
        echo $id;
    }else{
        echo "modalBox";
    }
@endphp" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modalBox" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@yield('title')</h5>
                <button name="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>
            <div class="modal-body">
                @yield('content')
            </div>
            <div class="modal-footer">
                    @yield('footer') 
            </div>
        </div>
    </div>
</div>