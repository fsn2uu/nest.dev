@if (\Session::has('toast'))
    <?php $toast = unserialize(\Session::get('toast')); ?>
    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
        <!-- Position it -->
        <div style="position: absolute; top: 0; right: 0;">
            <div class="toast" id="element" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="min-width:300px;">
                <div class="toast-header">
                    {{-- <img src="..." class="rounded mr-2" alt="..."> --}}
                    <i class="fas fa-bullhorn fa-3x rounded mr-2"></i>
                    <strong class="mr-auto">{{ $toast['title'] }}</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    {{ $toast['body'] }}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function(){
            $('#element').toast('show')
        })
    </script>
@endif
